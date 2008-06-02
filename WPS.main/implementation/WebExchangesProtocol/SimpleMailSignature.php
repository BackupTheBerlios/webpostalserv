<?php

require_once 'Configuration.php';


function simpleSignMessage($password, $body)
{   if(!WITH_SIGNATURE)return;
	$textEncrypted=cryptMail($body);
	return cryptMail($textEncrypted.$password);
}

function cryptMail($text)
{
	$cypher = sha1($text);
    $rawCypher = '';
    for ($i = 0; $i < strlen($cypher); $i += 2) {
    	$hexCode = substr($cypher, $i, 2);
        $charCode = base_convert($hexCode, 16, 10);
        $rawCypher .= base64_encode($charCode);
    }
    return $rawCypher;
}

function simpleCheckMessageSignature($password, $body, $signature)
{
	if(!WITH_SIGNATURE)
		return true;
    $computedSignature=simpleSignMessage($password, $body);
    
    return $computedSignature==$signature;
}

?>