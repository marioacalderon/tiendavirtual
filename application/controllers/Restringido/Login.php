<?php
defined('BASEPATH') OR exit('El acceso a este archivo no está permitido');

Class Login extends CI_Controller {

    public function index()
    {
        $data = array(
            'titulo' => 'Login área privada',
        );

        $this->load->view('restringido/layouts/header', $data);
        $this->load->view('restringido/login/index');
        $this->load->view('restringido/layouts/footer');
    }

    public function auth()
    {
        // echo '<pre>';
        // print_r($this->input->post());
        // exit();

        $identity = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = ($this->input->post('remember' ? 'TRUE' : 'FALSE'));

        if ($this->ion_auth->login($identity, $password, $remember))
        {
            $this->session->set_flashdata('success', 'Bienvenido al sistema.');
            
            redirect('restringido');
        }
        else
        {
            $this->session->set_flashdata('error', 'Porfavor verifique sus credenciales de acceso.');
            redirect('restringido/login');
        }
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('restringido/login');
    }

}