<?php

class GastosExtras extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('gastoextra_model');
    }

    public function index_post() {
        $gasto = $this->post('gasto');
        $nuevo = $this->gastoextra_model->add_gasto($gasto);
        $this->response($nuevo);
    }

    public function index_get() {
        $nuevo = $this->gastoextra_model->get_gastos();
        $this->response($nuevo);
    }

    public function one_get($id_gasto) {        
        $gasto = $this->gastoextra_model->get_gasto($id_gasto);
        $this->response($gasto);
    }

    public function remove_delete($id_gasto) {        
        $nuevo = $this->gastoextra_model->del_gasto($id_gasto);
        $this->response($nuevo);
    }

    public function update_put($id_gasto) {
        $gasto = $this->put('gasto');
        $datos = $this->gastoextra_model->update_gasto($id_gasto,$gasto);
        $this->response($datos);
    }

}
