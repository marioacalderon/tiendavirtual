<?php
defined('BASEPATH') OR exit('El acceso a este archivo no está permitido');

Class Categorias extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in())
        {
            redirect('restringido/login');
        }
    }

    public function index()
    {
        $data = array(
            'titulo' => 'Sub-categorías registradas',
            'styles' => array(
                'bundles/datatables/datatables.min.css',
                'bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'bundles/datatables/datatables.min.js',
                'bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'bundles/jquery-ui/jquery-ui.min.js',
                'js/page/datatables.js',
            ),
            'categorias' => $this->core_model->get_all('categorias'),
            'maestros' => $this->core_model->get_all('categorias_principal'),
        );

        // echo '<pre>';
        // print_r($data['maestros']);
        // exit();

        $this->load->view('restringido/layouts/header', $data);
        $this->load->view('restringido/categorias/index');
        $this->load->view('restringido/layouts/footer');
    }
    
    public function core($categoria_id = NULL)
    {
        if (!$categoria_id)
        {
            // Registrar categoría

            $this->form_validation->set_rules('categoria_nombre', 'Nombre de la categoría', 'trim|required|min_length[2]|max_length[40]|callback_validar_nombre_categoria');

            if ($this->form_validation->run())
            {        
                $data = elements(
                    array(
                        'categoria_nombre',
                        'categoria_activa',
                        'categoria_principal_id',
                    ),
                    $this->input->post(),
                );

                // Creamos el meta link de la categoría
                $data['categoria_meta_link'] = url_amigable($data['categoria_nombre']);

                $data = html_escape($data);

                $this->core_model->insert('categorias', $data);

                redirect('restringido/categorias');
            }
            else
            {
                // Error en la validacion

                $data = array(
                    'titulo' => 'Registrar categoría secundaria',
                    'maestros' => $this->core_model->get_all('categorias_principal', array('categoria_principal_activa' => 1)),
                );

                // echo '<pre>';
                // print_r($data['maestros']);
                // exit();
        
                $this->load->view('restringido/layouts/header', $data);
                $this->load->view('restringido/categorias/core');
                $this->load->view('restringido/layouts/footer');
            } 
        }
        else
        {
            if (!$categoria = $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id)))
            {
                $this->session->set_flashdata('error', 'La categoría no fue encontrada.');

                redirect('restringido/categorias');
            }
            else
            {
                // Editar categoría

                $this->form_validation->set_rules('categoria_nombre', 'Nombre de la categoría', 'trim|required|min_length[2]|max_length[40]|callback_validar_nombre_categoria');

                if ($this->form_validation->run())
                {                           
                    $data = elements(
                        array(
                            'categoria_nombre',
                            'categoria_activa',
                            'categoria_principal_id',
                        ),
                        $this->input->post(),
                    );

                    // Creamos el meta link de la categoría
                    $data['categoria_meta_link'] = url_amigable($data['categoria_nombre']);

                    $data = html_escape($data);

                    $this->core_model->update('categorias', $data, array('categoria_id' => $categoria_id));

                    redirect('restringido/categorias');
                }
                else
                {
                    // Error en la validacion

                    $data = array(
                        'titulo' => 'Editar categoría secundaria',
                        'categorias' => $categoria,
                        'maestros' => $this->core_model->get_all('categorias_principal', array('categoria_principal_activa' => 1)),
                    );
            
                    $this->load->view('restringido/layouts/header', $data);
                    $this->load->view('restringido/categorias/core');
                    $this->load->view('restringido/layouts/footer');
                }                
            }
        }
    }    

    public function validar_nombre_categoria($categoria_nombre)
    {
        $categoria_id = $this->input->post('categoria_id');
        $categoria_principal_id = $this->input->post('categoria_principal_id');

        if (!$categoria_id)
        {
            // Registrando...
            if ($this->core_model->get_by_id('categorias', array('categoria_principal_id' => $categoria_principal_id)))
            {
                $this->form_validation->set_message('validar_nombre_categoria', 'Esta categoria ya está resgistrada.');

                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            // Editando...
            if ($this->core_model->get_by_id('categorias', array('categoria_nombre' => $categoria_nombre, 'categoria_principal_id !=' => $categoria_principal_id, 'categoria_id' => $categoria_id)))
            {
                $this->form_validation->set_message('validar_nombre_categoria', 'Esta categoria ya está resgistrada.');

                return false;
            }
            else
            {
                return true;
            }
        }
    }

    public function delete($categoria_id = NULL)
    {
        $categoria_id = (int) $categoria_id;

        if (!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id)))
        {
            $this->session->set_flashdata('error', 'No fue posible eliminar la categoria.');
        }

        elseif ($this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id, 'categoria_activa' => 1)))
        {
            $this->session->set_flashdata('error', 'No es posible eliminar una categoria activa.');
        }
        else
        {
            $this->core_model->delete('categorias', array('categoria_id' => $categoria_id));
        }

        redirect('restringido/categorias');
    }

}