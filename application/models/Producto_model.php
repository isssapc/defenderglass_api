<?php

class Producto_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_productos() {
        $sql = "SELECT p.*, s.nombre AS segmento, c.nombre AS categoria, seg.nombre AS seguridad, a.ancho
                FROM producto p
                JOIN segmento_producto s ON s.id_segmento=p.id_segmento                
                JOIN categoria_producto c ON c.id_categoria=p.id_categoria
                JOIN ancho_producto a ON a.id_ancho=p.id_ancho
                LEFT JOIN seguridad_producto seg ON seg.id_seguridad=p.id_seguridad
                ORDER BY p.id_producto";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_producto($id_producto) {
        $sql = "SELECT p.*, s.nombre AS segmento, c.nombre AS categoria, seg.nombre AS seguridad, a.ancho
                FROM producto p
                JOIN segmento_producto s ON s.id_segmento=p.id_segmento                
                JOIN categoria_producto c ON c.id_categoria=p.id_categoria
                JOIN ancho_producto a ON a.id_ancho=p.id_ancho
                LEFT JOIN seguridad_producto seg ON seg.id_seguridad=p.id_seguridad
                WHERE p.id_producto=$id_producto 
                LIMIT 1;";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function get_producto_automotriz($id_modelo) {
        $sql = "SELECT p.*
                FROM producto_automotriz p               
                WHERE p.id_modelo=$id_modelo 
                LIMIT 1;";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function get_segmentos() {
        $sql = "SELECT *               
                FROM segmento_producto";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_categorias() {
        $sql = "SELECT *               
                FROM categoria_producto";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_anchos() {
        $sql = "SELECT *               
                FROM ancho_producto";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_garantias() {
        $sql = "SELECT *               
                FROM garantia";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_niveles_seguridad() {
        $sql = "SELECT *               
                FROM seguridad_producto";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function add_producto($producto) {
        $this->db->insert('producto', $producto);
        $id_producto = $this->db->insert_id();

        $nuevo = $this->get_producto($id_producto);
        return $nuevo;
    }

    public function add_productos($productos) {

        $this->db->insert_batch('producto', $productos);
        $count = $this->db->affected_rows();
        return $count;
    }

    public function add_productos_automotriz($productos) {

        $this->db->insert_batch('producto_automotriz', $productos);
        $count = $this->db->affected_rows();
        return $count;
    }

    public function get_productos_automotriz() {

        $sql = "SELECT *               
                FROM producto_automotriz
                ORDER BY modelo";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update_producto($id_producto, $producto) {

        $where = "id_producto = $id_producto";
        $sql = $this->db->update_string('producto', $producto, $where);
        $this->db->query($sql);

        $datos = $this->get_producto($id_producto);
        return $datos;
    }

    public function update_producto_automotriz($id_modelo, $producto) {

        $where = "id_modelo = $id_modelo";
        $sql = $this->db->update_string('producto_automotriz', $producto, $where);
        $this->db->query($sql);

        $datos = $this->get_producto_automotriz($id_modelo);
        return $datos;
    }

    public function del_producto($id_producto) {
        $sql = "DELETE FROM producto WHERE id_producto = $id_producto LIMIT 1";
        $this->db->query($sql);
        $count = $this->db->affected_rows();
        return $count;
    }

    public function del_producto_automotriz($id_modelo) {
        $sql = "DELETE FROM producto_automotriz WHERE id_modelo = $id_modelo LIMIT 1";
        $this->db->query($sql);
        $count = $this->db->affected_rows();
        return $count;
    }

}
