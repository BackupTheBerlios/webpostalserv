<?php
require_once 'PostOffice.php';

/*
 *The Exchange Protocol password is needed for message Signature  
 */
$password=getPassword();

function getPassword(){
//TODO Implement here a method to get the password;
//this is an example return
return 'password';
}


/*
 * 
 * Arguments:
 * $messageName:
 * $authorName: used to identify the message Author during the exchange
 * $password: a password known by both exchange parties which is used to sign the message
 * $envelopeFormat: the format of the envelope. currently only SOAP1.1 is supported
 * $destinationURL: the URL of the destination web server 
 */

function createMessageHeader($messageName,$authorName,$password,$envelopeFormat){

$messageHeader=array();
$messageHeader['messageName']=$messageName;
$messageHeader['authorName']=$authorName;
$messageHeader['password']=$password;
$messageHeader['envelopeFormat']=$envelopeFormat;
$messageHeader['destinationURL']=$destinationURL;
return $messageHeader;
}

/*
 * Arguments:
 * WARNING: Currently only the XML format is supported and therefore, $body should contain an XML string
 * additionally $bodyArray is not implemented
 * $body : 
 * $bodyFormat : defines the  format of the $body variable, 
 * $bodyArray : the body stored as an associative array for ease of use
 */
function createMessageBody($body,$bodyFormat,$bodyArray){
$messageBody=array();
$messageBody['bodyFormat']=$bodyFormat;
$messageBody['body']=$body;
$messageBody['bodyArray']=$bodyArray;
return $messageBody;
}

/*
 * 
 *WARNING:  LAMPADAIRE  currently only produces the exception and body parts of the array as XML strings 
 *Arguments:
 *$signatureCheck: boolean, true is the check was successful, false if failure
 *$exchangeStatus: take the value  'EXCHANGE_OK' if the other party received the message correctly, take the value 'EXCHANGE_FAILED' if the other party failed to understand the message 
 *$exception: in case the exchange failed,  this field can contain an exception  
 *$body: in case the exchange is successful, some responses can contain a body
 * return: an ExchangeReceipt array created by the function createExchangeReceipt  
 * 
 */

function createExchangeReceipt($signatureCheckStatus, $exchangeStatus, $exception, $body){
$exchangeReceipt=array();
$exchangeReceipt['signatureCheckStatus']=$signatureCheckStatus;
$exchangeReceipt['exchangeStatus']=$exchangeStatus;
$exchangeReceipt['exception']=$exception;
if(!$signatureCheckStatus)$exchangeReceipt['exception']=SIGNATURE_EXCEPTION;
$exchangeReceipt['body']=$body;
return $exchangeReceipt;
}

/*
 *Arguments:
 *$messageHeader: array produced by the function createMessageHeader
 *$messageBody : array produced by the function createMessageBody
 * 
 *return: an ExchangeReceipt array created by the function createExchangeReceipt  
 * 
 **/
function sendMessageAndGetReceipt($messageHeader, $messageBody){
return postMessageAndGetReceipt($messageHeader, $messageBody);
}


/*
 *Arguments:
 *$messageHeader: array produced by the function createMessageHeader
 *$messageBody : array produced by the function createMessageBody
 * 
 *return: an ExchangeReceipt array created by the function createExchangeReceipt  
 * 
 **/
function receiveMessageAndGiveReceipt($messageHeader, $messageBody){
// TODO implement here a link with your system to handle the received message and create the exchange receipt;
//  this is an example return
return createExchangeReceipt(null, 'EXCHANGE_OK', null, null);
}
?>