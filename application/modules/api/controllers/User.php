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

     public function data_put()
     {
       $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
       $request = json_decode($stream_clean);

       $jwt_token = $this->jwt_decode($this->jwt_token());
       $user_id = $jwt_token['user_id'];
       $arr_data = array();
       $arr_data['title_name'] = $request->title_name;
       $arr_data['user_fname'] = $request->user_fname;
       $arr_data['user_lname'] = $request->user_lname;
       $arr_data['date_of_birth'] = $request->date_of_birth;
       $arr_data['mobile_no'] = $request->mobile_no;
       if($request->password != ''){
         $arr_data['password'] = $request->password;
       }
       $arr_data['user_sex'] = $request->user_sex;
       $arr_data['user_height'] = $request->user_height;

       $arr_where['user_id'] = $user_id;
       $res = $this->user->save($arr_data,$arr_where);

       $output = array();
       if ($res) {
           $output['status'] = true;
           $output['data'] = $res;
           return $this->response($output, REST_Controller::HTTP_OK);
       }else{
           $output['status'] = true;
           $output['data'] = $res;
           return $this->response($output, REST_Controller::HTTP_OK);
       }

       $output['status'] = false;
       return $this->set_response($output, REST_Controller::HTTP_UNAUTHORIZED);
     }


}
