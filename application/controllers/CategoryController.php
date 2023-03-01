<?php

class CategoryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $user = $this->session->userdata('LoginIn');
        if ($user) {
            $this->load->view('admin_template/header');
            $this->load->view('admin_template/navbar');
            $this->load->view('category/index');
            $this->load->view('admin_template/footer');
        } else {
            redirect(base_url('/login'));
        }
    }
}
