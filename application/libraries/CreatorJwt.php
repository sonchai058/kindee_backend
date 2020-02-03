<?php
//application/libraries/CreatorJwt.php
// require APPPATH . '/libraries/JWT.php';
require_once "Jwt/JWTapi.php";

class CreatorJwt
{

    /*************This function generate token private key**************/

    private $key = "1234567890qwertyuiopmnbvcxzasdfghjkl";
    public function GenerateToken($data)
    {
        $jwt = JWTapi::encode($data, $this->key);
        return $jwt;
    }

    /*************This function DecodeToken token **************/

    public function DecodeToken($token)
    {
        $decoded = JWTapi::decode($token, $this->key, array('HS256'));
        $decodedData = (array) $decoded;
        return $decodedData;
    }
}
