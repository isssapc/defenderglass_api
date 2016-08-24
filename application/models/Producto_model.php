<?php

class Producto_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_productos() {
        $sql = "SELECT *, t.nombre AS tipo, c.nombre AS categoria
                FROM producto p
                JOIN tipo_producto t ON t.id_tipo=p.id_tipo
                JOIN categoria_producto c ON c.id_categoria=p.id_categoria 
                ORDER BY p.id_producto";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_producto($id_producto) {
        $sql = "SELECT *               
                FROM producto 
                WHERE id_producto=$id_producto 
                LIMIT 1;";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function add_producto($producto) {
        $this->db->insert('producto', $producto);
        $id_producto = $this->db->insert_id();

        $nuevo = $this->get_producto($id_producto);
        return $nuevo;
    }

    public function update_producto($id_producto, $producto) {

        $where = "id_producto = $id_producto";
        $sql = $this->db->update_string('producto', $producto, $where);
        $this->db->query($sql);

        $datos = $this->get_producto($id_producto);
        return $datos;
    }

    public function del_producto($id_producto) {
        $sql = "DELETE FROM producto WHERE id_producto = $id_producto LIMIT 1";
        $this->db->query($sql);
        $count = $this->db->affected_rows();
        return $count;
    }

}
