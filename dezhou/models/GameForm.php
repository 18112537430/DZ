<?php
/**
 * Created by autumn.
 * Date: 2017-3-31
 * Time: 23:42
 */

namespace app\models;


use yii\base\Model;

class GameForm extends Model
{

    public $hn;
    public $hp;
    public $ln;
    public $thlp;
    public $aa;
    public $hl;
    public $jg;
    public $_game_id;

    public function rules()
    {
       return [
           [['hn','hp','ln','thlp','aa','hl','jg'],'required'],
           [['hn','hp','ln','thlp','aa','hl','jg'],'integer']
       ];
    }


    public function createGame()
    {

        $total_times = $this->hn + $this->hp + $this->ln;

        $per_hn = $total_times / $this->hn;
        $per_hp = $total_times / $this->hp;
        $per_ln = $total_times / $this->ln;

        $per_thlp = $total_times / $this->thlp;
        $per_aa = $total_times/ $this->aa;
        $per_hl = $total_times / $this->hl;
        $per_jg = $total_times / $this->jg;

        $model = new Games();

        $model->per_hn = $per_hn;
        $model->per_hp = $per_hp;
        $model->per_ln = $per_ln;
        $model->per_left_th = 0;
        $model->per_left_thlp = $per_thlp;
        $model->per_left_aa = $per_aa;
        $model->per_right_hl = $per_hl;
        $model->per_right_jg = $per_jg;

        $model->uid = 0;
        $model->hn = $this->hn;
        $model->ln = $this->ln;
        $model->hp = $this->hp;
        $model->left_th = 0;
        $model->left_lp = 0;
        $model->left_dz = 0;
        $model->left_thlp = $this->thlp;
        $model->left_aa = $this->aa;
        $model->right_dz = 0;
        $model->right_ld = 0;
        $model->right_sz = 0;
        $model->right_sz = 0;
        $model->right_hl = $this->hl;
        $model->right_jg = $this->jg;
        $model->left_th_t = 0;
        $model->left_lp_t = 0;
        $model->left_dz_t = 0;
        $model->left_thlp_t = 0;
        $model->left_aa_t = 0;
        $model->right_ld_t = 0;
        $model->right_dz_t = 0;
        $model->right_sz_t = 0;
        $model->right_hl_t = 0;
        $model->right_jg_t = 0;
        $model->hp_t = 0;
        $model->hp_t = 0;
        $model->hp_t =1;
        $model->win =0;
        $model->yingli =0;
        $model->cb =0;
        $model->is_win ="0";
        $model->create_at =date('Y-m-d H:i:s');
        if($model->insert()){
            return  $model->id;
        }else{

            foreach($model->getErrors() as $attribute =>$value ){
                $this->addError($attribute,$value);
            }
            return false;
        }

    }




}