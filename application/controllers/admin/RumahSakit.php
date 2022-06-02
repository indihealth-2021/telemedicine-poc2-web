<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RumahSakit extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('RumahSakit_model');
        $this->load->library('all_controllers');
    }

    public function users(){
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Master User RS",
            $view="admin/manage_users_rs"
        );

        $data['users'] = $this->RumahSakit_model->get_all_users();

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                            <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                            <script>
                            $(document).ready(function () {
                                let table_users = $("#table_users").DataTable({
                                "responsive": true,
                                "autoWidth": false,
                                "lengthChange": false,
                                "searching": true,
                                "pageLength": 5,
                                });
                                $("#table_users_filter").remove();
                                $("#search").on("keyup", function(e){
                                  table_users.search($(this).val()).draw();
                                });


                                $("#modalHapus").on("show.bs.modal", function(e) {
                                    var nama = $(e.relatedTarget).data("nama");
                                    $(e.currentTarget).find("#nama").html(nama);

                                    var href_input = $(e.relatedTarget).data("href");
                                    $(e.currentTarget).find("#buttonHapus").attr("href", href_input);
                                });
                            });
                            </script>';

        $this->load->view('template', $data);
    }

    //--- TAMBAH --//
    public function form_tambah(){
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Tambah Master User RS",
            $view="admin/form_user_rs"
        );

        $this->load->view('template', $data);
    }
    public function tambah_user(){
        $this->all_controllers->check_user_admin();

        $data = $this->input->post();
        $data_form = $this->input->post();
        unset($data['confirmasipassword']);

        $data["password"] = md5($data["password"]);

        $isUsernameExists = $this->db->query('SELECT id FROM master_user WHERE username="' . $data['username'] . '"')->row();
        $isEmailExists = $this->db->query('SELECT id FROM master_user WHERE email="' . $data['email'] . '"')->row();
        if ($isUsernameExists && $isEmailExists) {
            $result->message = 'GAGAL: Username dan Email sudah digunakan!';
            $this->session->set_flashdata('msg_add_user', $result->message);
            $this->session->set_flashdata('old_form', $data_form);
            $this->session->set_flashdata('error', 'usernameAndEmail');
            redirect(base_url('admin/RumahSakit/form_tambah'));
        } else if ($isUsernameExists) {
            $result->message = 'GAGAL: Username sudah digunakan!';
            $this->session->set_flashdata('msg_add_user', $result->message);
            $this->session->set_flashdata('old_form', $data_form);
            $this->session->set_flashdata('error', 'username');
            redirect(base_url('admin/RumahSakit/form_tambah'));
        } else if ($isEmailExists) {
            $result->message = 'GAGAL: Email sudah digunakan!';
            $this->session->set_flashdata('msg_add_user', $result->message);
            $this->session->set_flashdata('old_form', $data_form);
            $this->session->set_flashdata('error', 'email');
            redirect(base_url('admin/RumahSakit/form_tambah'));
        }

        if($this->RumahSakit_model->insert_user($data) == 1){
            $result->message = 'BERHASIL: Akun berhasil ditambahkan!';
            $this->session->set_flashdata('msg_user', $result->message);
            // TAMBAH KE ACTIVITY LOG DENGAN NAMA ACTIVITY = Menambahkan Admin
            $this->load->library('user_agent');

            if ($this->agent->is_browser()) {
                $agent = $this->agent->browser() . ' ' . $this->agent->version();
            } elseif ($this->agent->is_robot()) {
                $agent = $this->agent->robot();
            } elseif ($this->agent->is_mobile()) {
                $agent = $this->agent->mobile();
            } else {
                $agent = 'Unidentified User Agent';
            }

            $ip_address = $this->input->ip_address();

            $data = array(
                "id_user" => $this->session->userdata('id_user'),
                "ip" => $ip_address,
                "user_agent" => $agent,
                "activity" => 'Menambahkan User RS'
            );

            $this->db->insert('log_activity', $data);
            // ============================================================ //

            redirect(base_url('admin/RumahSakit/users'));
        }else{
            $result->message = 'GAGAL: Akun gagal ditambahkan!';
            $this->session->set_flashdata('msg_user', $result->message);
            redirect(base_url('admin/RumahSakit/users'));
        }
    }
    //------//

    //---- EDIT --//
    public function form_edit_user($id){
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Edit Master User RS",
            $view="admin/form_edit_user_rs"
        );

        $data['user_rs'] = $this->RumahSakit_model->get_user($id);

        $this->load->view('template', $data);
    }
    public function edit_user($id){
        $this->all_controllers->check_user_admin();

        $data = $this->input->post();
        $isUsernameExists = $this->db->query('SELECT id FROM master_user WHERE username = "' . $data['username'] . '"')->row();
        $isEmailExists = $this->db->query('SELECT id FROM master_user WHERE email = "' . $data['email'] . '"')->row();
        $this_user = $this->db->query('SELECT username, email FROM master_user WHERE id = ' . $id)->row();
        if (($isUsernameExists && $data['username'] != $this_user->username) && ($isEmailExists && $data['email'] != $this_user->email)) {
            $result->message = 'GAGAL: Username dan Email sudah digunakan!';
            $this->session->set_flashdata('msg_edit_user', $result->message);
            $this->session->set_flashdata('error', 'usernameAndEmail');
            redirect(base_url('admin/RumahSakit/form_edit_user/' . $id));
        } else if ($isUsernameExists && $data['username'] != $this_user->username) {
            $result->message = 'GAGAL: Username sudah digunakan!';
            $this->session->set_flashdata('msg_edit_user', $result->message);
            $this->session->set_flashdata('error', 'username');
            redirect(base_url('admin/RumahSakit/form_edit_user/' . $id));
        } else if ($isEmailExists && $data['email'] != $this_user->email) {
            $result->message = 'GAGAL: Email sudah digunakan!';
            $this->session->set_flashdata('msg_edit_user', $result->message);
            $this->session->set_flashdata('error', 'email');
            redirect(base_url('admin/RumahSakit/form_edit_user/' . $id));
        }

        if($this->RumahSakit_model->update_user($id, $data) == 1){
            $this->session->set_flashdata('msg_user', 'BERHASIL: Akun telah diperbarui!');
        }else{
            $this->session->set_flashdata('msg_user', 'GAGAL: Akun tidak ada yang diperbarui!');
        }

        redirect(base_url('admin/RumahSakit/users'));
    }
    //-----------//

    public function hapus_user($id){
        if($this->RumahSakit_model->delete_user($id) == 1){
            $this->session->set_flashdata('msg_user', 'BERHASIL: Akun telah dihapus!');
        }else{
            $this->session->set_flashdata('msg_user', 'GAGAL: Akun gagal dihapus!');
        }
        redirect(base_url('admin/RumahSakit/users'));
    }

}