<?php
defined('BASEPATH') OR exit('El acceso a este archivo no está permitido');

Class Sistema extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in())
        {
            redirect('restringido/login');
        }

        // $this->load->model('core_model');
    }

    public function index()
    {
        $this->form_validation->set_rules('sistema_razon_social', 'Razón social', 'trim|required|min_length[10]|max_length[100]');
        $this->form_validation->set_rules('sistema_nombre', 'Nombre de la tienda', 'trim|required|min_length[10]|max_length[100]');
        $this->form_validation->set_rules('sistema_nit', 'Nit', 'trim|required|exact_length[11]');
        $this->form_validation->set_rules('sistema_telefono_fijo', 'Teléfono fijo', 'trim|required|min_length[12]|max_length[13]');
        $this->form_validation->set_rules('sistema_telefono_movil', 'Teléfono celular', 'trim|exact_length[12]');
        $this->form_validation->set_rules('sistema_email', 'Razón social', 'trim|required|valid_email|max_length[100]');
        $this->form_validation->set_rules('sistema_sitio_url', 'Razón social', 'trim|required|valid_url|max_length[100]');
        $this->form_validation->set_rules('sistema_postal', 'Código postal', 'trim|exact_length[6]');
        $this->form_validation->set_rules('sistema_direccion', 'Dirección', 'trim|required|min_length[10]|max_length[150]');
        $this->form_validation->set_rules('sistema_barrio', 'Barrio', 'trim|required|min_length[5]|max_length[100]');        
        $this->form_validation->set_rules('sistema_ciudad', 'Ciudad', 'trim|required|min_length[10]|max_length[100]');      
        $this->form_validation->set_rules('sistema_productos_destacados', 'Productos destacados', 'trim|required|integer');

        if ($this->form_validation->run()) 
        {
            $data = elements(
                array(
                    'sistema_razon_social',
                    'sistema_nombre',
                    'sistema_nit',
                    'sistema_telefono_fijo',
                    'sistema_telefono_movil',
                    'sistema_email',
                    'sistema_sitio_url',
                    'sistema_postal',
                    'sistema_direccion',
                    'sistema_barrio',
                    'sistema_ciudad',
                    'sistema_departamento',
                    'sistema_productos_destacados',
                ),
                $this->input->post(),
            );

            $data['sistema_direccion'] = strtolower($data['sistema_direccion']);
            $data['sistema_email'] = strtolower($data['sistema_email']);
            $data['sistema_sitio_url'] = strtolower($data['sistema_sitio_url']);
            
            $data = html_escape($data);

            $this->core_model->update('sistema', $data, array('sistema_id' => 1));

            redirect('restringido/sistema');
        }
        else
        {
            // Error en la validación
            
            $data = array(
                'titulo' => 'Información de la tienda',
                'scripts' => array(
                    'mask/jquery.mask.min.js',
                    'mask/custom.js',
                ),
                'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
            );        
            
            $this->load->view('restringido/layouts/header', $data);
            $this->load->view('restringido/sistema/index');
            $this->load->view('restringido/layouts/footer');
        }
    }
    
}