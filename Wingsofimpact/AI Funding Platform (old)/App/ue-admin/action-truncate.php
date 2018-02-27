<?php
 include('ue-includes/ue-ses_check.php');$auPostedElements=array();foreach($_GET as $postedElementsKey=>$postedElementsVal){$auPostedElements["$postedElementsKey"]=ueReceiveInput($postedElementsKey,$postedElementsVal);}$table='purchase';$page='purchase.php';$idColumnName=$table.'_id';$targetDate=strtotime(date('j').' '.date('F').' '.date('Y').' 23:59')-2592000;$query="DELETE FROM ".$table." WHERE
		".$table."_status = 'r' AND
		".$table."_entrydate <= '$targetDate'
	";@$quecek=ue_query($query);if($quecek){header("Location: $page".pageParamsFormat($pageParamsArr)."&sta=ok".$headerLocationAddStr);}else{header("Location: $page".pageParamsFormat($pageParamsArr)."&err=Delete Failed".$headerLocationAddStr);}?>