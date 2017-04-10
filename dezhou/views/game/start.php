<?php
/**
 * Created by autumn.
 * Date: 2017-3-31
 * Time: 4:18
 */
use app\services\GameService;

echo \yii\helpers\Html::cssFile('/css/games.css');
echo \yii\bootstrap\Html::jsFile('/layui-1.0.9/layui/lay/modules/layer.js');
$this->title = date('Y-m-d H:i:s').'开始统计';

$model = $model->toArray();
//var_dump($model);die;
$per_sz = ceil($model['per_right_sz'])?:0;
$per_dz =ceil($model['per_left_dz'])?:0;
$per_thlp =ceil($model['per_left_thlp'])?:0;
$per_hp =ceil($model['per_hp'])?:0;
$per_hl =ceil($model['per_right_hl'])?:0;
$per_aa =ceil($model['per_left_aa'])?:0;
$per_jg =ceil($model['per_right_jg'])?:0;
$per_ld =ceil($model['per_right_lz'])?:0;

$max = [];
$maxModel = \app\models\BetType::find()->all();
foreach($maxModel as $item){
    $max[$item['label']] = ceil($item['max_show_time']);
}

?>


<div class="game-body" style="">

    <div class="left-main">

            <div class="game-header">
                <ul>
                    <li class="item item-hn">红牛<span class="bet_money"></span></li>
                    <li class="item item-hp">和牌<span class="bet_money"></span></li>
                    <li class="item item-ln">蓝牛<span class="bet_money"></span></li>
                </ul>
            </div>


            <div class="game-left">


                <ul class="left-top">
                    <li class="item item-th">同花<span class="bet_money"></span></li>
                    <li class="item item-lp">连牌<span class="bet_money"></span></li>
                </ul>


                <ul class="left-footer">
                    <li class="item item-dz">对子<span class="bet_money"></span></li>
                    <li class="item item-thlp">同花连牌<span class="bet_money"></span></li>
                    <li class="item item-aa">对A<span class="bet_money"></span></li>
                </ul>


            </div>

            <div class="game-right">
                <ul class="right-header">
                    <li class="item item-ydgp">一对/高牌<span class="bet_money"></span></li>
                    <li class="item item-ld">两队<span class="bet_money"></span></li>

                </ul>


                <ul class="right-footer">
                    <li class="item item-sz">三条/顺子/同花<span class="bet_money"></span></li>
                    <li class="item item-hl">葫芦<span class="bet_money"></span></li>
                    <li class="item item-jg">金刚<span class="bet_money"></span></li>
                </ul>
            </div>

            <div class="user-money">
                <ul>
                    <li class="item-m" data-num="1">1w</li>
                    <li class="item-m" data-num="5">5w</li>
                    <li class="item-m" data-num="10">10w</li>
                    <li class="item-m" data-num="25">25w</li>
                    <li class="item-m" data-num="50" >50w</li>
                    <li class="item-m" data-num="100">100w</li>
                    <li class="item-m" data-num="1000">1000w</li>
                </ul>
            </div>
        <div>
            <a href="<?= \yii\helpers\Url::to(['game/end-game']) ?>" class="btn btn-danger" style="position: relative; font-size: 17px; top: 15px;left: 2%;">
                结束本局
            </a>
            <a href="javascript:;" class="btn btn-success bet-submit">确认注单</a>
        </div>

    </div>
    <div class="zl">
        <ul>
            <li class="zl-item  zl-header"  data-label="right_sz">顺子</li>
            <li class="zl-item"  data-label="left_dz">对子</li>
            <li class="zl-item"  data-label="left_thlp">同连</li>
            <li class="zl-item" data-label="hp">和牌</li>
            <li class="zl-item"  data-label="right_hl">葫芦</li>
            <li class="zl-item"  data-label="left_aa">对A</li>
            <li class="zl-item"  data-label="right_jg">金刚</li>
        </ul>
    </div>

    <div class="right-tips">
        <table class="table " style=" background-color: #ffffff;    margin-bottom: 3px; ">
            <thead>
            <tr>
                <th><!--a href="javascript:requestData();" class="btn btn-danger">刷新数据</a--></th>
                <th>两队</th>
                <th>顺子</th>
                <th>对子</th>
                <th>同花连牌</th>
                <th>和牌</th>
                <th>葫芦</th>
                <th>对A</th>
                <th>金刚</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>未出数</td>
                <td  class="center cur-ld"><?= $model['right_ld_t'] ?></td>
                <td  class="center cur-sz"><?= $model['right_sz_t'] ?></td>
                <td class="center cur-dz"><?= $model['left_dz_t'] ?></td>
                <td class="center cur-thlp"><?= $model['left_thlp_t'] ?></td>
                <td class="center cur-hp"><?= $model['hp_t'] ?></td>
                <td class="center cur-hl"><?= $model['right_hl_t'] ?></td>
                <td class="center cur-aa"><?= $model['left_aa_t'] ?></td>
                <td class="center cur-jg"><?= $model['right_jg_t'] ?></td>
            </tr>
            <tr>
                <td>命中因素</td>
                <td  class="center will-hit-ld"></td>
                <td  class="center will-hit-sz"></td>
                <td class="center will-hit-dz"></td>
                <td class="center will-hit-thlp"></td>
                <td class="center will-hit-hp"></td>
                <td class="center will-hit-hl"></td>
                <td class="center will-hit-aa"></td>
                <td class="center will-hit-jg"></td>
            </tr>
            <tr>
                <td>最多</td>
                <td class="center max-sz"><?= $max[GameService::RIGHT_SZ] ?></td>
                <td class="center max-ld"><?= $max[GameService::RIGHT_LD] ?></td>
                <td class="center max-dz"><?= $max[GameService::LEFT_DZ] ?></td>
                <td class="center max-thlp"><?= $max[GameService::LEFT_THLP] ?></td>
                <td class="center max-hp"><?= $max[GameService::HP] ?></td>
                <td class="center max-hl"><?= $max[GameService::RIGHT_HL] ?></td>
                <td class="center max-aa"><?= $max[GameService::LEFT_AA] ?></td>
                <td class="center max-jg"><?= $max[GameService::RIGHT_JG] ?></td>
            </tr>

            <tr>
                <td>总均</td>
                <td class="center per-ld"><?= $per_ld ?></td>
                <td class="center per-sz"><?= $per_sz ?></td>
                <td class="center per-dz"><?= $per_dz ?></td>
                <td class="center per-thlp"><?= $per_thlp ?></td>
                <td class="center per-hp"><?= $per_hp ?></td>
                <td class="center per-hl"><?= $per_hl ?></td>
                <td class="center per-aa"><?= $per_aa ?></td>
                <td class="center per-jg"><?= $per_jg ?></td>
            </tr>

            </tbody>
        </table>

            <div class="box span6" id="bet-wrap" style="    margin-left: 0px; width: 100%;  display: none">
                <div class="box-header" style=" background: rgba(251, 2, 2, 0.66); color: white; ">
                    <h2><i class="halflings-icon align-justify"></i><span class="break"></span><span id="bet-way-name"></span></h2>
                    <div class="box-icon">
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content" style="height: 316px; overflow-y: scroll;">
                    <div id="way-args">
                        <div class="layui-form-item">
                            <label class="layui-form-label">开局投注</label>
                            <div class="layui-input-inline">
                                <input type="text" id="start-bet" name="bet" lay-verify="required" placeholder="请输入开局投注" autocomplete="off" class="layui-input" >
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">局盈金额</label>
                            <div class="layui-input-inline">
                                <input type="text" id="time_yl" name="time_yl" lay-verify="required" placeholder="请输入局盈金额" autocomplete="off" class="layui-input" >
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">增投额度</label>
                            <div class="layui-input-inline">
                                <input type="text" id="bet-increase" name="increase" value="1" lay-verify="required" placeholder="请输入增投额度" autocomplete="off" class="layui-input" >
                            </div>
                        </div>




                    </div>
                    <table class="table table-condensed" id="way-data" style="display: none;">
                        <thead>
                        <tr class="unlock-btn hidden"><td colspan="4"><button class="layui-btn unlock-btn-c" style=" margin-left: 45%;">解除锁定</button></td></tr>
                        <tr>
                            <th>局数</th>
                            <th>投注</th>
                            <th>成本</th>
                            <th>盈利</th>
                        </tr>

                        </thead>
                        <tbody id="way-detail">


                        </tbody>
                    </table>
                    <div id="bet-way-success" style="display: none;">
                        <div class="alert alert-success">
                            <strong>恭喜你：</strong>追投注成功!

                        </div>
                        <button class="layui-btn layui-btn-success success-close">关闭</button>
                    </div>
                </div>
            </div>

