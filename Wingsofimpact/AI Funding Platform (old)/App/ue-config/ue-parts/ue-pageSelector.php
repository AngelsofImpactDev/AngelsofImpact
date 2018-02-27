<div class="clearFloat"></div>
<div id="zenPageContainer">
<?php
 $jumlahData=$productListNumTotal;$totalNumPageShow=11;$fairu=$_SERVER["SCRIPT_NAME"];$bureq=explode('/',$fairu);$pfile=$bureq[count($bureq)-1];$pgSel_parameters='';foreach($_GET as $pgSelParamKey=>$pgSelParamVal){if($pgSelParamKey!='page'){$pgSel_parameters.='&'.$pgSelParamKey.'='.$pgSelParamVal;}}?>
<table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 20px;">
	<tr>
    	<td width="50">
        	<?php
 if($page>1){echo '<a href="'.$pfile.'?page=1'.$pgSel_parameters.'" class="zenPageButton">First</a>';}else{echo '&nbsp;';}?>
        </td>
        <td width="10">
        	<?php
 if($page>1){echo '<a href="'.$pfile.'?page='.($page-1).$pgSel_parameters.'" class="zenPageButton">&laquo;</a>';}else{echo '&nbsp;';}?>
        </td>
        <td align="center">
        	<?php
			$pageMsg = 'Not Found';
			if(currentPage() == "fundinglist.php"){
				$pageMsg = 'You haven\'t started yet to fund';
			}
 $numOfPages=0;$nowpage=$page;$makz=ceil($jumlahData/$productPerPage);$bufferPageClean=($totalNumPageShow-1)/2;for($i=($nowpage-1);$i>0;$i--){$numOfPages++;$awalPage=$i;if($numOfPages>=$bufferPageClean){break;}}for($i=$awalPage;$i<$nowpage;$i++){echo '<a href="'.$pfile.'?page='.$i.$pgSel_parameters.'">'.$i.'</a> ';}if($jumlahData==0){echo $pageMsg;}else{echo '<span id="currentPagePgSel">'.$page.'</span> ';}for($i=($nowpage+1);$i<=$makz;$i++){echo '<a href="'.$pfile.'?page='.$i.$pgSel_parameters.'">'.$i.'</a> ';$numOfPages++;if($numOfPages>=($totalNumPageShow-1)){break;}}?>
        </td>
    	<td width="10">
        	<?php
 if($page<ceil($jumlahData/$productPerPage)){echo '<a href="'.$pfile.'?page='.($page+1).$pgSel_parameters.'" class="zenPageButton">&raquo;</a>';}?>
        </td>
        <td width="50">
        	<?php
 if($page<ceil($jumlahData/$productPerPage)){echo '<a href="'.$pfile.'?page='.$makz.$pgSel_parameters.'" class="zenPageButton" style="float: right;">Last</a>';}?>
        </td>
    </tr>
</table>
</div>