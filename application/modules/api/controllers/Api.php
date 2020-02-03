<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Api_model', 'api');
    }

    public function news_get()
    {

        $headers = $this->input->request_headers();

        if (array_key_exists('authorization', $headers) && !empty($headers['authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['authorization']);
            if ($decodedToken != false) {
                $output = array();
                $output = $this->api->getNews();
                return $this->set_response($output, REST_Controller::HTTP_OK);
            }

        }

        return $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

    }

    public function enterprise_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('authorization', $headers) && !empty($headers['authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['authorization']);
            if ($decodedToken != false) {
                $output = array();
                $id = '';
                $output = $this->api->getEnterprises($id);
                return $this->set_response($output, REST_Controller::HTTP_OK);
            }

        } else {
            $id = $this->input->get('id');
            $output = $this->api->getEnterprises($id);
            return $this->set_response($output, REST_Controller::HTTP_OK);
        }

        return $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

    }

}
