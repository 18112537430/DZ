<?php
/**
 * Created by autumn.
 * Date: 2017-3-31
 * Time: 23:20
 */

namespace app\services;


use app\models\BetType;
use app\models\GameEstimate;
use app\models\Games;
use app\models\GameUnhitsHistory;
use yii\base\Object;
use yii\helpers\VarDumper;

class GameService extends Object
{

    const C_B = 'chengben'; //此局成本
    const WIN = 'win';      //此局赢的金币
    const YING_LI = 'yingli';//盈利的金币
    const PLAY_TIMES = 'play_times'; //游戏次数

    public static function statistics($labels)
    {
        $session = \Yii::$app->session;
        $prefix = \Yii::$app->params['prefix_no_times'];
        $game_id = $session->get('game_id');
        $estimate = GameEstimate::findOne(['game_id'=>$game_id]);
        //玩的次数
        $play_times = $session->get(self::PLAY_TIMES);
        $play_times++;
        $session->set(self::PLAY_TIMES,$play_times);
        $un_hits = [];

        foreach(self::$static_map as $k){
            $key = $prefix.$k;
            if(!in_array($k,$labels)){
                $estimate->$k +=1;
                //统计未出现次数
                $time = $session->get($key);
                $time++;
                $session->set($key,$time);
                if(self::getMaxTimeByTable($k) < $time){
                    self::setMaxTimesToTable($k,$time);
                }
            }else{
                $un_hits[$k] =  $session->get($key);
                //设置未出现次数为0
                $session->set($key,0);
                //统计出现次数
                $key = \Yii::$app->params['prefix_times'].$k;
                $time = $session->get($key);
                $time++;
                $session->set($key,$time);
            }
        }

        if(count($un_hits)){


            $estimateArray = $estimate->toArray();
            $unHits = new GameUnhitsHistory();
            $games = Games::find()->select(
                ' ROUND(avg(per_left_th)) as left_th,
                 ROUND(avg(per_ln)) as ln,
                 ROUND(avg(per_hn)) as hn,
                 ROUND(avg(per_hp)) as hp,
                 ROUND(avg(per_left_aa)) as left_aa,
                 ROUND(avg(per_left_thlp)) as left_thlp,
                 ROUND(avg(per_right_hl)) as right_hl,
                 ROUND(avg(per_right_jg)) as right_jg,
                 ROUND(avg(per_left_lp)) as left_lp,
                 ROUND(avg(per_left_dz)) as left_dz,
                 ROUND(avg(per_right_lz)) as right_ld,
                 ROUND(avg(per_right_sz)) as right_sz,
                 ROUND(avg(per_right_ydgp)) as right_dz'
            )->limit(20)->one()->toArray();
            unset($estimateArray['id'],$estimateArray['game_id'],$estimateArray['uid'],$estimateArray['create_at']);
            foreach($estimateArray as $k => $v){
               if(!isset($estimate->$k)){
                   if($k == 'right_ydgp') {
                       $estimate->$k = -ceil($games['right_dz']);
                   } else{
                       $estimate->$k = -ceil($games[$k]);
                   }
               }
            }

            foreach($un_hits as $k =>$v){
                if($k == 'right_ydgp'){
                    $estimate->$k -= $games['right_dz'];

                }elseif(in_array($k,['ln','hn'])){
                    $estimate->$k--;
                } else{
                    $estimate->$k -= $games[$k];
                }
                $unHits->$k = $v;
            }

            if(!$estimate->save()){
                \Yii::error($estimate->getErrors());
            };
            $unHits->game_id = $game_id;
            $unHits->insert();
        }
    }


