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

class Food extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Food_api_model', 'food');
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
        $res = $this->food->getFood($pid, $date);

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

    public function food_menu_get($food_source='')
    {
      $food_source_type = '';
      if($food_source==1){
        $food_source_type = 'เมนูจากระบบ';
      }else if($food_source==2){
        $food_source_type = 'เมนูปรุงเอง';
      }else if($food_source==3){
        $food_source_type = 'เมนูร้านอาหาร';
      }
      $res = $this->food->getFoodMenu($food_source_type);

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
      $arr_data['date_eat'] = $request->date_eat;
      $arr_data['eat_time'] = $request->eat_time;
      $arr_data['food_source'] = $request->food_source;
      $arr_data['food_id'] = $request->food_id;
      $arr_data['food_energy'] = str_replace(',','',$request->food_energy);
      $arr_data['fag_allow'] = 'allow';
      $res = $this->food->save($arr_data);

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
