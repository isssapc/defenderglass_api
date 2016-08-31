<?php

class Productos extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('producto_model');
    }

    public function index_post() {
        $producto = $this->post('producto');
        $nuevo = $this->producto_model->add_producto($producto);
        $this->response($nuevo);
    }

    public function index_get() {
        $nuevo = $this->producto_model->get_productos();
        $this->response($nuevo);
    }

    public function one_get($id_producto) {
        $producto = $this->producto_model->get_producto($id_producto);
        $this->response($producto);
    }

    public function remove_delete($id_producto) {
        $count = $this->producto_model->del_producto($id_producto);
        $this->response($count);
    }

    public function update_put($id_producto) {
        $producto = $this->post('producto');
        $nuevo = $this->producto_model->update_producto($id_producto, $producto);
        $this->response($nuevo);
    }

    public function niveles_seguridad_get() {
        $datos = $this->producto_model->get_niveles_seguridad();
        $this->response($datos);
    }

    public function segmentos_get() {
        $datos = $this->producto_model->get_segmentos();
        $this->response($datos);
    }

    public function categorias_get() {
        $datos = $this->producto_model->get_categorias();
        $this->response($datos);
    }

    public function anchos_get() {
        $datos = $this->producto_model->get_anchos();
        $this->response($datos);
    }
    
    public function garantias_get() {
        $datos = $this->producto_model->get_garantias();
        $this->response($datos);
    }

}
