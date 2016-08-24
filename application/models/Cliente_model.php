<?php

class Cliente_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_clientes() {
        $sql = "SELECT *
                FROM cliente u
                ORDER BY u.nombre";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

 
    public function get_cliente($id_cliente) {
        $sql = "SELECT *               
                FROM cliente 
                WHERE id_cliente=$id_cliente 
                LIMIT 1;";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function add_cliente($cliente) {
        $this->db->insert('cliente', $cliente);
        $id_cliente = $this->db->insert_id();

        $nuevo = $this->get_cliente($id_cliente);
        return $nuevo;
    }

    public function update_cliente($id_cliente, $cliente) {

        $where = "id_cliente = $id_cliente";
        $sql = $this->db->update_string('cliente', $cliente, $where);
        $this->db->query($sql);

        $datos = $this->get_cliente($id_cliente);
        return $datos;
    }

    public function del_cliente($id_cliente) {
        $sql = "DELETE FROM cliente WHERE id_cliente = $id_cliente LIMIT 1";
        $this->db->query($sql);
        $count = $this->db->affected_rows();
        return $count;
    }

}
