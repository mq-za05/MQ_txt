<?php
#注册插件
RegisterPlugin("MQ_txt","ActivePlugin_MQ_txt");

function MQ_txt_SubMenu($id){
	$arySubMenu = array(
		0 => array('文章列表', 'list.php', 'left', false),
		1 => array('插件设置', 'main.php', 'left', false),
	);
	foreach($arySubMenu as $k => $v){
		echo '<a href="'.$v[1].'" '.($v[3]==true?'target="_blank"':'').'><span class="m-'.$v[2].' '.($id==$k?'m-now':'').'">'.$v[0].'</span></a>';
	}
}

function MQ_txt_Download($filename,$content){
	header_remove();
	ob_clean(); 
	$filename = $filename.".txt";
	// 设置 headers，告诉浏览器需要下载文件
	header("Content-Type: application/octet-stream");
	header("Content-Transfer-Encoding: Binary");
	header("Content-disposition: attachment; filename=\"" . basename($filename) . "\"");
	// 输出内容到文件
	echo $content;
}

function InstallPlugin_MQ_txt() {
	global $zbp;
	if (!$zbp->HasConfig('MQ_txt')) {               
        $zbp->Config('MQ_txt')->Version = '1.0';  
		$zbp->Config('MQ_txt')->managecount = '50';
		$zbp->SaveConfig('MQ_txt');   
    }
}
