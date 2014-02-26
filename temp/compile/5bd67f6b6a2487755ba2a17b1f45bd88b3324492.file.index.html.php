<?php /* Smarty version Smarty-3.1.14, created on 2013-12-23 11:53:44
         compiled from "D:\develop\code\www\teemo\template\index.html" */ ?>
<?php /*%%SmartyHeaderCode:626052b7b3c8692c84-54043620%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5bd67f6b6a2487755ba2a17b1f45bd88b3324492' => 
    array (
      0 => 'D:\\develop\\code\\www\\teemo\\template\\index.html',
      1 => 1387525424,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '626052b7b3c8692c84-54043620',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'test' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52b7b3c8816c50_71085074',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b7b3c8816c50_71085074')) {function content_52b7b3c8816c50_71085074($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<?php echo dump($_smarty_tpl->tpl_vars['test']->value);?>


<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>