<?php
function checkMembership($userId){
	$fUser = ue_fetch_array(ue_query("SELECT * FROM user WHERE user_id = '".$userId."' LIMIT 1"));
	$ret = "";
	if($fUser['user_membershiptype'] == "investors"){
		if($fUser['user_expiry'] == "0" or $fUser['user_expiry'] < time() or $fUser['user_membershipid'] == "0"){
			$ret = "<span>FREE ANGEL</span>";
		}else{
			if($fUser['user_membershipid'] == "1"){
				$ret = "<span style='color:#00bff3;'>STARTUP ANGEL</span>";
			}else{
				$ret = "<span style='color:#a186be;'>CORPORATE ANGEL</span>";
			}
		} 
	}else{
		if($fUser['user_expiry'] == "0" or $fUser['user_expiry'] < time() or $fUser['user_membershipid'] == "0"){
			$ret = "<span>FREE SOCIAL ENTERPRISES</span>";
		}else{
			$ret = "<span style='color:#00bff3;'>PREMIUM SOCIAL ENTERPRISES</span>";
		}	
	}
	return $ret;
}

function getMembership($type,$membershipid){
	$ret = "";
	if($type == "investors"){
		if($membershipid == "1"){
			$ret = "<span style='color:#00bff3;'>STARTUP ANGEL</span>";
		}else if($membershipid == "2"){
			$ret = "<span style='color:#a186be;'>CORPORATE ANGEL</span>";
		}else{
			$ret = "<span>FREE ANGEL</span>";
		}
	}else{
		if($membershipid == "0"){
			$ret = "<span>FREE SOCIAL ENTERPRISES</span>";
		}else{
			$ret = "<span style='color:#00bff3;'>PREMIUM SOCIAL ENTERPRISES</span>";
		}	
	}
	return $ret;
}

?>