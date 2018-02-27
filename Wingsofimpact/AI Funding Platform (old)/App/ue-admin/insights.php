<?php
	include('head.php');
	
	$namaTableDatabase	= 'user';
	$namaHalamanEdit	= 'detail-user.php';
	$namaFolderUpload	= '';
	
	$pageType 			= 'list';					// list OR detail OR overview
	$pageTitle			= '';
	$namaPageUtama		= currentPage();
?>
<?php
	include('top.php');
?>
<?php
	include('left.php');
?>
<?php
	include('ue-includes/ue-currentPageInfo.php');
?>
<div class="spacer10"></div>
<div>
	<?php
		include('ue-includes/ue-googleTrends.php');
	?>
</div>
<?php
	include('footer.php');
?>