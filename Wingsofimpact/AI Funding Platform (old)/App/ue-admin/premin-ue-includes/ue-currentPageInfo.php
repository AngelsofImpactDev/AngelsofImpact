<div class="wrapper" id="ueAdminPath">
	<table width="100%" cellpadding="0" cellspacing="0">
    	<tr>
        	<td>
            	<?
					if($pageTitle != '') {
						$currentCheckAccessRes['adminsitepages_mainmenuname'] = $pageTitle;
					}
				?>
				<a href="<?=$namaPageUtama?>"><?=$currentCheckAccessRes['adminsitepages_mainmenuname']?></a> >
                <?
					switch($pageType) {
						case 'detail':
							if($_GET['detailmode'] == 'edit') {
								echo 'View '.$currentCheckAccessRes['adminsitepages_mainmenuname'].' Detail';
							}
							else {
								echo 'Create New '.$currentCheckAccessRes['adminsitepages_mainmenuname'];
							}
						break;
						case 'overview':
							echo 'View '.$_GET['ovtitle'].' Overview';
						break;
						default:
							if(currentPage() == 'purchase.php') {
								switch($_GET['mode']) {
									case 'r':
										echo 'View All '.$currentCheckAccessRes['adminsitepages_mainmenuname'].' <span class="bold">Requests</span>';
									break;
									case 'c':
										echo 'View All '.$currentCheckAccessRes['adminsitepages_mainmenuname'].' <span class="bold">Confirms</span>';
									break;
									case 'a':
										echo 'View All '.$currentCheckAccessRes['adminsitepages_mainmenuname'].' <span class="bold">Approves</span>';
									break;
									case 's':
										echo 'View All '.$currentCheckAccessRes['adminsitepages_mainmenuname'].' <span class="bold">Shipped</span>';
									break;
									case 'x':
										echo 'View All '.$currentCheckAccessRes['adminsitepages_mainmenuname'].' <span class="bold">Rejects</span>';
									break;
									case 'z':
										echo 'View All '.$currentCheckAccessRes['adminsitepages_mainmenuname'].' <span class="bold">Cancels</span>';
									break;
									default:
										echo 'View All '.$currentCheckAccessRes['adminsitepages_mainmenuname'];
									break;
								}
							}
							else if(currentPage() == 'detail-productsold.php') {
								echo 'View '.$currentCheckAccessRes['adminsitepages_mainmenuname'].' Availability';
							}
							else if($_GET['mode'] == 'e') {
								echo 'View All <span class="bold">Enabled</span> '.$currentCheckAccessRes['adminsitepages_mainmenuname'];
							}
							else if($_GET['mode'] == 'd') {
								echo 'View All <span class="bold">Disabled</span> '.$currentCheckAccessRes['adminsitepages_mainmenuname'];
							}
							else if($_GET['mode'] == 'x') {
								echo 'View All <span class="bold">Expired</span> '.$currentCheckAccessRes['adminsitepages_mainmenuname'];
							}
							else if($_GET['mode'] == 'a') {
								echo 'View All <span class="bold">Active</span> '.$currentCheckAccessRes['adminsitepages_mainmenuname'];
							}
							else if($_GET['search'] != '') {
								echo 'Search Result For <span class="bold">'.$_GET['search'].'</span>';
							}
							else {
								echo 'View All '.$currentCheckAccessRes['adminsitepages_mainmenuname'];
							}
						break;
					}
				?>
            </td>
            <td align="right">
                <?
					switch($pageType) {
						case 'detail':
							if($_GET['detailmode'] == 'edit') {
								if($_GET['id']) {
									echo 'Editing <span class="bold">#'.$_GET['id'].'</span>';
								}
								else {
									echo '&nbsp;';
								}
							}
							else {
								echo '&nbsp;';
							}
						break;
						default:
							if(currentPage() == 'detail-productsold.php') {
								echo 'Availability List';
							}
							else if(currentPage() != 'overview.php') {
								if($_GET['orderwhat'] != '') {
									if($_GET['orderwhat'] == $namaTableDatabase.'_entrydate') {
										$sortByInfo = 'Entry Date';
									}
									else if($_GET['orderwhat'] == $namaTableDatabase.'_editdate') {
										$sortByInfo = 'Edit Date';
									}
									else if($_GET['orderwhat'] == $namaTableDatabase.'_id') {
										$sortByInfo = 'ID';
									}
									else {
										$sortByInfo = ucwords(str_replace('_',' ',$_GET['orderwhat']));
									}
									
									if($_GET['orderby'] == 'asc') {
										$sortByInfoDirection = 'Ascending';
									}
									else if($_GET['orderby'] == 'desc') {
										$sortByInfoDirection = 'Descending';
									}
									echo 'Sorting by <span class="bold">'.$sortByInfo.'</span> in '.$sortByInfoDirection.' order';
								}
								else {
									echo 'Sorting by <span class="bold">Showorder</span>';
								}
							}
							else {
								echo 'Summary &amp; Reports';
							}
						break;
					}
				?>
            </td>
        </tr>
    </table>
</div>