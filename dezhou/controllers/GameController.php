<?php
/**
 * Created by autumn.
 * Date: 2017-3-31
 * Time: 4:17
 */

namespace app\controllers;


use app\models\Bet;
use app\models\BetForm;
use app\models\GameEstimate;
use app\models\GameForm;
use app\models\Games;
use app\models\GameUnhitsHistory;
use app\models\HitBets;
use app\models\Hits;
use app\services\ArithmeticService;
use app\services\GameService;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Session;

class GameController extends Controller
{

    public $enableCsrfValidation = false;


    public function actionIndex()
    {

    }


    /**
     * 当前未命中注型数据
     */
    public function actionThroughTime()
    {
        $session = \Yii::$app->session;
        $result = [];
        foreach(GameService::$static_map as $label){
            $result[$label] = $session->get(\Yii::$app->params['prefix_no_times'].$label);
        }
        echo json_encode($result);die;
    }

    public function actionMaxTime()
    {

        $result = [];
        foreach(GameService::$static_map as $label){
            $result[$label] = GameService::getMaxTimeByTable($label);
        }
        echo json_encode($result);die;
    }

    /**
     * 当局平均值
     */
    public function actionGameAverage()
    {
        $result = [];
        foreach(GameService::$static_map as $label){
            $result[$label] = GameService::calculateGameAverageByLabel($label);
        }

        echo json_encode($result);die;
    }


    public function actionBetLabel()
    {

    }


    public function actionStart($id)
    {
        $model = Games::findOne($id);
        return $this->render('start',[
            'model'=>$model
        ]);
    }

    public function actionCreateGame()
    {
        $model = new GameForm();

        if($model->load(\Yii::$app->request->post()) && ($game_id =  $model->createGame())){
            \Yii::$app->session->set('game_id',$game_id);
            GameService::initStatistics();
            return $this->redirect(['start','id'=>$game_id]);

        }
        return $this->render('create-game',[
            'model'=>$model
        ]);
    }

    public function actionCreateBet()
    {
        $post = \Yii::$app->request->post();
        $session = \Yii::$app->session;
        $hit_str = '';
        $mstr = '';
        $chengben = 0;
        $yingli = 0;
        $total_money = 0;
        $total_yingli = 0;
        $labels = [];
        $is_hit = false;
        $total_win = 0;

       foreach($post as $label =>$item){
           if(isset($item['hit']) && $item['hit']){
               $hit_str .=$label.',';
               $labels[] = $label;
           }

           if(isset($item['bet']) && $item['bet']){
               $is_hit = true;
               $money = intval($item['bet']);
               $chengben =  $money;
               if(isset($item['hit']) && $item['hit']){
                   //处理盈利，成本
                   $total_win += GameService::$bet_map[$label] * $money;
                   $yingli += (GameService::$bet_map[$label] - 1) * $money;
                   $total_yingli += (GameService::$bet_map[$label] - 1) * $money;
               }else{
                   $yingli = 0;
               }
               $mstr .= "$label|$chengben|$yingli , ";
               $total_money += $money;
           }

       }

        if(!count($labels)){
            echo 404;die;
        }
        //计算成本盈利
        GameService::statisticsGameCbYl($total_money,$total_win,$total_yingli);
        //统计注单情况
        GameService::statistics($labels);

        $tran = \Yii::$app->db->beginTransaction();

        try {

            $bet = new Bet();
            $bet->game_id = \Yii::$app->session->get('game_id');
            $bet->show = $hit_str;
            $bet->show_at = date('Y-m-d H:i:s');
            $bet->insert();
            $bet_id = $bet->id;
            if($is_hit){
                $hits = new Hits();
                $hits->game_id = \Yii::$app->session->get('game_id');
                $hits->hits = $mstr;
                $hits->hit_at =date('Y-m-d H:i:s');
                $hits->insert();
                $hit_new_id = $hits->id;

                $hitsBet = new HitBets();
                $hitsBet->game_id = \Yii::$app->session->get('game_id');
                $hitsBet->bet_id =$bet_id;
                $hitsBet->hit_id =$hit_new_id;
                $hitsBet->uid =0;
                $hitsBet->hit_total_money =$total_money;
                $hitsBet->get_total_money =0;
                $hitsBet->yl_total_money =$total_yingli;
                $hitsBet->desc =' ';
                $hitsBet->bet_time =date('Y-m-d H:i:s');
                $hitsBet->end_time =date('Y-m-d H:i:s');

                $hitsBet->insert();
            }
            $tran->commit();
            echo 200;
        } catch (Exception $e) {
            $tran->rollBack();
            var_dump($e->getMessage());
        }
    }


