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

class Body extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/User_api_model', 'user');
        $this->load->helper(['jwt', 'authorization']);
    }

    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    public function bmi_get($date='')
    {

        $jwt_token = $this->jwt_decode($this->jwt_token());
        //$pid = 'user@gmail.com';
        $pid = $jwt_token['username'];
        if($date != ''){
          $sub_month = substr($date, 4, 2);
          $sub_day = substr($date, 6, 2);
          $sub_year = substr($date, 0, 4);
          $date = $sub_year."-".$sub_month."-".$sub_day;
        }else{
          $date = date('Y-m-d');
        }
        $res = $this->user->getBMI($pid, $date);

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

    public function data_post()
    {
      $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
      $request = json_decode($stream_clean);


      $jwt_token = $this->jwt_decode($this->jwt_token());
      $user_id = $jwt_token['user_id'];

      $arr_data_weight = array();
      $arr_data_weight['user_id'] = $user_id;
      $arr_data_weight['user_add'] = $user_id;
      $arr_data_weight['date_exam'] = $request->date_exam.' '.date('H:i:s');
      $arr_data_weight['user_weight'] = $request->user_weight;
      $arr_data_weight['fag_allow'] = 'allow';
      $res = $this->user->saveWeight($arr_data_weight);

      $arr_data_waist = array();
      $arr_data_waist['user_id'] = $user_id;
      $arr_data_waist['user_add'] = $user_id;
      $arr_data_waist['date_exam'] = $request->date_exam.' '.date('H:i:s');
      $arr_data_waist['user_waist'] = $request->user_waist;
      $arr_data_waist['fag_allow'] = 'allow';
      $res = $this->user->saveWaistline($arr_data_waist);

      $arr_data_hip = array();
      $arr_data_hip['user_id'] = $user_id;
      $arr_data_hip['user_add'] = $user_id;
      $arr_data_hip['date_exam'] = $request->date_exam.' '.date('H:i:s');
      $arr_data_hip['user_hib'] = $request->user_hip;
      $arr_data_hip['fag_allow'] = 'allow';
      $res = $this->user->saveHip($arr_data_hip);

      $output = array();
      if ($res) {
          $output['status'] = true;
          $output['data'] = $res;
          return $this->response($output, REST_Controller::HTTP_OK);
      }

      $output['status'] = false;
      return $this->set_response($output, REST_Controller::HTTP_UNAUTHORIZED);
    }


}
