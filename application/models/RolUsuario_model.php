<?php

class RolUsuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_roles() {
        $sql = "SELECT *
                FROM rol_usuario r
                ORDER BY r.rol";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_rol($id_rol) {
        $sql = "SELECT *               
                FROM rol_usuario 
                WHERE id_rol=$id_rol 
                LIMIT 1;";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function add_rol($rol) {
        $this->db->insert('rol_usuario', $rol);
        $id_rol = $this->db->insert_id();

        $nuevo = $this->get_usuario($id_rol);
        return $nuevo;
    }

    public function update_rol($id_rol, $rol) {

        $where = "id_rol = $id_rol";
        $sql = $this->db->update_string('rol_usuario', $rol, $where);
        $this->db->query($sql);

        $datos = $this->get_usuario($id_rol);
        return $datos;
    }

    public function del_rol($id_rol) {
        $sql = "DELETE FROM rol_usuario WHERE id_rol = $id_rol LIMIT 1";
        $this->db->query($sql);
        $count = $this->db->affected_rows();
        return $count;
    }

}
