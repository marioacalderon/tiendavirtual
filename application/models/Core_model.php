<?php

defined('BASEPATH') OR exit('El acceso a este archivo no está permitido');

class Core_model extends CI_Model
{
    // Obtener todos
    public function get_all($tabla = NULL, $condicion = NULL)
    {
        if ($tabla && $this->db->table_exists($tabla))
        {
            if (is_array($condicion))
            {
                $this->db->where($condicion);
            }

            return $this->db->get($tabla)->result();
        }
        else 
        {
            return false;
        }
    }

    // Obtener por ID
    public function get_by_id($tabla = NULL, $condicion = NULL)
    {
        if ($tabla && $this->db->table_exists($tabla) && is_array($condicion))
        {
            $this->db->where($condicion);
            $this->db->limit(1);

            return $this->db->get($tabla)->row();
        }
        else 
        {
            return false;
        }
    }

    // Insertar
    public function insert($tabla = NULL, $data = NULL, $get_last_id = NULL)
    {
        if ($tabla && $this->db->table_exists($tabla) && is_array($data))
        {
            // Insertar la sesion o ultimo ID insertado en la base de datos            
            if ($get_last_id)
            {
                $this->session->set_userdata('last_id', $this->db->insert_id());
            }

            $this->db->insert($tabla, $data);
            
            if ($this->db->affected_rows() > 0)
            {
                $this->session->set_flashdata('success', 'Datos guardados correctamente.');
            }
            else
            {
                $this->session->set_flashdata('error', 'No fue posible guardar los datos.');
            }
        }
        else 
        {
            return false;
        }
    }

    // Actualizar
    public function update($tabla = NULL, $data = NULL, $condicion = NULL)
    {
        if ($tabla && $this->db->table_exists($tabla) && is_array($data) && is_array($condicion))
        {
            if ($this->db->update($tabla, $data, $condicion))
            {
                $this->session->set_flashdata('success', 'Datos actualizados correctamente.');
            }
            else
            {
                $this->session->set_flashdata('error', 'No fue posible actualizar los datos.');
            }
        }
        else 
        {
            return false;
        }
    }

    // Eliminar
    public function delete($tabla = NULL, $condicion = NULL)
    {
        if ($tabla && $this->db->table_exists($tabla) && is_array($condicion))
        {
            if ($this->db->delete($tabla, $condicion))
            {
                $this->session->set_flashdata('success', 'Datos eliminados correctamente.');
            }
            else
            {
                $this->session->set_flashdata('error', 'No fue posible eliminar los datos.');
            }
        }
    }
}
