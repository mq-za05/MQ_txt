<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('MQ_txt')) {$zbp->ShowError(48);die();}

if(GetVars('act','GET') == 'download' ){
	global $zbp;
	CheckIsRefererValid();
	if (isset($_GET['id']) && (int) $_GET['id'] != 0) {
		$article = $zbp->GetPostByID((int) GetVars('id', 'GET'));
		if (!empty($article->ID)) { 
			MQ_txt_Download(FormatString($article->Title, '[filename]'),$article->Content);
		}
	}
}
