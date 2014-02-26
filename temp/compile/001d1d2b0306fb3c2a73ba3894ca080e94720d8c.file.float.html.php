<?php /* Smarty version Smarty-3.1.14, created on 2014-02-23 10:18:25
         compiled from "D:\develop\code\www\teemo\template\test\html\float.html" */ ?>
<?php /*%%SmartyHeaderCode:77215306c1b69a2793-66585120%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '001d1d2b0306fb3c2a73ba3894ca080e94720d8c' => 
    array (
      0 => 'D:\\develop\\code\\www\\teemo\\template\\test\\html\\float.html',
      1 => 1393121904,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77215306c1b69a2793-66585120',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_5306c1b69ff1f1_31571551',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5306c1b69ff1f1_31571551')) {function content_5306c1b69ff1f1_31571551($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div id="main">
	<div id="left">
		<p>left left left left left left</p>
		<p>left left left left left left</p>
		<table>
			<caption>Table Title</caption>
			<tr class="title">
				<td>A</td>
				<td>B</td>
				<td>C</td>
				<td>D</td>
				<td>E</td>
				<td>F</td>
			</tr>
			
			<tr>
				<td>Col_1</td>
				<td>Col_2</td>
				<td>Col_3</td>
				<td>Col_4</td>
				<td>Col_5</td>
				<td>Col_6</td>
			</tr>
			
			<tr>
				<td>Col_1</td>
				<td>Col_2</td>
				<td>Col_3</td>
				<td>Col_4</td>
				<td>Col_5</td>
				<td>Col_6</td>
			</tr>
		</table>
	</div>
	
	<div id="right">
		<p>right right right right</p>
		<p>right right right right</p>
		

	</div>
	
	<div class="clear"></div>
	<div class="iframe">
		<iframe name="baidu" src="http://www.baidu.com" width="750px" height="600px"/>
	</div>


	<div id="footer">footer footer footer footer</div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>