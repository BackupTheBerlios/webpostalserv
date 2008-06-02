<?php

/*
 * If true , the exchange is done with signature of messages and signature check
 * 
 * */
define(WITH_SSL,true);

/*
 * If true , messages are secured with signatures 
 * 
 * */
define(WITH_SIGNATURE,true);


/*
 *  change this constant to the file you want to use implementing your post office;
 * 
 * */
define(POST_OFFICE_IMPLEMENTATION,'implementation/WebExchangesProtocol/SimplePostOffice.php');

/*
 *  change this constant to the file you want to use implementing your post office;
 * 
 * */
define(MAIL_SIGNATURE_IMPLEMENTATION,'implementation/WebExchangesProtocol/SimpleMailSignature.php');

/*
 * change this constant to the XML namespace defining your Exchange protocol 
 * 
 * */
define(XML_NAMESPACE_URL,'http://www.pantouflette.fr/lampadaire/webexchanges');

/*
 * Definition of the Message Signature Check Failure excetion
 * 
 * */
define(SIGNATURE_EXCEPTION,'<exception><name>SIGNATURE CHECK<name></exception>');


?>