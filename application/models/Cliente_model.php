<?php

class Cliente_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_clientes() {
        $sql = "SELECT *
                FROM cliente c
                ORDER BY c.nombre";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function search_clientes($search) {
//        $sql = "SELECT *
//                FROM cliente c
//                WHERE c.nombre like $search
//                ORDER BY c.nombre";

        $this->db->like("nombre", $search);
        $query = $this->db->get("cliente", 10);


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

    public function get_page($start, $number, $params) {


        if (isset($params["search"]["predicateObject"]["id_cliente"])) {
            $id_cliente = $params["search"]["predicateObject"]["id_cliente"];
            $this->db->like('id_cliente', $id_cliente);
        }
        if (isset($params["search"]["predicateObject"]["nombre"])) {
            $nombre = $params["search"]["predicateObject"]["nombre"];
            $this->db->like('nombre', $nombre);
        }
        if (isset($params["search"]["predicateObject"]["rfc"])) {
            $rfc = $params["search"]["predicateObject"]["rfc"];
            $this->db->like('rfc', $rfc);
        }

       
        if (isset($params["sort"]["predicate"])) {
            $predicate = $params["sort"]["predicate"];
            $desc = $params["sort"]["reverse"];

            if ($predicate === "id_cliente") {
                if ($desc) {
                    $this->db->order_by('id_cliente', 'DESC');
                } else {
                    $this->db->order_by('id_cliente', 'ASC');
                }
            } else if ($predicate === "nombre") {
                if ($desc) {
                    $this->db->order_by('nombre', 'DESC');
                } else {
                    $this->db->order_by('nombre', 'ASC');
                }
            } else if ($predicate === "rfc") {
                if ($desc) {
                    $this->db->order_by('rfc', 'DESC');
                } else {
                    $this->db->order_by('rfc', 'ASC');
                }
            }
        } else {
            $this->db->order_by('nombre', 'ASC');
        }
       

        $num_clientes = $this->db->count_all_results('cliente', FALSE);
        $this->db->limit($number, $start);
        $query = $this->db->get();



        $clientes = $query->result_array();
        //$num_clientes = count($clientes); //$this->db->count_all("cliente");

        $count = ceil($num_clientes / $number);
        $page = ["clientes" => $clientes, "numberOfPages" => $count];
        return $page;
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
