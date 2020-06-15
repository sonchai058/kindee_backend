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

class Shops extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Shops_api_model', 'shops');
        $this->load->helper(['jwt', 'authorization']);
    }

    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    public function info_get($date='')
    {

        $jwt_token = $this->jwt_decode($this->jwt_token());
        //$pid = 'user@gmail.com';
        $pid = $jwt_token['username'];

        $res = $this->shops->getShops();

        $output = array();
        if ($res) {
            $output['status'] = true;
            $output['data'] = $res;
            $output['token'] = $this->jwt_token();
            return $this->response($output, REST_Controller::HTTP_OK);
        }

        $output['status'] = false;
        return $this->set_response($output, REST_Controller::HTTP_UNAUTHORIZED);

    }

    public function detail_get($shop_id='')
    {

        $jwt_token = $this->jwt_decode($this->jwt_token());
        //$pid = 'user@gmail.com';
        $pid = $jwt_token['username'];

        $res = $this->shops->getShopDetail($shop_id);

        $output = array();
        if ($res) {
            $output['status'] = true;
            $output['data'] = $res;
            $output['token'] = $this->jwt_token();
            return $this->response($output, REST_Controller::HTTP_OK);
        }

        $output['status'] = false;
        return $this->set_response($output, REST_Controller::HTTP_UNAUTHORIZED);

    }


}
