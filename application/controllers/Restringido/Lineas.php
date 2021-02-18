<?php
defined('BASEPATH') OR exit('El acceso a este archivo no está permitido');

Class Lineas extends CI_Controller {

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
            'titulo' => 'Lineas registradas',
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
            'lineas' => $this->core_model->get_all('lineas'),
        );

        // echo '<pre>';
        // print_r($data['lineas']);
        // exit();

        $this->load->view('restringido/layouts/header', $data);
        $this->load->view('restringido/lineas/index');
        $this->load->view('restringido/layouts/footer');
    }

    public function core($linea_id = NULL)
    {
        if (!$linea_id)
        {
            // Registrar Marca

            $this->form_validation->set_rules('linea_nombre', 'Nombre de la linea', 'trim|required|min_length[2]|max_length[40]|callback_validar_nombre_linea');

            if ($this->form_validation->run())
            {        
                $data = elements(
                    array(
                        'linea_nombre',
                        'linea_activa',
                    ),
                    $this->input->post(),
                );

                // Creamos el meta link de la linea
                $data['linea_meta_link'] = url_amigable($data['linea_nombre']);

                $data = html_escape($data);

                $this->core_model->insert('lineas', $data);

                redirect('restringido/lineas');
            }
            else
            {
                // Error en la validacion

                $data = array(
                    'titulo' => 'Editar linea',
                );
        
                $this->load->view('restringido/layouts/header', $data);
                $this->load->view('restringido/lineas/core');
                $this->load->view('restringido/layouts/footer');
            } 
        }
        else
        {
            if (!$linea = $this->core_model->get_by_id('lineas', array('linea_id' => $linea_id)))
            {
                $this->session->set_flashdata('error', 'La linea no fue encontrada.');

                redirect('restringido/lineas');
            }
            else
            {
                // Editar linea

                $this->form_validation->set_rules('linea_nombre', 'Nombre de la linea', 'trim|required|min_length[2]|max_length[40]|callback_validar_nombre_linea');

                if ($this->form_validation->run())
                {        
                    $data = elements(
                        array(
                            'linea_nombre',
                            'linea_activa',
                        ),
                        $this->input->post(),
                    );

                    // Creamos el meta link de la linea
                    $data['linea_meta_link'] = url_amigable($data['linea_nombre']);

                    $data = html_escape($data);

                    $this->core_model->update('lineas', $data, array('linea_id' => $linea_id));

                    redirect('restringido/lineas');
                }
                else
                {
                    // Error en la validacion

                    $data = array(
                        'titulo' => 'Editar linea',
                        'lineas' => $linea,
                    );
            
                    $this->load->view('restringido/layouts/header', $data);
                    $this->load->view('restringido/lineas/core');
                    $this->load->view('restringido/layouts/footer');
                }                
            }
        }
    }

    public function validar_nombre_linea($linea_nombre)
    {
        $linea_id = $this->input->post('linea_id');

        if (!$linea_id)
        {
            // Registrando...
            if ($this->core_model->get_by_id('lineas', array('linea_nombre' => $linea_nombre)))
            {
                $this->form_validation->set_message('validar_nombre_linea', 'Esta linea ya está resgistrada.');

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
            if ($this->core_model->get_by_id('lineas', array('linea_nombre' => $linea_nombre, 'linea_id !=' => $linea_id)))
            {
                $this->form_validation->set_message('validar_nombre_linea', 'Esta linea ya está resgistrada.');

                return false;
            }
            else
            {
                return true;
            }
        }
    }

    public function delete($linea_id = NULL)
    {
        $linea_id = (int) $linea_id;

        if (!$linea_id || !$this->core_model->get_by_id('lineas', array('linea_id' => $linea_id)))
        {
            $this->session->set_flashdata('error', 'No fue posible eliminar la linea.');
        }

        elseif ($this->core_model->get_by_id('lineas', array('linea_id' => $linea_id, 'linea_activa' => 1)))
        {
            $this->session->set_flashdata('error', 'No es posible eliminar una linea activa.');
        }
        else
        {
            $this->core_model->delete('lineas', array('linea_id' => $linea_id));
        }

        redirect('restringido/lineas');
    }

}
