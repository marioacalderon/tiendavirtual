<?php
defined('BASEPATH') OR exit('El acceso a este archivo no está permitido');

class Home extends CI_Controller {
    
    public function __construct() 
    {
        parent:: __construct();

        // Existe una sesión
        if (!$this->ion_auth->logged_in())
        {
            redirect('restringido/login');
        }
    }

    public function index()
    {
        $this->load->view('restringido/layouts/header');
        $this->load->view('restringido/home/index');
        $this->load->view('restringido/layouts/footer');
    }
}
