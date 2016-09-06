<?php

class GastoExtra_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_gastos() {
        $sql = "SELECT *
                FROM gasto_extra g
                ORDER BY g.id_gasto";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_gasto($id_gasto) {
        $sql = "SELECT *               
                FROM gasto_extra 
                WHERE id_gasto=$id_gasto 
                LIMIT 1;";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function add_gasto($gasto) {
        $this->db->insert('gasto_extra', $gasto);
        $id_gasto = $this->db->insert_id();

        $nuevo = $this->get_gasto($id_gasto);
        return $nuevo;
    }

    public function update_gasto($id_gasto, $gasto) {

        $where = "id_gasto = $id_gasto";
        $sql = $this->db->update_string('gasto_extra', $gasto, $where);
        $this->db->query($sql);

        $datos = $this->get_gasto($id_gasto);
        return $datos;
    }

    public function del_gasto($id_gasto) {
        $sql = "DELETE FROM gasto_extra WHERE id_gasto = $id_gasto LIMIT 1";
        $this->db->query($sql);
        $count = $this->db->affected_rows();
        return $count;
    }

}
