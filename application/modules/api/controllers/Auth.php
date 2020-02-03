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

class Auth extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Login_api_model', 'auth');
        $this->load->helper(['jwt', 'authorization']);
    }

    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    public function login_post()
    {

        $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
        $request = json_decode($stream_clean);

        $pid = $request->username;
        $passcode = $request->password;


        $res = $this->auth->getLogin($pid, $passcode);

        $output = array();
        if ($res) {
            $output['status'] = true;
            $output['data'] = $res;
            $output['token'] = AUTHORIZATION::generateToken($res['user_id']);
            return $this->set_response($output, REST_Controller::HTTP_OK);
        }
        $output['status'] = false;
        return $this->set_response($output, REST_Controller::HTTP_UNAUTHORIZED);


    }

       /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: POST
     * Header Key: Authorization
     * Value: Auth token generated in GET call
     */

    public function logout_delete()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('authorization', $headers) && !empty($headers['authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['authorization']);
            if ($decodedToken != false) {
                $output = array();
                $res = $this->auth->getLogout($decodedToken);
                if ($res) {
                    $output['status'] = true;
                    return $this->set_response('success', REST_Controller::HTTP_OK);
                } else {
                    $output['status'] = false;
                    return $this->set_response('success', REST_Controller::HTTP_OK);
                }

                return;
            }

        }

        return $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }



}
