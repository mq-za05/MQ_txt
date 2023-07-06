<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('MQ_txt')) {$zbp->ShowError(48);die();}

$blogtitle='文章导出为TXT文档';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

if (count($_POST) > 0) {
	CheckIsRefererValid();
	$zbp->Config('MQ_txt')->managecount = $_POST['managecount'];
	$zbp->SaveConfig('MQ_txt');
    $zbp->SetHint('good'); 
	Redirect('./main.php');
}

?>
<div id="divMain">
	<div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu"><?php echo MQ_txt_SubMenu(1) ?></div>
	<div id="divMain2">
		<form id="form1" name="form1" method="post"> 
			<table border="1" class="tableFull tableBorder table_hover table_striped tableBorder-thcenter">
				<tr>
					<th>标题</th>
					<th>内容</th>
				</tr>
				<tr>
					<td class="td10">文章列表数量</td>
					<td><input name="managecount" type="text" value="<?php echo $zbp->Config('MQ_txt')->managecount;?>"/> 默认 50 </td>
				</tr>
				<tr>
					<td>保存设置</td>
					<td>
						<input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken(); ?>">
						<input name="" type="Submit" class="button" value="保存" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>
