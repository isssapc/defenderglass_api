<?php

class Cotizaciones extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('cotizacion_model');
    }

    public function index_post() {
        $cotizacion = $this->post('cotizacion');
        $nuevo = $this->cotizacion_model->add_cotizacion($cotizacion);
        $this->response($nuevo);
    }

    public function index_get() {
        $nuevo = $this->cotizacion_model->get_cotizaciones();
        $this->response($nuevo);
    }

    public function one_get($id_cotizacion) {        
        $cotizacion = $this->cotizacion_model->get_cotizacion($id_cotizacion);
        $this->response($cotizacion);
    }

    public function remove_delete($id_cotizacion) {        
        $nuevo = $this->cotizacion_model->del_cotizacion($id_cotizacion);
        $this->response($nuevo);
    }

    public function update_put($id_cotizacion) {
        $cotizacion = $this->post('cotizacion');
        $nuevo = $this->cotizacion_model->update_cotizacion($id_cotizacion,$cotizacion);
        $this->response($nuevo);
    }

}
