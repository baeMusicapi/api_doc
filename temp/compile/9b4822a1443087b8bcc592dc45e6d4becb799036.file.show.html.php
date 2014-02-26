<?php /* Smarty version Smarty-3.1.14, created on 2013-12-30 10:25:07
         compiled from "D:\develop\code\www\teemo\template\music\show.html" */ ?>
<?php /*%%SmartyHeaderCode:1336752b402d29eafa9-06192232%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b4822a1443087b8bcc592dc45e6d4becb799036' => 
    array (
      0 => 'D:\\develop\\code\\www\\teemo\\template\\music\\show.html',
      1 => 1388370304,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1336752b402d29eafa9-06192232',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_52b402d2b200c8_03168008',
  'variables' => 
  array (
    'date' => 0,
    'lastDate' => 0,
    'nextDate' => 0,
    'sumPV' => 0,
    'totalAverage' => 0,
    'html' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b402d2b200c8_03168008')) {function content_52b402d2b200c8_03168008($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<form action ='show.php' method="get" target='_blank'>
日期:<input type="text" name="date" value="<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
"/>
<input type="submit" value="确认">
</form>

<a href="show.php?date=<?php echo $_smarty_tpl->tpl_vars['lastDate']->value;?>
">上一天</a>
<a href="show.php?date=<?php echo $_smarty_tpl->tpl_vars['nextDate']->value;?>
">下一天</a>

<div>
	PV: <?php echo $_smarty_tpl->tpl_vars['sumPV']->value;?>
 | 平均时间:<?php echo $_smarty_tpl->tpl_vars['totalAverage']->value;?>

</div>

<?php echo $_smarty_tpl->tpl_vars['html']->value;?>


<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>