    public static function calculateGameAverageByLabel($label)
    {   $session = \Yii::$app->session;
        $prefix =  \Yii::$app->params['prefix_times'];
        if(in_array($label, [GameService::HN, GameService::HP, GameService::LN, GameService::LEFT_THLP, GameService::LEFT_AA, GameService::RIGHT_JG, GameService::RIGHT_HL])){
            $time =  $session->get($prefix.self::HN)+
                $session->get($prefix.self::HP)+
                $session->get($prefix.self::LN);
        }else{
            $time = $session->get(GameService::PLAY_TIMES);
        }
        $lable_t = $session->get($prefix.$label);
        $value = 0;
        if($lable_t){
            $value = $time / $lable_t;
        }else{
            $value = 0;
        }
        return ceil($value);
    }

    public static function statisticsGameCbYl($cb,$win,$yingli)
    {
        $session = \Yii::$app->session;
        $session->set(self::C_B,$session->get(self::C_B)+$cb);
        $session->set(self::WIN,$session->get(self::WIN)+$win);
        $session->set(self::YING_LI,$session->get(self::YING_LI)+$yingli);
    }

    public static function initStatistics()
    {

        $session = \Yii::$app->session;
        $prefix = \Yii::$app->params['prefix_no_times'];
        //设置未出现次数
        $session->set($prefix.self::HN,0);
        $session->set($prefix.self::HP,0);
        $session->set($prefix.self::LN,0);
        $session->set($prefix.self::LEFT_TH,0);
        $session->set($prefix.self::LEFT_LP,0);
        $session->set($prefix.self::LEFT_DZ,0);
        $session->set($prefix.self::LEFT_THLP,0);
        $session->set($prefix.self::LEFT_AA,0);
        $session->set($prefix.self::RIGHT_DZGP,0);
        $session->set($prefix.self::RIGHT_LD,0);
        $session->set($prefix.self::RIGHT_SZ,0);
        $session->set($prefix.self::RIGHT_HL,0);
        $session->set($prefix.self::RIGHT_JG,0);

        $game = Games::findOne(\Yii::$app->session['game_id']);

        //设置出现次数
        $prefix =  \Yii::$app->params['prefix_times'];
        $session->set($prefix.self::HN,$game[self::HN]);
        $session->set($prefix.self::HP,$game[self::HP]);
        $session->set($prefix.self::LN,$game[self::LN]);
        $session->set($prefix.self::LEFT_TH,0);
        $session->set($prefix.self::LEFT_LP,0);
        $session->set($prefix.self::LEFT_DZ,0);
        $session->set($prefix.self::LEFT_THLP,0);
        $session->set($prefix.self::LEFT_AA,0);
        $session->set($prefix.self::RIGHT_DZGP,0);
        $session->set($prefix.self::RIGHT_LD,0);
        $session->set($prefix.self::RIGHT_SZ,0);
        $session->set($prefix.self::RIGHT_HL,$game[self::RIGHT_HL]);
        $session->set($prefix.self::RIGHT_JG,$game[self::RIGHT_JG]);

        //玩的次数
        $session->set(self::PLAY_TIMES,0);
        //成本
        $session->set(self::C_B,0);
        //获得金币
        $session->set(self::WIN,0);
        //盈利金币
        $session->set(self::YING_LI,0);


        //初始化游戏局评估数据
        $estimate = new GameEstimate();
        $estimate->game_id = \Yii::$app->session['game_id'];
        $estimate->uid =\Yii::$app->session['uid'] ?: 0;
        $estimate->hn =0;
        $estimate->hp =0;
        $estimate->ln =0;
        $estimate->left_th =0;
        $estimate->left_lp =0;
        $estimate->left_thlp =0;
        $estimate->left_dz =0;
        $estimate->left_aa =0;
        $estimate->right_ydgp =0;
        $estimate->right_ld =0;
        $estimate->right_sz =0;
        $estimate->right_hl =0;
        $estimate->right_jg =0;
        $estimate->create_at =date('Y-m-d H:i:s');

        //配置评估初始数据
        $games = Games::find()->select(
            ' ROUND(avg(per_left_th)) as left_th,
                 ROUND(avg(per_ln)) as ln,
                 ROUND(avg(per_hn)) as hn,
                 ROUND(avg(per_hp)) as hp,
                 ROUND(avg(per_left_aa)) as left_aa,
                 ROUND(avg(per_left_thlp)) as left_thlp,
                 ROUND(avg(per_right_hl)) as right_hl,
                 ROUND(avg(per_right_jg)) as right_jg,
                 ROUND(avg(per_left_lp)) as left_lp,
                 ROUND(avg(per_left_dz)) as left_dz,
                 ROUND(avg(per_right_lz)) as right_ld,
                 ROUND(avg(per_right_sz)) as right_sz,
                 ROUND(avg(per_right_ydgp)) as right_dz'
        )->limit(20)->one()->toArray();
        $estimateArray = $estimate->toArray();
        unset($estimateArray['uid'],$estimateArray['create_at'],$estimateArray['id']);
        foreach($estimateArray as $k => $v){
            if(!$estimate->$k){
                if($k == 'right_ydgp') {
                    $estimate->$k = -ceil($games['right_dz']);
                }else{
                    $estimate->$k = -ceil($games[$k]);
                }
            }
        }
        $estimate->insert();
    }


