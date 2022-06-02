<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diampu extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('pengampu_model');

        $this->load->library('all_controllers');
    }

    public function list_pengampu(){
        $this->all_controllers->check_user_diampu();
        $data = $this->all_controllers->get_data_view(
                    'List Pengampu',
                    'diampu/list_pengampu'
                );

        $data['list_pengampu'] = $this->pengampu_model->get_all();

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                            <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                            <script>
                            $(document).ready(function () {
                                $("#table_list_pengampu").DataTable({
                                "responsive": true,
                                "autoWidth": false,
                                "lengthChange": false,
                                "searching": true,
                                "pageLength": 5,
                                });
                            });
                            </script>';

        $this->load->view('template', $data);
    }
}