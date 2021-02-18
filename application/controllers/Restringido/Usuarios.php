<?php
defined('BASEPATH') OR exit('El acceso a este archivo no está permitido');

class Usuarios extends CI_Controller 
{
    
    public function __construct() 
    {
        parent:: __construct();

        // Validar sesión

        if (!$this->ion_auth->logged_in())
        {
            redirect('restringido/login');
        }
    }

    public function index()
    {
        $data = array(
            'titulo' => 'Usuarios registrados',
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
            'usuarios' => $this->ion_auth->users()->result(),
        );

        // echo '<pre>';
        // print_r($data['usuarios']);
        // exit();

        $this->load->view('restringido/layouts/header', $data);
        $this->load->view('restringido/usuarios/index');
        $this->load->view('restringido/layouts/footer');
    }

    public function core($usuario_id = NULL)
    {
        $usuario_id = (int) $usuario_id;

        if (!$usuario_id)
        {
            // Registrar usuario
            
            $this->form_validation->set_rules('first_name', 'nombre', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('last_name', 'apellidos', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('username', 'usuario', 'trim|required|min_length[4]|max_length[15]|callback_validar_usuario');
            $this->form_validation->set_rules('email', 'e-mail', 'trim|required|valid_email|max_length[250]|callback_validar_email');
            $this->form_validation->set_rules('password', 'contraseña', 'trim|required|min_length[5]|max_length[15]');
            $this->form_validation->set_rules('conf_password', 'confirmar contraseña', 'trim|required|matches[password]');

            if ($this->form_validation->run())
            {
                // Validacion exitosa

                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $email = $this->input->post('email');
                $dato_adicional = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'active' => $this->input->post('active'),
                );
                $group = array($this->input->post('perfil'));

                if ($this->ion_auth->register($username, $password, $email, $dato_adicional, $group))
                {
                    $this->session->set_flashdata('success', 'Datos guardados correctamente.');
                }
                else
                {
                    $this->session->set_flashdata('error', $this->ion_auth->errors());
                }

                redirect('restringido/usuarios');
            }
            else
            {
                // Error en la validacion

                $data = array(
                    'titulo' => 'Registrar Nuevo Usuario',
                    'grupos' => $this->ion_auth->groups()->result(),
                );

                $this->load->view('restringido/layouts/header.php', $data);
                $this->load->view('restringido/usuarios/core.php');
                $this->load->view('restringido/layouts/footer.php');
            }
        }
        else 
        {
            // Usuario no encontrado

            if (!$usuario = $this->ion_auth->user($usuario_id)->row())
            {
                $this->session->set_flashdata('error', 'Usuario no encontrado.');

                redirect('restringido/usuarios');
            }
            else
            {
                // Editar usuario

                $this->form_validation->set_rules('first_name', 'nombre', 'trim|required|min_length[4]|max_length[45]');
                $this->form_validation->set_rules('last_name', 'apellidos', 'trim|required|min_length[4]|max_length[45]');
                $this->form_validation->set_rules('username', 'usuario', 'trim|required|min_length[4]|max_length[15]|callback_validar_usuario');
                $this->form_validation->set_rules('email', 'e-mail', 'trim|required|valid_email|max_length[250]|callback_validar_email');
                $this->form_validation->set_rules('password', 'contraseña', 'trim|min_length[5]|max_length[15]');
                $this->form_validation->set_rules('conf_password', 'confirmar contraseña', 'trim|matches[password]');


                if ($this->form_validation->run())
                {
                    // Validacion exitosa

                    $data = elements(
                        array(
                            'first_name',
                            'last_name',
                            'email',
                            'username',
                            'password',
                            'active',
                        ),
                        $this->input->post()
                    );

                    $password = $this->input->post('password');

                    // No actualiza contraseña si no fue enviada

                    if (!$password)
                    {
                        unset($data['password']);
                    }

                    // Sanitizando $data
                    $data = html_escape($data);

                    // Actualizacion del usuario
                    if ($this->ion_auth->update($usuario_id, $data))
                    {
                        $perfil = (int) $this->input->post('perfil');

                        if ($perfil)
                        {
                            $this->ion_auth->remove_from_group(NULL, $usuario_id);
                            $this->ion_auth->add_to_group($perfil, $usuario_id);
                        }

                        $this->session->set_flashdata('success', 'Datos guardados correctamente.');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', $this->ion_auth->errors());
                    }

                    redirect('restringido/usuarios');
                }
                else
                {
                    // Error en la validacion

                    $data = array(
                        'titulo' => 'Editar usuario registrado',
                        'usuario' => $usuario,
                        'perfil' => $this->ion_auth->get_users_groups($usuario_id)->row(),
                        'grupos' => $this->ion_auth->groups()->result(),
                    );

                    $this->load->view('restringido/layouts/header.php', $data);
                    $this->load->view('restringido/usuarios/core.php');
                    $this->load->view('restringido/layouts/footer.php');
                }
            }
        }
    }

    public function validar_email($email)
    {
        $usuario_id = $this->input->post('usuario_id');

        if (!$usuario_id)
        {
            // Registrando...
            if ($this->core_model->get_by_id('users', array('email' => $email)))
            {
                $this->form_validation->set_message('validar_email', 'Este e-mail ya está registrado.');

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
            if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id)))
            {
                $this->form_validation->set_message('validar_email', 'Este e-mail ya está registrado.');

                return false;
            }
            else
            {
                return true;
            }
        }
    }

    public function validar_usuario($username)
    {
        $usuario_id = $this->input->post('usuario_id');

        if (!$usuario_id)
        {
            // Registrando...
            if ($this->core_model->get_by_id('users', array('username' => $username)))
            {
                $this->form_validation->set_message('validar_usuario', 'Este usuario ya está registrado.');

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
            if ($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $usuario_id)))
            {
                $this->form_validation->set_message('validar_usuario', 'Este usuario ya está registrado.');

                return false;
            }
            else
            {
                return true;
            }
        }
    }

    public function delete($usuario_id = NULL)
    {
        $usuario_id = (int) $usuario_id;

        if (!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) 
        {
            $this->session->set_flashdata('error', 'Usuario no encontrado.');

            redirect('restringido/usuarios');
        }
        else
        {
            // Elimina el usuario

            if ($this->ion_auth->is_admin($usuario_id))
            {
                $this->session->set_flashdata('error', 'No es permitido eliminar un usuario <strong>Administrador</strong>.');
            }
            elseif ($this->ion_auth->delete_user($usuario_id))
            {
                $this->session->set_flashdata('success', 'Usuario eliminado correctamente.');
            }
            else
            {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
            }            

            redirect('restringido/usuarios');
        }
    }
}