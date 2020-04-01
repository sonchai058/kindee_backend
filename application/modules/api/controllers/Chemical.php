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

class Chemical extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Chemical_api_model', 'chemical');
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
        $res = $this->chemical->getChemical($pid, $date);

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
      $arr_data['exam_date'] = $request->exam_date;
      $arr_data['fasting_glu'] = $request->fasting_glu;
      $arr_data['hemo_glo'] = $request->hemo_glo;
      $arr_data['kidney_blood'] = $request->kidney_blood;
      $arr_data['uric_arid'] = $request->uric_arid;
      $arr_data['hdl_chol'] = $request->hdl_chol;
      $arr_data['ldl_chol'] = $request->ldl_chol;
      $arr_data['trig_cer'] = $request->trig_cer;
      $res = $this->chemical->save($arr_data);

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
      $arr_data['exam_date'] = $request->exam_date;
      $arr_data['fasting_glu'] = $request->fasting_glu;
      $arr_data['hemo_glo'] = $request->hemo_glo;
      $arr_data['kidney_blood'] = $request->kidney_blood;
      $arr_data['uric_arid'] = $request->uric_arid;
      $arr_data['hdl_chol'] = $request->hdl_chol;
      $arr_data['ldl_chol'] = $request->ldl_chol;
      $arr_data['trig_cer'] = $request->trig_cer;
      $arr_where['exam_id'] = $request->exam_id;
      $res = $this->chemical->save($arr_data,$arr_where);

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
