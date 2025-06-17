<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

use Typecho\Widget;

class Icarus_Module_FanfouInput
{
    public static function output()
    {
        $user = Widget::widget('Widget_User');
        $isLogin = $user->hasLogin();
        ?>
        <div class="card">
            <div class="card-content">
                <form method="post" action="" id="fanfou-input-form" role="form">
                    <div class="field">
                        <textarea class="textarea" name="fanfou_input_content" rows="3" placeholder="说点什么吧..." <?php echo $isLogin ? '' : 'disabled'; ?> required></textarea>
                    </div>
                    <div class="field is-grouped is-grouped-right">
                        <div class="control">
                            <button class="button is-link" type="submit" <?php echo $isLogin ? '' : 'disabled style="opacity:0.5;cursor:not-allowed;"'; ?>>发布</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
        // 简单处理表单提交（仅作演示，实际应用需结合后端存储和安全校验）
        if ($isLogin && $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['fanfou_input_content'])) {
            $content = htmlspecialchars(trim($_POST['fanfou_input_content']));
            if ($content) {
                echo '<div class="notification is-success has-text-centered" style="margin:1em auto;max-width:400px;">发布成功：' . $content . '</div>';
            }
        }
    }
}