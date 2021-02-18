<?php
defined('BASEPATH') OR exit('El acceso a este archivo no está permitido');

Class Maestro extends CI_Controller {

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
            'titulo' => 'Categorías registradas',
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
            'categorias_principal' => $this->core_model->get_all('categorias_principal'),
        );

        // echo '<pre>';
        // print_r($data['categorias_principal']);
        // exit();

        $this->load->view('restringido/layouts/header', $data);
        $this->load->view('restringido/maestro/index');
        $this->load->view('restringido/layouts/footer');
    }
    
    public function core($categoria_principal_id = NULL)
    {
        if (!$categoria_principal_id)
        {
            // Registrar categoría principal

            $this->form_validation->set_rules('categoria_principal_nombre', 'Nombre de la categoría', 'trim|required|min_length[2]|max_length[40]|callback_validar_nombre_categoria_principal');

            if ($this->form_validation->run())
            {        
                $data = elements(
                    array(
                        'categoria_principal_nombre',
                        'categoria_principal_activa',
                    ),
                    $this->input->post(),
                );

                // Creamos el meta link de la categoría
                $data['categoria_principal_meta_link'] = url_amigable($data['categoria_principal_nombre']);

                $data = html_escape($data);

                $this->core_model->insert('categorias_principal', $data);

                redirect('restringido/maestro');
            }
            else
            {
                // Error en la validacion

                $data = array(
                    'titulo' => 'Registrar categoría principal',
                );
        
                $this->load->view('restringido/layouts/header', $data);
                $this->load->view('restringido/maestro/core');
                $this->load->view('restringido/layouts/footer');
            } 
        }
        else
        {
            if (!$categoria_principal_ = $this->core_model->get_by_id('categorias_principal', array('categoria_principal_id' => $categoria_principal_id)))
            {
                $this->session->set_flashdata('error', 'La categoría principal no fue encontrada.');

                redirect('restringido/maestro');
            }
            else
            {
                // Editar categoría principal

                $this->form_validation->set_rules('categoria_principal_nombre', 'Nombre de la categoría', 'trim|required|min_length[2]|max_length[40]|callback_validar_nombre_categoria_principal');

                if ($this->form_validation->run())
                {        
                    if ($this->input->post('categoria_principal_activa') == 0)
                    {
                        if ($this->core_model->get_by_id('categorias', array('categoria_principal_id' => $categoria_principal_id)))
                        {
                            $this->session->set_flashdata('error', 'No es posible <strong>desactivada</strong> esta categoria principal porque está viculada a una categoria secundaria.');

                            redirect('restringido/maestro');
                        }
                    }

                    $data = elements(
                        array(
                            'categoria_principal_nombre',
                            'categoria_principal_activa',
                        ),
                        $this->input->post(),
                    );

                    // Creamos el meta link de la categoría
                    $data['categoria_principal_meta_link'] = url_amigable($data['categoria_principal_nombre']);

                    $data = html_escape($data);

                    $this->core_model->update('categorias_principal', $data, array('categoria_principal_id' => $categoria_principal_id));

                    redirect('restringido/maestro');
                }
                else
                {
                    // Error en la validacion

                    $data = array(
                        'titulo' => 'Editar categoría principal',
                        'categorias_principal' => $categoria_principal_,
                    );
            
                    $this->load->view('restringido/layouts/header', $data);
                    $this->load->view('restringido/maestro/core');
                    $this->load->view('restringido/layouts/footer');
                }                
            }
        }
    }    

    public function validar_nombre_categoria_principal($categoria_principal_nombre)
    {
        $categoria_principal_id = $this->input->post('categoria_principal_id');

        if (!$categoria_principal_id)
        {
            // Registrando...
            if ($this->core_model->get_by_id('categorias_principal', array('categoria_principal_nombre' => $categoria_principal_nombre)))
            {
                $this->form_validation->set_message('validar_nombre_categoria_principal', 'Esta categoria principal ya está resgistrada.');

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
            if ($this->core_model->get_by_id('categorias_principal', array('categoria_principal_nombre' => $categoria_principal_nombre, 'categoria_principal_id !=' => $categoria_principal_id)))
            {
                $this->form_validation->set_message('validar_nombre_categoria_principal', 'Esta categoria principal ya está resgistrada.');

                return false;
            }
            else
            {
                return true;
            }
        }
    }

    public function delete($categoria_principal_id = NULL)
    {
        $categoria_principal_id = (int) $categoria_principal_id;

        if (!$categoria_principal_id || !$this->core_model->get_by_id('categorias_principal', array('categoria_principal_id' => $categoria_principal_id)))
        {
            $this->session->set_flashdata('error', 'No fue posible eliminar la categoria principal.');
        }

        elseif ($this->core_model->get_by_id('categorias_principal', array('categoria_principal_id' => $categoria_principal_id, 'categoria_principal_activa' => 1)))
        {
            $this->session->set_flashdata('error', 'No es posible eliminar una categoria principal activa.');
        }
        else
        {
            $this->core_model->delete('categorias_principal', array('categoria_principal_id' => $categoria_principal_id));
        }

        redirect('restringido/maestro');
    }

}