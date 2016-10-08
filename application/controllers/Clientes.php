<?php

class Clientes extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('cliente_model');
    }

    public function index_post() {
        $cliente = $this->post('cliente');
        $nuevo = $this->cliente_model->add_cliente($cliente);
        $this->response($nuevo);
    }

    public function index_get() {
        $nuevo = $this->cliente_model->get_clientes();
        $this->response($nuevo);
    }

    public function search_post() {
        $search = $this->post("search");
        $datos = $this->cliente_model->search_clientes($search);
        $this->response($datos);
    }

    public function one_get($id_cliente) {
        $cliente = $this->cliente_model->get_cliente($id_cliente);
        $this->response($cliente);
    }

    public function remove_delete($id_cliente) {
        $nuevo = $this->cliente_model->del_cliente($id_cliente);
        $this->response($nuevo);
    }

    public function update_put($id_cliente) {
        $cliente = $this->post('cliente');
        $nuevo = $this->cliente_model->update_cliente($id_cliente, $cliente);
        $this->response($nuevo);
    }

}
