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
?>
<div id="divMain">
	<div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu"><?php echo MQ_txt_SubMenu(0) ?></div>
	<div id="divMain2">
		<?php 
			$p=new Pagebar('{%host%}zb_users/plugin/MQ_txt/list.php?act=list{&page=%page%}',false);
			$p->PageCount=intval($zbp->Config('MQ_txt')->managecount) ?: 50;; 
			$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
			$p->PageBarCount=$zbp->pagebarcount;
			$w = array('=', 'log_Type', 0);
			$s = '';
			$or = array('log_PostTime'=>'DESC');
			$l = array(($p->PageNow - 1) * $p->PageCount, $p->PageCount);
			$op = array('pagebar' => $p);
			$array = $zbp->GetPostList(
				$s,
				$w,
				$or,
				$l,
				$op
			);
			$str = '<table border="1" class="tableFull tableBorder table_hover table_striped tableBorder-thcenter">
			<tr>
				<th>'.$zbp->lang['msg']['id'].'</th>
				<th>'.$zbp->lang['msg']['category'].'</th>
				<th>'.$zbp->lang['msg']['title'].'</th>
				<th>'.$zbp->lang['msg']['status'].'</th>
				<th></th>
			</tr>';
			foreach ($array as $key => $article) {
				$str .= '<tr>';
				$str .= '<td class="td5">'.$article->ID.'</td>';
				$str .= '<td class="td10">'.$article->Category->Name.'</td>';
				$str .= '<td><a href="'.$article->Url.'" target="_blank"><i class="icon icon-link"></i></a> '.$article->Title.'</td>';
				$str .= '<td class="td5">' . ($article->IsTop ? $zbp->lang['msg']['top'] . '|' : '') . $article->StatusName . '</td>';
				$str .= '<td class="td10 tdCenter">
					<a href="'.BuildSafeURL($zbp->host.'zb_users/plugin/MQ_txt/save.php?act=download&amp;id='. $article->ID) .'"><i class="icon-cloud-download-fill"></i></a>
				</td>';
				$str .= '</tr>';
			}
			$str .='</table>';
			echo $str;
			echo '<p class="pagebar">';
				foreach ($p->Buttons as $key => $value) {
					if ($p->PageNow == $key) {
						echo '<span class="now-page">' . $key . '</span>&nbsp;&nbsp;';
					} else {
						echo '<a href="' . $value . '">' . $key . '</a>&nbsp;&nbsp;';
					}
				}
			echo '</p>';
		?>
	</div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>