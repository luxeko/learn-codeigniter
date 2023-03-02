<?php

class DashboardController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    // public function checkLogin()
    // {
    //     $user = $this->session->userdata('LoginIn');
    //     if (!$user) {
    //         redirect(base_url('/login'));
    //     }
    // }
    public function index()
    {
        $user = $this->session->userdata('LoginIn');
        if ($user) {
            $this->load->view('admin_template/header');
            $this->load->view('admin_template/navbar');
            $this->load->view('dashboard/index');
            $this->load->view('admin_template/footer');
        } else {
            redirect(base_url('/login'));
        }
    }
}
