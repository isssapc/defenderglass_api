<?php

class RolesUsuarios extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('rolusuario_model');
    }

    public function index_post() {
        $rol = $this->post('rol');
        $nuevo = $this->rolusuario_model->add_rol($rol);
        $this->response($nuevo);
    }

    public function index_get() {
        $nuevo = $this->rolusuario_model->get_roles();
        $this->response($nuevo);
    }

    public function one_get($id_rol) {        
        $rol = $this->rolusuario_model->get_rol($id_rol);
        $this->response($rol);
    }

    public function remove_delete($id_rol) {        
        $nuevo = $this->rolusuario_model->del_rol($id_rol);
        $this->response($nuevo);
    }

    public function update_put($id_rol) {
        $rol = $this->post('rol');
        $nuevo = $this->rolusuario_model->update_rol($id_rol,$rol);
        $this->response($nuevo);
    }

}
