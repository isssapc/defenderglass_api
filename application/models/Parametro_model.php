<?php

class Parametro_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_parametros() {
        $sql = "SELECT *
                FROM parametro u
                ORDER BY u.nombre";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

 
    public function get_parametro($id_parametro) {
        $sql = "SELECT *               
                FROM parametro 
                WHERE id_parametro=$id_parametro 
                LIMIT 1;";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function add_parametro($parametro) {
        $this->db->insert('parametro', $parametro);
        $id_parametro = $this->db->insert_id();

        $nuevo = $this->get_parametro($id_parametro);
        return $nuevo;
    }

    public function update_parametro($id_parametro, $parametro) {

        $where = "id_parametro = $id_parametro";
        $sql = $this->db->update_string('parametro', $parametro, $where);
        $this->db->query($sql);

        $datos = $this->get_parametro($id_parametro);
        return $datos;
    }

    public function del_parametro($id_parametro) {
        $sql = "DELETE FROM parametro WHERE id_parametro = $id_parametro LIMIT 1";
        $this->db->query($sql);
        $count = $this->db->affected_rows();
        return $count;
    }

}
