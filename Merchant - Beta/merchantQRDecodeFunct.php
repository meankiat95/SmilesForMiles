<?php

include '../Cryptography/encryptDecrypt.php';



	$qrcontent = $_POST['qrcontent'];
	$key ='Smile4MilesSecretKey';
	$decryptedContent = AES256CBCDecryption($qrcontent);
	echo ("<script LANGUAGE='JavaScript'> window.alert('Decrypted QRCode Content = " .$decryptedContent. "');</script>");


?>  