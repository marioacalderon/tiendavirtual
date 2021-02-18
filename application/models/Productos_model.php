<?php
defined('BASEPATH') OR exit('El acceso a este archivo no está permitido');

Class Productos_model extends CI_Model {

    public function get_all()
    {
        $this->db->select([
            'productos.producto_id',
            'productos.producto_codigo',
            'productos.producto_nombre',
            'productos.producto_valor',
            'productos.producto_activo',
            'categorias.categoria_id',
            'categorias.categoria_nombre',
            'marcas.marca_nombre',
        ]);
        $this->db->join('categorias', 'categorias.categoria_id = productos.producto_id', 'left');
        $this->db->join('marcas', 'marcas.marca_id = productos.producto_id', 'left');
        
        return $this->db->get('productos')->result();
    }

}