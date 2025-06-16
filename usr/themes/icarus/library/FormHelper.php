<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

use Typecho\Widget\Helper\Form\Element;
use Typecho\Widget\Helper\Form\Element\Text as TypechoText;
use Typecho\Widget\Helper\Form\Element\Textarea as TypechoTextarea;
use Typecho\Widget\Helper\Form\Element\Radio as TypechoRadio;
use Typecho\Widget\Helper\Form\Element\Checkbox as TypechoCheckbox;
use Typecho\Widget\Helper\Form\Element\Hidden as TypechoHidden;
use Utils\Helper;

class Icarus_Form_Element_Text extends TypechoText
{
    public function value($value): Element
    {
        if (!is_null($value))
            return parent::value($value);
        else
            return $this;
    }
}

class Icarus_Form_Element_Textarea extends TypechoTextarea
{
    public function value($value): Element
    {
        if (!is_null($value))
            return parent::value($value);
        else
            return $this;
    }
}

class Icarus_Form_Element_Radio extends TypechoRadio
{
    public function value($value): Element
    {
        if (!is_null($value))
            return parent::value($value);
        else
            return $this;
    }
}

class Icarus_Form_Element_Checkbox extends TypechoCheckbox
{
}

class Icarus_Form_VersionField extends TypechoHidden
{
    public function __construct()
    {
        parent::__construct(Icarus_Config::prefixKey('config_version'), NULL, __ICARUS_CFG_VERSION__);
    }

    public function value($value): Element
    {
        return parent::value(__ICARUS_CFG_VERSION__);
    }
}

class Icarus_Form_ConfigBackup extends Element
{
    public function __construct()
    {
        parent::__construct('icarus_backup', NULL, NULL, '主题设置备份', NULL);
    }

    protected function inputValue($value)
    {
        // 可根据需要实现
    }

    /**
     * 初始化当前输入项
     *
     * @access public
     * @param string $name 表单元素名称
     * @param array $options 选择项
     * @return Typecho_Widget_Helper_Layout
     */
    public function input(?string $name = null, ?array $options = null): ?\Typecho\Widget\Helper\Layout
    {
        $backupExist = intval(Icarus_Backup::exist());
        $security = Helper::security();

        $backupStatusText = new \Typecho\Widget\Helper\Layout('p');
        $backupStatusText->html(_IcT('setting.backup.status.' . $backupExist));
        $this->container($backupStatusText);

        $saveBackupButton = new \Typecho\Widget\Helper\Layout(
            'button',
            array(
                'class' => 'btn primary btn-xs icarus-backup-action',
                'data-url' => $security->getAdminUrl('options-theme.php?icarus_action=backup_save')
            )
        );
        $saveBackupButton->html(_IcT('setting.backup.action.save'));
        $this->container($saveBackupButton);

        if ($backupExist) {
            $deleteBackupButton = new \Typecho\Widget\Helper\Layout(
                'button',
                array(
                    'class' => 'btn btn-warn btn-xs icarus-backup-action',
                    'data-url' => $security->getAdminUrl('options-theme.php?icarus_action=backup_delete')
                )
            );
            $deleteBackupButton->html(_IcT('setting.backup.action.delete'));
            $this->container($deleteBackupButton);

            $restoreBackupButton = new \Typecho\Widget\Helper\Layout(
                'button',
                array(
                    'class' => 'btn btn-xs icarus-backup-action',
                    'data-url' => $security->getAdminUrl('options-theme.php?icarus_action=backup_restore')
                )
            );
            $restoreBackupButton->html(_IcT('setting.backup.action.restore'));
            $this->container($restoreBackupButton);
        }

        $script = new \Typecho\Widget\Helper\Layout('script');
        $script->html(self::BACKUP_SCRIPT);
        $this->container($script);
            
        return NULL;
    }

    /**
     * 设置表单元素值
     *
     * @access protected
     * @param mixed $value 表单元素值
     * @return void
     */
    protected function _value($value)
    {
    }

    const BACKUP_SCRIPT = <<<SCRIPT
document.addEventListener('DOMContentLoaded', function () {
    $('.icarus-backup-action').click(function () {
        $.post(
            $(this).data('url'), 
            null,
            function (result) {
                console.log(result);
                switch (result.action) {
                    case "refresh":
                        document.location.reload();
                    break;
                }
            }
        );
        
        return false;
    });
});
SCRIPT;
}
