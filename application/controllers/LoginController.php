<?php
class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('layouts/header');
        $this->load->view('login/index');
        $this->load->view('layouts/footer');
    }

    public function login()
    {

        $this->form_validation->set_rules('email', 'Email', 'trim|required', ['required' => 'Vui long nhap %s']);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => 'Vui long nhap %s']);
        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $this->load->model('LoginModel');
            $result = $this->LoginModel->checkLogin($email, $password);
            if ($result) {
                $session_array = [
                    'id' => $result[0]->id,
                    'username' => $result[0]->username,
                    'email' => $result[0]->email
                ];
                $this->session->set_userdata('LoginIn', $session_array);
                $this->session->set_flashdata('success_login', 'Login Successfully');
                redirect(base_url('/cms/dashboard'));
            } else {
                $this->session->set_flashdata('error', 'Wrong Email or Password. Please login again');
                redirect(base_url('/login'));
            }
        } else {
            $this->index();
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('LoginIn');
        $this->session->set_flashdata('success_logout', 'Logout Successfully');
        redirect(base_url('/login'));
    }
}