    public function actionEndGame()
    {
        $session = \Yii::$app->session;
        $game_id = $session->get('game_id');
        $game = Games::findOne($game_id);
        //出现的次数
        foreach(GameService::$static_map as $k){
            $key = \Yii::$app->params['prefix_times'].$k;
            if(in_array($k,[GameService::HN,GameService::HP,GameService::LN,GameService::LEFT_THLP,GameService::LEFT_AA,GameService::RIGHT_JG,GameService::RIGHT_HL])){
                $game->$k += $session->get($key);
            }else{
                if($k == GameService::RIGHT_DZGP){
                    $game->right_dz += $session->get($key);
                }else{
                    $game->$k = $session->get($key);
                }
            }

        }
        //连续未出现的次数
        $prefix = \Yii::$app->params['prefix_no_times'];
        $game->left_th_t = $session->get($prefix.GameService::LEFT_TH);
        $game->left_lp_t = $session->get($prefix.GameService::LEFT_LP);
        $game->left_dz_t = $session->get($prefix.GameService::LEFT_DZ);
        $game->left_thlp_t = $session->get($prefix.GameService::LEFT_THLP);
        $game->left_aa_t = $session->get($prefix.GameService::LEFT_AA);
        $game->right_ld_t = $session->get($prefix.GameService::RIGHT_LD);
        $game->right_dz_t = $session->get($prefix.GameService::RIGHT_DZGP);
        $game->right_sz_t = $session->get($prefix.GameService::RIGHT_SZ);
        $game->right_hl_t = $session->get($prefix.GameService::RIGHT_HL);
        $game->right_jg_t = $session->get($prefix.GameService::RIGHT_JG);
        $game->hp_t = $session->get($prefix.GameService::HP);

        //计算盈利信息

        $game->times = $session->get(GameService::PLAY_TIMES);
        $game->win = $session->get(GameService::WIN);
        $game->yingli = $session->get(GameService::YING_LI);
        $game->cb = $session->get(GameService::C_B);

        if($game->yingli > $game->cb){
            $game->is_win = 'success';
        }else{
            $game->is_win = 'failure';
        }

        $game->end_at =date('Y-m-d H:i:s');

        //计算平均数

       $total = $game->hn + $game->ln +$game->hp;


        $game->per_hp = $total  / $game->hp;
        $game->per_left_thlp = $total / $game->left_thlp;
        $game->per_left_aa = $total / $game->left_aa;
        $game->per_right_hl = $total / $game->right_hl;
        $game->per_right_jg = $total / $game->right_jg;

        if($game->left_th){
            $game->per_left_th = $game->times / $game->left_th;
        }
        if($game->left_lp){
            $game->per_left_lp = $game->times / $game->left_lp;
        }
        if($game->left_dz){
            $game->per_left_dz = $game->times / $game->left_dz;
        }

        if($game->right_dz){
            $game->per_right_ydgp = $game->times / $game->right_dz;
        }

        if($game->right_ld){
            $game->per_right_lz = $game->times / $game->right_ld;
        }
       if($game->right_sz){
            $game->per_right_sz = $game->times / $game->right_sz;
        }


        if($game->save()){
            return $this->redirect(['site/index']);
        }else{
            var_dump($game);
        }



    }


    public function actionPlot($id)
    {

        $query = GameUnhitsHistory::find();

        $rs = ArrayHelper::toArray($query->select('right_ydgp as gp ')->where(['game_id'=>$id])->andWhere('right_ydgp <> 0')->all());

    }

    public function actionGameHitsEstimate()
    {
        $result = [];
        $game_id = \Yii::$app->session->get('game_id');

        $estimate = GameEstimate::findOne(['game_id'=>$game_id])->toArray();
        foreach($estimate as $k => $v ){
            if(in_array($k,GameService::$static_map)){
                $result[$k] = $v;
            }
        }
        echo json_encode($result);die;
    }

    public function actionBetWay()
    {
        $post = \Yii::$app->request->post();
        $bet = $post['bet']; //投注金额
        $timesYl = $post['time_yl'];
        $throughIncrease = $post['increase'];
        $type = $post['type'];

        switch($type){
            case 'hp':
                $type = ArithmeticService::HP;
                break;
            case 'left_dz':
                $type = ArithmeticService::LEFT_DZ;
                break;
            case 'left_thlp':
                $type = ArithmeticService::LEFT_THLP;
                break;
            case 'left_aa':
                $type = ArithmeticService::LEFT_AA;
                break;
            case 'right_sz':
                $type = ArithmeticService::RIGHT_SZ;
                break;
            case 'right_hl':
                $type = ArithmeticService::RIGHT_HL;
                break;
            case 'right_jg':
                $type = ArithmeticService::RIGHT_JG;
                break;
        }

        $arithmetic = new ArithmeticService($bet);
        $arithmetic->setType($type);
        $arithmetic->setTimeYl($timesYl);
        $arithmetic->setThroughIncrease($throughIncrease);
        $arithmetic->calculateData();
        $html = '';


        $i = 0;
        foreach($arithmetic->getData() as $item){
            if($i == 0){
                $html .=' <tr class="way-'.$item[0].'" style="background-color:#08c;font-size:24px;font-weight:bold;color:#eee"> <td class="cal-item-order">'.$item[0].'</td> <td class="center cal-item-bet">'.$item[1].'</td> <td class="center cal-item-cb">'.$item[2].'</td> <td class="center cal-item-yl">'.$item[3].'</td> </tr>';
            }else{
                $html .=' <tr class="way-'.$item[0].'" > <td class="cal-item-order">'.$item[0].'</td> <td class="center cal-item-bet">'.$item[1].'</td> <td class="center cal-item-cb">'.$item[2].'</td> <td class="center cal-item-yl">'.$item[3].'</td> </tr>';

            }
            $i++;
        }
        echo $html;

    }



}