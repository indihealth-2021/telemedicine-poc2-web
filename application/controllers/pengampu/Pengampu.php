<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengampu extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('all_controllers');
    }

    public function index(){
        $this->all_controllers->check_user_pengampu();
        $data = $this->all_controllers->get_data_view(
            'Pengampu',
            'pengampu/index'
        );

        $this->load->view('template', $data);
    }
}