<?php

class Parametros extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('parametro_model');
    }

    public function index_post() {
        $parametro = $this->post('parametro');
        $nuevo = $this->parametro_model->add_parametro($parametro);
        $this->response($nuevo);
    }

    public function index_get() {
        $nuevo = $this->parametro_model->get_parametros();
        $this->response($nuevo);
    }

    public function one_get($id_parametro) {        
        $parametro = $this->parametro_model->get_parametro($id_parametro);
        $this->response($parametro);
    }

    public function remove_delete($id_parametro) {        
        $nuevo = $this->parametro_model->del_parametro($id_parametro);
        $this->response($nuevo);
    }

    public function update_put($id_parametro) {
        $parametro = $this->post('parametro');
        $nuevo = $this->parametro_model->update_parametro($id_parametro,$parametro);
        $this->response($nuevo);
    }

}
