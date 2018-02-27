<?php
$params = array(
			"testmode"   => "on",
			"private_live_key" => "sk_live_GelqjDp7qsvSW5qptJAQ5jeE",
			"public_live_key"  => "pk_live_tdxmCA3liM0inktMkwS9QtV9",
			"private_test_key" => "sk_test_vtR8t4Rbfp4ZhGgL5xSaI1xa",
			"public_test_key"  => "pk_test_XGg0CLzgN28PTtVMXUFUEdnG"
			);

if ($params['testmode'] == "on") {
	Stripe::setApiKey($params['private_test_key']);
	$pubkey = $params['public_test_key'];
} else {
	Stripe::setApiKey($params['private_live_key']);
	$pubkey = $params['public_live_key'];
}

?>