<?php

require_once '../implementation/WebExchangesProtocol/Configuration.php';
require_once '../'.POST_OFFICE_IMPLEMENTATION;
require_once 'PublicInterface.php';
/*
 * Arguments:
 * $messageHeader : array defined in the 'PublicInterface.php' file
 * $messageBody : array defined in the 'PublicInterface.php' file
 * returns: an exchangeReceipt array defined in the 'PublicInterface.php' file
 */
function postMessageAndGetResponse($messageHeader, $messageBody){
 return simplePostMessageAndGetResponse($messageHeader, $messageBody);
}

/*
 * Arguments:
 * $messageHeader : array defined in the 'PublicInterface.php' file
 * $messageBody : array defined in the 'PublicInterface.php' file
 * returns: an exchangeReceipt array defined in the 'PublicInterface.php' file
 */
function sendEnvelopeAndReceiveResponse($envelope,$messageHeader){
 	return simpleSendEnvelopeAndReceiveResponse($envelope,$messageHeader);
 }
 /*
 * Arguments:
 * $messageHeader : array defined in the 'PublicInterface.php' file
 * $messageBody : array defined in the 'PublicInterface.php' file
 * returns: an exchangeReceipt array defined in the 'PublicInterface.php' file
 */

 function putMessageIntoEnvelope($message, $messageHeader){
 	return simplePutMessageIntoEnvelope($message, $messageHeader);
}
 
/*
 * Arguments:
 * $messageHeader : array defined in the 'PublicInterface.php' file
 * $messageBody : array defined in the 'PublicInterface.php' file
 * returns: an exchangeReceipt array defined in the 'PublicInterface.php' file
 */
function  createMessage($messageHeader,$messageBody){
 return simpleCreateMessage($messageHeader,$messageBody); 
}

/*
 * Arguments:
 * $messageHeader : array defined in the 'PublicInterface.php' file
 * $messageBody : array defined in the 'PublicInterface.php' file
 * returns: an exchangeReceipt array defined in the 'PublicInterface.php' file
 */
function receiveEnvelopeAndGiveReceipt($envelope,$password){
	return simpleReceiveEnvelopeAndGiveReceipt($envelope,$password);
	
}
/*
 * Arguments:
 * $messageHeader : array defined in the 'PublicInterface.php' file
 * $messageBody : array defined in the 'PublicInterface.php' file
 * returns: an exchangeReceipt array defined in the 'PublicInterface.php' file
 */
 function getMessageFromEnvelope($envelope){
 	return simpleGetMessageFromEnvelope($envelope);
}
/*
 * Arguments:
 * $messageHeader : array defined in the 'PublicInterface.php' file
 * $messageBody : array defined in the 'PublicInterface.php' file
 * returns: an exchangeReceipt array defined in the 'PublicInterface.php' file
 */

 function getMessageNameFromMessage($message){
 	return simpleGetMessageNameFromMessage($message);
}
/*
 * Arguments:
 * $messageHeader : array defined in the 'PublicInterface.php' file
 * $messageBody : array defined in the 'PublicInterface.php' file
 * returns: an exchangeReceipt array defined in the 'PublicInterface.php' file
 */

 function getAuthorNameFromMessage($message){
 	return simpleGetAuthorNameFromMessage($message);
}

/*
 * Arguments:
 * $messageHeader : array defined in the 'PublicInterface.php' file
 * $messageBody : array defined in the 'PublicInterface.php' file
 * returns: an exchangeReceipt array defined in the 'PublicInterface.php' file
 */
 function getSignatureFromMessage($message){
 	return simpleGetSignatureFromMessage($message);
}
/*
 * Arguments:
 * $message.
 * Body : array defined in the 'PublicInterface.php' file
 * returns: the  defined in the 'PublicInterface.php' file
 */
 function getMessageBodyFromMessage($message){
 	return simpleGetMessageBodyFromMessage($message);
}

/*
 * Arguments:
 * $exchqngeReceipt : array defined in the 'PublicInterface.php' file
 * returns: a ready to be read exchange receipt
 */
function writeExchangeReceipt($exchangeReceipt){
 return simpleWriteExchangeReceipt($exchangeReceipt);
}

?>