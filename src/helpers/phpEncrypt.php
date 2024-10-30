<?php

use Defuse\Crypto\Key;
use Defuse\Crypto\Crypto;

/**
* Encrypt plain string
* 
* @param type $string
* @return type
*/
function encrypt_string($string) {
   $key = loadEncryptionKeyFromConfig();
   return Crypto::encrypt($string, $key);
}

/**
* Decrypt encrypted string
* 
* @param type $encryptedString
* @return type
*/
function decrypt_string($encryptedString) {
   $key = loadEncryptionKeyFromConfig();
   
   try {
       return Crypto::decrypt($encryptedString, $key);
   } catch (\Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException $ex) {

       //Log error message
       log_error(json_encode([
           'encryption_key' => $key,
           'exception' => $ex
       ]));
       
       return false;
   }
}

/**
* Load encryption key
* 
* @return type
*/
function loadEncryptionKeyFromConfig() {
   return Key::loadFromAsciiSafeString(getenv('ENCRYPTION_KEY'));
}