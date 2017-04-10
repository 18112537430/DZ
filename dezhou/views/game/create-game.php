<?php
/**
 * Created by autumn.
 * Date: 2017-3-31
 * Time: 23:40
 */

$this->title = date('Y-m-d H:i:s').':创建新局';

?>
<div class="container">
    <div class="alert alert-info">请输入本局游戏数据</div>
    <div class="login-box">

    <?php $form = \yii\widgets\ActiveForm::begin(['options'=>['class'=>'form-horizontal','style'=>' width: 478px;
    display: block;
    margin: 0 auto;
    margin-top: 10%;
    position: relative;
    left: -81px;']])  ?>

    <style>
        .login-box .control-group input{
            border: 1px solid #d8bebe !important;
            color: #ff0101;
        }
    </style>

    <div class="control-group">
        <label class="control-label" for="focusedInput">红牛胜利</label>
        <div class="controls">
            <?= \yii\helpers\Html::activeTextInput($model,'hn',[
                'placeholder'=>'请输入红牛胜利次数',
                'class'=>'input-xlarge focused',
            ]) ?>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="focusedInput">蓝牛胜利</label>
        <div class="controls">
            <?= \yii\helpers\Html::activeTextInput($model,'ln',[
                'placeholder'=>'请输入蓝牛胜利次数',
                'class'=>'input-xlarge focused',
            ]) ?>
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="focusedInput">和牌</label>
        <div class="controls">
            <?= \yii\helpers\Html::activeTextInput($model,'hp',[
                'placeholder'=>'请输入和牌次数',
                'class'=>'input-xlarge focused',
            ]) ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="focusedInput">同花连牌</label>
        <div class="controls">
            <?= \yii\helpers\Html::activeTextInput($model,'thlp',[
                'placeholder'=>'请输入同花连牌次数',
                'class'=>'input-xlarge focused',
            ]) ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="focusedInput">对A</label>
        <div class="controls">
            <?= \yii\helpers\Html::activeTextInput($model,'aa',[
                'placeholder'=>'请输入对A次数',
                'class'=>'input-xlarge focused',
            ]) ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="focusedInput">葫芦</label>
        <div class="controls">
            <?= \yii\helpers\Html::activeTextInput($model,'hl',[
                'placeholder'=>'请输入葫芦次数',
                'class'=>'input-xlarge focused',
            ]) ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="focusedInput">金刚</label>
        <div class="controls">
            <?= \yii\helpers\Html::activeTextInput($model,'jg',[
                'placeholder'=>'请输入金刚次数',
                'class'=>'input-xlarge focused',
            ]) ?>
        </div>
    </div>

    <div class="control-group">

        <div class="controls">

            <?= \yii\bootstrap\Html::submitButton('开始进入',['class'=>'layui-btn center']) ?>
        </div>
    </div>

   <?= \yii\helpers\Html::errorSummary($model) ?>
    <?php \yii\widgets\ActiveForm::end()  ?>
    </div>
</div>