<!--        <div class="box">-->
<!--            <div class="box-header">-->
<!--                <h2><i class="halflings-icon list-alt"></i><span class="break"></span>Chart with points</h2>-->
<!--                <div class="box-icon">-->
<!--                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>-->
<!--                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>-->
<!--                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="box-content">-->
<!--                <div id="sincos"  class="center" style="height:300px;" ></div>-->
<!--                <p id="hoverdata">Mouse position at (<span id="x">0</span>, <span id="y">0</span>). <span id="clickdata"></span></p>-->
<!--            </div>-->
<!--        </div>-->
    </div>

    <div class="layui-clear"></div>

</div>
<script>
//
    var setTop = function(){
        $.post('<?= \yii\helpers\Url::to(['game/plot','id'=>Yii::$app->session->get('game_id')]) ?>', function (data) {
            var html = ' <div id="placeholder" style="width:100%;height:800px"></div>';
            if(data){
                html +='<script>';
                html += 'var options = '+data.options +";";
                html +='var data = '+data.formdata +";";
                html += '$.plot($("#placeholder"), data, options);';
                html +="<\/script>";
                layer.open({
                    type: 1 //此处以iframe举例
                    ,title: '注单数据统计'
                    ,area: ['1000px', '600px']
                    ,shade: 0
                    ,maxmin: 1
                    ,offset: [ '10%' ,'20%']
                    ,content: html
                    ,btn: ['关闭'] //只是为了演示
                    ,yes: function(){
                        layer.closeAll();
                    }
//                    ,btn2:function(){
//                        setTop();
//                    }
                });
            }

        },'json');
    };
