<?php
 include('ue-includes/ue-ses_check.php');$auPostedElements=array();foreach($_GET as $postedElementsKey=>$postedElementsVal){$auPostedElements["$postedElementsKey"]=ue_real_escape_string($postedElementsVal);}$id=$auPostedElements['id'];$table=$auPostedElements['targetdatabasename'];$page=$auPostedElements['frompage'];$type=$auPostedElements['action'];$idColumnName=$auPostedElements['targetcolumnid'];$enabledColumnName=$auPostedElements['targetcolumnname'];if($id==''){header("Location: $page".pageParamsFormat($pageParamsArr));break;}else{if($type=='d'){$query="UPDATE ".$table." SET ".$enabledColumnName." = 'd' WHERE ".$idColumnName." = ".$id;}else if($type=='e'){$query="UPDATE ".$table." SET ".$enabledColumnName." = 'e' WHERE ".$idColumnName." = ".$id;}@$quecek=ue_query($query." LIMIT 1");}if($auPostedElements['editpageid']!=''){$headerLocationAddStr='&id='.$auPostedElements['editpageid'].'&detailmode=edit';}switch($table){default:if($quecek){header("Location: $page".pageParamsFormat($pageParamsArr)."&sta=ok".$headerLocationAddStr);}else{header("Location: $page".pageParamsFormat($pageParamsArr)."&err=Failed to Change Status".$headerLocationAddStr);}break;}?>