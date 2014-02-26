<?php /* Smarty version Smarty-3.1.14, created on 2013-12-22 21:48:15
         compiled from "D:\develop\code\www\teemo\template\music\load.html" */ ?>
<?php /*%%SmartyHeaderCode:1427752b6ecb80d8928-51323245%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c77b32770dd11f924fcec83503682dd1bb74dd5c' => 
    array (
      0 => 'D:\\develop\\code\\www\\teemo\\template\\music\\load.html',
      1 => 1387720094,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1427752b6ecb80d8928-51323245',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52b6ecb822aa48_64977684',
  'variables' => 
  array (
    'action' => 0,
    'startDate' => 0,
    'endDate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b6ecb822aa48_64977684')) {function content_52b6ecb822aa48_64977684($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<?php if ($_smarty_tpl->tpl_vars['action']->value=='view'){?>
	<a href='/music/load.php?start=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&end=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
&action=load'>加载</a>
	<a href='/music/load.php?start=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&end=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
&action=load&overwrite=1'>覆盖加载</a>
<?php }else{ ?>

<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>