//

    $(function () {

        $(".game-left .item").on('click', function () {
            var body = $("body"),
                color = body.data('color'),
                self_color = $(this).data('color'),
                money = body.data('money');
            if(money != null){
                var self_money = $(this).data('money');
                if(self_money == null){
                    $(this).data('money',money);
                    $(this).find('.bet_money').html(money+'w')
                }else{
                    self_money +=money;
                    $(this).data('money',self_money);
                    $(this).find('.bet_money').html(self_money+'w')
                }
            }else{
                if(self_color == null){
                    $(this).css('background-color',color);
                    $(this).data('color',color);
                }else{
                    $(this).css('background-color','rgba(142, 131, 103, 0.43)');
                    $(this).data('color',null);
                }
            }
        });
        $(".game-right .item").on('click', function () {
            var body = $("body"),
                color = body.data('color'),
                self_color = $(this).data('color'),
                money = body.data('money');

            if(money != null){
                var self_money = $(this).data('money');
                if(self_money == null){
                    $(this).data('money',money);
                    $(this).find('.bet_money').html(money+'w')
                }else{
                    self_money +=money;
                    $(this).data('money',self_money);
                    $(this).find('.bet_money').html(self_money+'w')
                }
            }else{
                if(self_color == null){
                    $(this).css('background-color',color);
                    $(this).data('color',color);
                }else{
                    $(this).css('background-color','rgba(142, 131, 103, 0.43)');
                    $(this).data('color',null);
                }
            }
        });
        $(".item-hn").on('click', function (e) {
            var body = $("body"),
                color = $(this).data('color'),
                money = body.data('money');
            if(money != null){
                var self_money = $(this).data('money');
                if(self_money == null){
                    $(this).data('money',money);
                    $(this).find('.bet_money').html(money+'w')
                }else{
                    self_money +=money;
                    $(this).data('money',self_money);
                    $(this).find('.bet_money').html(self_money+'w')
                }
            }else{
                if(color == null){
                    body.data('color','#d01414');
                    $(this).data('color',1);
                    $(this).css('background-color','#d01414');
                }else{
                    body.data('color', null);
                    $(this).data('color', null);
                    $(this).css('background-color','rgba(142, 131, 103, 0.43)');
                }
            }
        });
        $(".item-hp").on('click', function (e) {
            var body = $("body"),
                color = $(this).data('color'),
                money = body.data('money');
            if(money != null){
                var self_money = $(this).data('money');
                if(self_money == null){
                    $(this).data('money',money);
                    $(this).find('.bet_money').html(money+'w')
                }else{
                    self_money +=money;
                    $(this).data('money',self_money);
                    $(this).find('.bet_money').html(self_money+'w')
                }
            }else{
                if(color == null){
                    body.data('color','#b9bbb4');
                    $(this).data('color',1);
                    $(this).css('background-color','#b9bbb4');
                }else{
                    body.data('color', null);
                    $(this).data('color', null);
                    $(this).css('background-color','rgba(142, 131, 103, 0.43)');
                }
            }

        });
        $(".item-ln").on('click', function (e) {
            var body = $("body"),
                 color = $(this).data('color'),
                 money =body.data('money');
            if(money != null){
                var self_money = $(this).data('money');
                if(self_money == null){
                    $(this).data('money',money);
                    $(this).find('.bet_money').html(money+'w')
                }else{
                    self_money +=money;
                    $(this).data('money',self_money);
                    $(this).find('.bet_money').html(self_money+'w')
                }
            }else{
                if(color == null){
                    body.data('color','blue');
                    $(this).data('color',1);
                    $(this).css('background-color','blue');
                }else{
                    body.data('color', null);
                    $(this).data('color', null);
                    $(this).css('background-color','rgba(142, 131, 103, 0.43)');
                }
            }

        });
        $(".item-m").on('click', function (e) {

            var money  = $(this).data('num');
            var color = $(this).data('color');
            if(color == null){
                $(this).data('color',1);
                $('body').data('money',money);
                $(".item-m").css('background-color','red');
                $(this).css('background-color','#b14d4d');
            }else{
                $('body').data('money',null);
                $(this).data('color',null);
                $(this).css('background-color','red');
            }
        });
        $(".zl>ul>.zl-item").on('click', function () {
            var label = $(this).data('label'),
                dest = $("#bet-way-name"),
                title = '';

            switch (label){
                case 'hp' :
                    title = '和牌打法计算';
                    break;
                case 'left_dz' :
                    title = '对子打法计算';
                    break;
                case 'left_thlp' :
                    title = '同花连牌打法计算';
                    break;
                case 'left_aa' :
                    title = 'AA打法计算';
                    break;
                case 'right_hl' :
                    title = '葫芦打法计算';
                    break;
                case 'right_sz' :
                    title = '顺子打法计算';
                    break;
                case 'right_jg' :
                    title = '金刚打法计算';
                    break;
            }
            calculateBetData(title,label);
        });
        $(".bet-submit").on('click', function () {

            var hn = $(".item-hn"), hp = $(".item-hp"), ln = $(".item-ln"),

                left_th = $('.item-th'), left_lp = $('.item-lp'), left_dz = $('.item-dz'), left_thlp = $('.item-thlp'), left_aa = $('.item-aa'),

                right_ydgp = $(".item-ydgp"), right_ld = $('.item-ld'), right_sz = $('.item-sz'), right_hl = $('.item-hl'), right_jg = $('.item-jg'),

               data = {
                   hn :  { hit: hn.data('color'), bet: hn.data('money')},
                   hp :  { hit: hp.data('color'), bet: hp.data('money')},
                   ln :  { hit: ln.data('color'), bet: ln.data('money')},
                   left_th :  { hit: left_th.data('color'), bet: left_th.data('money')},
                   left_lp :  { hit: left_lp.data('color'), bet: left_lp.data('money')},
                   left_dz :  { hit: left_dz.data('color'), bet: left_dz.data('money')},
                   left_thlp :  { hit: left_thlp.data('color'), bet: left_thlp.data('money')},
                   left_aa :  { hit: left_aa.data('color'), bet: left_aa.data('money')},
                   right_ydgp :  { hit: right_ydgp.data('color'), bet: right_ydgp.data('money')},
                   right_ld :  { hit: right_ld.data('color'), bet: right_ld.data('money')},
                   right_sz :  { hit: right_sz.data('color'), bet: right_sz.data('money')},
                   right_hl :  { hit: right_hl.data('color'), bet: right_hl.data('money')},
                   right_jg :  { hit: right_jg.data('color'), bet: right_jg.data('money')}
               };

            $.post('<?= \yii\helpers\Url::to(['game/create-bet']) ?>',data, function (res) {
                var body = $("body"),
                    start_through = body.data('start-through');

                $(".calculate").find("tbody>tr:first").remove();
                $(".calculate").find("tbody>tr:first").css({'background-color':'#08c','font-size':'25px','font-weight':'bold','color':'#eee'});

                if(res== 200){

                    noty({
                        text:'添加注单成功',
                        layout:'top',
                        speed:100,
                        timeout:1000,
                        type:'information'
                    });
                    requestData();

                }else if(res == 404){
                    noty({
                        text:'请选好已开注单，在提交注单!',
                        layout:'top',
                        type:'information'
                    });

                }else{
                    noty({
                        text:'提交失败',
                        layout:'top',
                        type:'information'
                    });
                }

                body.data('money',null).data('color',null);
                var game_left =  $(".game-left .item"),
                    game_right = $(".game-right .item"),
                    item_hn = $(".item-hn"),
                    item_hp = $(".item-hp"),
                    item_ln = $(".item-ln");
                game_left.data('color',null).data('money',null).css('background-color','rgba(142, 131, 103, 0.43)');
                game_right.data('color',null).data('money',null).css('background-color','rgba(142, 131, 103, 0.43)');
                item_hn.data('color',null).data('money',null).css('background-color','rgba(142, 131, 103, 0.43)');
                item_hp.data('color',null).data('money',null).css('background-color','rgba(142, 131, 103, 0.43)');
                $(".item-m").data('color',null).css('background-color','red');
                item_ln.data('color',null).css('background-color','rgba(142, 131, 103, 0.43)');

                if(body.data('calculate_lock') != 1){
                    game_left.find('.bet_money').html('');
                    game_right.find('.bet_money').html('');
                    item_hn.find('.bet_money').html('');
                    item_hp.find('.bet_money').html('');
                    item_ln.find('.bet_money').html('');
                }
            });
        });
        $('.unlock-btn-c').on('click', function () {
            var body = $("body");
            body.data('calculate_lock',null);
            body.data('lock_item',null);
            $(".unlock-btn").addClass('hidden');
            $('#way-data').hide();
            $('#way-args').show();
            $('.user-money').show();

        });
        $(".success-close").on('click', function () {
            var body = $("body");
            if(body.data('calculate_lock') == 1){

                body.data('calculate_lock',null);
                $(".bet_money").html("");
            }
            $("#bet-wrap").hide();

        });
    });
    var auto_get_data = null;
    (function () {
        requestData();
    })();
    function requestData(){
        requestMaxData();
        requestThroughData();
        requestGameHitsEstamateData();
    }
    //当前最大数据
    function requestMaxData() {
        $.post('<?= \yii\helpers\Url::to(['game/max-time']) ?>',{id:'<?= Yii::$app->session->get('game_id') ?>'}, function (data) {

            $(".max-ld").html(data.right_ld);
            $(".max-sz").html(data.right_sz);
            $(".max-dz").html(data.left_dz);
            $(".max-thlp").html(data.left_thlp);
            $(".max-hp").html(data.hp);
            $(".max-hl").html(data.right_hl);
            $(".max-aa").html(data.left_aa);
            $(".max-jg").html(data.right_jg);
        },'json')
    }
    //当前
    function requestThroughData() {
        $.post('<?= \yii\helpers\Url::to(['game/through-time']) ?>',{id:'<?= Yii::$app->session->get('game_id') ?>'}, function (data) {
            $(".cur-ld").html(data.right_ld);
            $(".cur-sz").html(data.right_sz);
            $(".cur-dz").html(data.left_dz);
            $(".cur-thlp").html(data.left_thlp);
            $(".cur-hp").html(data.hp);
            $(".cur-hl").html(data.right_hl);
            $(".cur-aa").html(data.left_aa);
            $(".cur-jg").html(data.right_jg);
        },'json')
    }


    //游戏命中平局数据
    function requestGameHitsEstamateData() {
        $.post('<?= \yii\helpers\Url::to(['game/game-hits-estimate']) ?>',{id:'<?= Yii::$app->session->get('game_id') ?>'}, function (data) {
            console.log(data.right_ld,data.right_sz);
            $(".will-hit-ld").html(data.right_ld);
            $(".will-hit-sz").html(data.right_sz);
            $(".will-hit-dz").html(data.left_dz);
            $(".will-hit-thlp").html(data.left_thlp);
            $(".will-hit-hp").html(data.hp);
            $(".will-hit-hl").html(data.right_hl);
            $(".will-hit-aa").html(data.left_aa);
            $(".will-hit-jg").html(data.right_jg);
        },'json')
    }

    //计算押注方法
    function calculateBetData(t,outt) {
        var bet = 1,
            increase = 1,
            time_yl = 10,
            type = outt,
            data = {bet:bet,increase:increase,time_yl:time_yl,type:type};

            $.post('<?= \yii\helpers\Url::to(['game/bet-way']) ?>',data,function(data){
                if(data){
                    var content = '<table class="table table-condensed calculate"><thead><tr><th>局数</th><th>投注</th><th>成本</th><th>盈利</th></tr></thead><tbody>' +  data + '</tbody></table>'
                    $("#way-detail").html(data);
                   var  cur =  layer.open({
                        type: 1 //此处以iframe举例
                        ,title: t
                        ,area: ['260px', '180px']
                        ,shade: 0
                        ,maxmin: 0
                        ,offset: [ //为了演示，随机坐标
                           Math.random()*($(window).height()-300)
                           ,Math.random()*($(window).width()-390)
                       ]
                       ,content: content
                        ,btn: ['关闭'] //只是为了演示
                        ,yes: function(){
                            layer.close(cur);
                        }
                    });
                }
            });
        //锁定计算


    }


    (function () {
        window.oncontextmenu = function(){
//            return false;
        }
    })();

</script>
