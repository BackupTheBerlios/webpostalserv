<?php
require_once '../implementation/WebExchangesProtocol/Configuration.php';
require_once '../'.MAIL_SIGNATURE_IMPLEMENTATION;

/*
 * 
 * Arguments: 
 * $password: shared  password by both parties, given during the protocol establishment  
 * $body: the message body ready to be put into the message
 * returns: a character chain  
 */
 function signMessage($password, $body) {
 return simpleSignMessage($password, $body);
 }
/*
 * 
 * Arguments: 
 * $password: shared  password by both parties, given during the protocol establishment  
 * $body: 
 * returns: a boolean value, true is check was successful, false otherwise
 */
  function checkMessageSignature($password, $body, $signature){
  return simpleCheckMessageSignature($password, $body, $signature);
  }

?>