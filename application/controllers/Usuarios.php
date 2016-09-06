<?php

class Usuarios extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
    }

    public function index_post() {
        $usuario = $this->post('usuario');
        $nuevo = $this->usuario_model->add_usuario($usuario);
        $this->response($nuevo);
    }

    public function index_get() {
        $nuevo = $this->usuario_model->get_usuarios();
        $this->response($nuevo);
    }

    public function one_get($id_usuario) {        
        $usuario = $this->usuario_model->get_usuario($id_usuario);
        $this->response($usuario);
    }

    public function remove_delete($id_usuario) {        
        $datos = $this->usuario_model->del_usuario($id_usuario);
        $this->response($datos);
    }

    public function update_put($id_usuario) {
        $usuario = $this->put('usuario');
        $nuevo = $this->usuario_model->update_usuario($id_usuario,$usuario);
        $this->response($nuevo);
    }

}
