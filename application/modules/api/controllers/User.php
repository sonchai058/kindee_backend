<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

/*
 * Changes:
 * 1. This project contains .htaccess file for windows machine.
 *    Please update as per your requirements.
 *    Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva
 *
 * 2. Change 'encryption_key' in application\config\config.php
 *    Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
 *
 * 3. Change 'jwt_key' in application\config\jwt.php
 *
 */

class User extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/User_api_model', 'user');
    }

    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
     public function userinfo_get()
     {

       $jwt_token = $this->jwt_decode($this->jwt_token());
       $pid = $jwt_token['username'];
       $res = $this->user->getInfo($pid);
       $output = array();
       if ($res) {
           $output['status'] = true;
           $output['data'] = $res;

           return $this->set_response($output, REST_Controller::HTTP_OK);
       }
       $output['status'] = false;
       return $this->set_response($output, REST_Controller::HTTP_UNAUTHORIZED);
     }




}