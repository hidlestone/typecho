<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
class Icarus_Module_Donate
{
    public static function output()
    {
        // 输出捐赠卡片，风格与文章一致
        $wechatImg = Icarus_Assets::getUrlForAssets('img/pay_wechat.png');
        $alipayImg = Icarus_Assets::getUrlForAssets('img/pay_alipay.png');
?>
        <div class="card">
            <div class="card-content article article-single">
                <h6 class="has-text-centered" style="margin-bottom:1.5rem;">◇支持作者◇</h6>
                <div class="columns is-centered is-mobile">
                    <div class="column is-narrow has-text-centered">
                        <figure class="image " style="margin:0 auto 0.5rem;">
                            <img src="<?php echo $wechatImg; ?>" style="max-width:120px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);background:#fff;" />
                        </figure>
                    </div>
                    <div class="column is-narrow has-text-centered">
                        <figure class="image " style="margin:0 auto 0.5rem;">
                            <img src="<?php echo $alipayImg; ?>"  style="max-width:120px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);background:#fff;" />
                        </figure>
                    </div>
                </div>
                <!-- <div class="has-text-centered has-text-grey is-size-7" style="margin-top:1.5rem;">感谢您的支持！</div> -->
            </div>
        </div>
<?php
    }
}
