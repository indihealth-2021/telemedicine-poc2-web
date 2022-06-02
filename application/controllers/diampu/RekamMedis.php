<?php
defined('BASEPATH') or exit('Direct script access not allowed');

class RekamMedis extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('RekamMedis_model');
        $this->load->library('all_controllers');
    }

    public function detail($id_pasien, $id_jadwal_konsultasi){
        $this->all_controllers->check_user_diampu();
        $data = $this->all_controllers->get_data_view(
            'Ditel Rekam Medis',
            'diampu/detail_rekam_medis'
        );

        $data['rekam_medis'] = $this->RekamMedis_model->get($id_pasien, $id_jadwal_konsultasi);
        
        $this->load->view('template', $data);
    }
}