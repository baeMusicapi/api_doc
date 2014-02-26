<?php /* Smarty version Smarty-3.1.14, created on 2014-01-03 11:46:18
         compiled from "D:\develop\code\www\teemo\template\music\detail.html" */ ?>
<?php /*%%SmartyHeaderCode:3221752b6eb6150d064-90124899%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc4f820abc7f77fc374380652cf660913aa1e8d5' => 
    array (
      0 => 'D:\\develop\\code\\www\\teemo\\template\\music\\detail.html',
      1 => 1388720776,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3221752b6eb6150d064-90124899',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52b6eb6161c572_76356323',
  'variables' => 
  array (
    'methodInfo' => 0,
    'html' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b6eb6161c572_76356323')) {function content_52b6eb6161c572_76356323($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div>
	接口:<b><?php echo $_smarty_tpl->tpl_vars['methodInfo']->value['name'];?>
</b>
</div>

<?php echo $_smarty_tpl->tpl_vars['html']->value;?>


<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>