<?php

class Usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_usuarios() {
        $sql = "SELECT *
                FROM usuario u
                ORDER BY u.nombre";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_usuario_by_email($value) {
        $sql = "SELECT u.* FROM usuario u WHERE email='$value' LIMIT 1";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function get_usuario($id_usuario) {
        $sql = "SELECT *               
                FROM usuario 
                WHERE id_usuario=$id_usuario 
                LIMIT 1;";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function add_usuario($usuario) {
        $this->db->insert('usuario', $usuario);
        $id_usuario = $this->db->insert_id();

        $nuevo = $this->get_usuario($id_usuario);
        return $nuevo;
    }

    public function update_usuario($id_usuario, $usuario) {

        $where = "id_usuario = $id_usuario";
        $sql = $this->db->update_string('usuario', $usuario, $where);
        $this->db->query($sql);

        $datos = $this->get_usuario($id_usuario);
        return $datos;
    }

    public function del_usuario($id_usuario) {
        $sql = "DELETE FROM usuario WHERE id_usuario = $id_usuario LIMIT 1";
        $this->db->query($sql);
        $count = $this->db->affected_rows();
        return $count;
    }

}
