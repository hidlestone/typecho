<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

use Typecho\Widget;

$this->need('component/header.php');

// 顶部输入框
Icarus_Module::show('FanfouInput');

$post =Widget::widget('Widget_Archive@fanfou', 'type=page&slug=fanfou');

Icarus_Module::show('Comments', $post);

$this->need('component/footer.php');
