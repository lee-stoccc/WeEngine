<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/8/2
 * Time: 18:00
 */

$current_url = Yii::$app->request->absoluteUrl;
$key = 'addons/';
$we7_url = mb_substr($current_url, 0, stripos($current_url, $key));

?>
<div class="nav-right">
    <div class="btn-group mr-4 message">
        <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            订单消息
            <div class="text-center ml-2 totalNum" hidden
                 style="width: 20px;height: 20px;border-radius:20px;display: inline-block;background-color: #ff4544;color:#fff">
                5
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right message-list" hidden>
        </div>
    </div>
    <div class="btn-group">
        <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            系统
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <?php if (Yii::$app->admin->isGuest): ?>
                <a class="dropdown-item" href="<?= $we7_url ?>web/index.php?c=wxapp&a=display">返回系统</a>
            <?php else: ?>
                <a class="dropdown-item"
                   href="<?= Yii::$app->urlManager->createUrl(['admin/default/index']) ?>">返回系统</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>

    var checkUrl = "<?=Yii::$app->urlManager->createAbsoluteUrl(['mch/get-data/order'])?>";
    var sound = "<?=Yii::$app->request->baseUrl . '/statics/'?>/5611.wav";
    var t;
    function playSound() {
        var borswer = window.navigator.userAgent.toLowerCase();
        if (borswer.indexOf("ie") >= 0) {
            //IE内核浏览器
            var strEmbed = '<embed name="embedPlay" src="' + sound + '" autostart="true" hidden="true" loop="false"></embed>';
            if ($("body").find("embed").length <= 0)
                $("body").append(strEmbed);
            var embed = document.embedPlay;

            //浏览器不支持 audion，则使用 embed 播放
            embed.volume = 100;
        } else {
            //非IE内核浏览器
            var strAudio = "<audio id='audioPlay' src='" + sound + "' hidden='true'>";
            if ($("body").find("audio").length <= 0)
                $("body").append(strAudio);
            var audio = document.getElementById("audioPlay");

            //浏览器支持 audion
            audio.play();
        }
    }
    function checkmessage() {
        $.ajax({
            url: checkUrl,
            type: 'get',
            dataType: 'json',
            success: function (res) {
                if (res.code == 0) {
                    var count = res.data.length;
                    if (count == 0) {
                        return;
                    }
                    $('.message-list').empty();
                    for (var i = 0; i < count; i++) {
                        $('.message-list').prop('hidden', false);
                        $('.totalNum').prop('hidden', false).html(count);
                        var html = "<a class='dropdown-item' data-index='"+res.data[i].id+"' href='<?=Yii::$app->urlManager->createUrl(['mch/order/index','status'=>1])?>'>" + res.data[i].name + "下了一个订单</a>";
                        $('.message-list').append(html);
                        if(res.data[i].is_sound == 0){
                            playSound();
                        }
                    }
                }
            }
        });
        t = setTimeout("checkmessage()", 60000)
    }
    $(document).ready(function () {
        $('.message').hover(function () {
            $('.message-list').show();
        }, function () {
            $('.message-list').hide();
        });
        $('.message-list').on('click', 'a', function () {
            var num = $('.totalNum');
            num.text(num.text() - 1);
            if (num.text() == 0) {
                num.prop('hidden',true);
                $('.message-list').prop('hidden',true)
            }
            $.ajax({
                url: '<?=Yii::$app->urlManager->createUrl(['mch/get-data/message-del'])?>',
                type: 'get',
                dataType: 'json',
                data: {
                    'id': $(this).data('index')
                },
                success: function (res) {
                    if (res.code == 0) {
                        window.location.href=$(this).data('url');
                    }
                }
            });
            $(this).remove();
//            return false;
        });
        checkmessage();

    });
</script>