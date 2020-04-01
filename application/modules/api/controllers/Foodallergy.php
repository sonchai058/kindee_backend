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

class Foodallergy extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Foodallergy_api_model', 'foodallergy');
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
        if($date != ''){
          $sub_month = substr($date, 4, 2);
          $sub_day = substr($date, 6, 2);
          $sub_year = substr($date, 0, 4);
          $date = $sub_year."-".$sub_month."-".$sub_day;
        }else{
          $date = date('Y-m-d');
        }
        $res = $this->foodallergy->getFoodallergy($pid, $date);

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

    public function foodallergylist_get()
    {
      $res = $this->foodallergy->getFoodallergyList();

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

    public function foodallergydetail_get($id='')
    {
      $res = $this->foodallergy->getFoodallergyDetail($id);

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
      $arr_data = array();
      $arr_data['user_id'] = $user_id;
      $arr_data['user_add'] = $user_id;
      $arr_data['alg_id'] = $request->alg_id;
      $arr_data['food_alg_val'] = $request->food_alg_val;
      $arr_data['fag_allow'] = 'allow';
      $res = $this->foodallergy->save($arr_data);

      $output = array();
      if ($res) {
          $output['status'] = true;
          $output['data'] = $res;
          return $this->response($output, REST_Controller::HTTP_OK);
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
      $arr_data['user_id'] = $user_id;
      $arr_data['user_add'] = $user_id;
      $arr_data['alg_id'] = $request->alg_id;
      $arr_data['food_alg_val'] = $request->food_alg_val;
      $arr_data['fag_allow'] = 'allow';
      $arr_where['exam_id'] = $request->exam_id;
      $res = $this->foodallergy->save($arr_data,$arr_where);

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
