<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('login_model');
    }

    public function index() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            redirect(base_url() . 'Members');
        }
        $data = array(
            'title' => "DevToFriend - Login"
        );
        
        $this->load->view('dist/auth-login', $data);
    }

    public function Login_Auth() {
        $response = array();
        //Recieving post input of email, password from request
        $email = $this->input->post('email');
        $password = sha1($this->input->post('password'));
        //$remember = $this->input->post('remember');

        #Login input validation\
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('email', 'User Email', 'trim|xss_clean|required|min_length[7]');
        $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', 'Email/Password combination is invalid.');
            redirect(base_url() . 'Login', 'refresh');
        } else {
            //Validating login
            $login_status = $this->validate_login($email, $password);
            $response['login_status'] = $login_status;
            if ($login_status == 'success') {
                if (isset($_COOKIE['email'])) {
                    setcookie('email', ' ');
                }
                if (isset($_COOKIE['password'])) {
                    setcookie('password', ' ');
                }
                redirect(base_url() . 'Login', 'refresh');
            } else {
                $this->session->set_flashdata('feedback', 'Email/Password combination is invalid.');
                redirect(base_url() . 'Login', 'refresh');
            }
        }
    }

    // Validating login from request
    function validate_login($email = '', $password = '') {
        $credential = array('USER_EMAIL' => $email, 'USER_PASS' => $password, 'ACTIVE_STAT_FLG' => 'A');
        $query = $this->login_model->getUserForLogin($credential);
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('userLoginAccess', '1');
            $this->session->set_userdata('userEmail', $row->USER_EMAIL);
            $this->session->set_userdata('userName', $row->FULL_NAME);
            $this->session->set_userdata('userRoleFlg', $row->ACCESS_ROLE_FLG);
            return 'success';
        }
    }

    /* Logout method */

    function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('feedback', 'logged_out');
        redirect(base_url(), 'refresh');
    }
}
