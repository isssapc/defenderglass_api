<?php

class Cotizacion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_cotizaciones() {
        $sql = "SELECT *
                FROM cotizacion u
                ORDER BY u.nombre";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_cotizacion($id_cotizacion) {
        $sql = "SELECT *               
                FROM cotizacion 
                WHERE id_cotizacion=$id_cotizacion 
                LIMIT 1;";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function add_cotizacion($cotizacion) {
        $this->db->insert('cotizacion', $cotizacion);
        $id_cotizacion = $this->db->insert_id();

        $nuevo = $this->get_cotizacion($id_cotizacion);
        return $nuevo;
    }

    public function update_cotizacion($id_cotizacion, $cotizacion) {

        $where = "id_cotizacion = $id_cotizacion";
        $sql = $this->db->update_string('cotizacion', $cotizacion, $where);
        $this->db->query($sql);

        $datos = $this->get_cotizacion($id_cotizacion);
        return $datos;
    }

    public function del_cotizacion($id_cotizacion) {
        $sql = "DELETE FROM cotizacion WHERE id_cotizacion = $id_cotizacion LIMIT 1";
        $this->db->query($sql);
        $count = $this->db->affected_rows();
        return $count;
    }

    public function reporte_cotizacion($id_cotizacion, $cotizacion) {

        $where = "id_cotizacion = $id_cotizacion";
        $sql = $this->db->update_string('cotizacion', $cotizacion, $where);
        $this->db->query($sql);

        $datos = $this->get_cotizacion($id_cotizacion);
        return $datos;
    }

}