    public static function getBetNameByLabel($label)
    {
        return self::$bet_name_map[$label];
    }




    public static function getMaxTimeByTable($label)
    {
        return ceil(BetType::findOne(['label'=>$label])['max_show_time']);
    }

    public static function setMaxTimesToTable($label,$time){
        $model = BetType::findOne(['label'=>$label]);
        $model->max_show_time = $time;
        return $model->save();
    }

    public static function getBetTypeAverage()
    {
        $games = Games::find()->select(
            'avg(per_left_th) as per_left_th,avg(per_left_lp) as per_left_lp ,
            avg(per_left_dz) as per_left_dz,avg(per_right_lz) as per_right_lz,
            avg(per_right_sz) as per_right_sz,avg(per_right_ydgp) as per_right_ydgp'
        )->limit(20)->one()->toArray();
        return $games;
    }

    public static $bet_map = [
        self::HN => 2,
        self::HP => 19,
        self::LN => 2,
        self::LEFT_TH =>2.3,
        self::LEFT_LP => 3.3,
        self::LEFT_DZ => 8.4,
        self::LEFT_THLP=>12.5,
        self::LEFT_AA =>100,
        self::RIGHT_DZGP => 2.2,
        self::RIGHT_LD => 3,
        self::RIGHT_SZ => 4.5,
        self::RIGHT_HL => 20,
        self::RIGHT_JG => 246
    ];


    public static $bet_name_map = [
        self::LEFT_TH =>'同花',
        self::LEFT_LP => '连牌',
        self::LEFT_DZ => '对子',
        self::LEFT_THLP=>'同花连牌',
        self::LEFT_AA =>'对A',
        self::RIGHT_DZGP =>'高牌',
        self::RIGHT_LD => '两队',
        self::RIGHT_SZ => '顺子',
        self::RIGHT_HL => '葫芦',
        self::RIGHT_JG => '金刚'
    ];






    public static $static_map = [self::HN, self::HP, self::LN, self::LEFT_TH, self::LEFT_LP, self::LEFT_DZ, self::LEFT_THLP, self::LEFT_AA, self::RIGHT_DZGP, self::RIGHT_LD, self::RIGHT_SZ, self::RIGHT_HL, self::RIGHT_JG];

    const HN = 'hn';

    const HP = 'hp';

    const LN = 'ln';

    const LEFT_TH = 'left_th';

    const LEFT_LP = 'left_lp';

    const LEFT_THLP = 'left_thlp';

    const LEFT_DZ = 'left_dz';

    const LEFT_AA = 'left_aa';

    const RIGHT_DZGP = 'right_ydgp';

    const RIGHT_LD = 'right_ld';

    const RIGHT_SZ = 'right_sz';

    const RIGHT_HL = 'right_hl';

    const RIGHT_JG = 'right_jg';
}