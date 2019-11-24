<?php

function AES256CBCEncryption($plainTxt){
	

	#validateEnoughPoints ($rewardID , $userID); //Will either redeem or fail to redeem - rewardRedemption.php
	
	$method = 'AES-256-CBC';
	$key = getenv('Smile4MilesSecretKey');


	#Generate an Initialization Vector (IV)
	$length = openssl_cipher_iv_length($method);
	$iv = openssl_random_pseudo_bytes($length);
	
	#Perform encryption
	$encrypted = openssl_encrypt($plainTxt, $method, $key, OPENSSL_RAW_DATA, $iv);
	
	#Encode IV into Encrypted text (the IV is now together with encrypted text)
	$cipherTxt = base64_encode($encrypted) . '|' . base64_encode($iv);
	
	return $cipherTxt;
}

function AES256CBCDecryption($ctxt){
	$method = 'AES-256-CBC';
	$key = getenv('Smile4MilesSecretKey');
	#separate IV from encrypted text
	list($encryptedText, $iv) = explode('|', $ctxt);
	$IV = base64_decode($iv);
	
	$decrypted = openssl_decrypt($encryptedText, $method, $key, 0, $IV);
	
	return $decrypted;
}

?>  