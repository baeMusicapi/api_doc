<?php /* Smarty version Smarty-3.1.14, created on 2013-12-22 22:24:45
         compiled from "D:\develop\code\www\teemo\template\music\show_total.html" */ ?>
<?php /*%%SmartyHeaderCode:1599952b6f57d2280e3-92879956%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9eb4352868acd4a02b81764bb22f37e70b9e1e42' => 
    array (
      0 => 'D:\\develop\\code\\www\\teemo\\template\\music\\show_total.html',
      1 => 1387722283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1599952b6f57d2280e3-92879956',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52b6f57d34e833_58627007',
  'variables' => 
  array (
    'startDate' => 0,
    'endDate' => 0,
    'html' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b6f57d34e833_58627007')) {function content_52b6f57d34e833_58627007($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<form action ='show_total.php' method="get">
开始日期:<input type="text" name="start" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
"/>
结束日期:<input type="text" name="end" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
"/>
<input type="submit" value="确认">
</form>

<?php echo $_smarty_tpl->tpl_vars['html']->value;?>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>