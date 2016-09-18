<?php

require_once APPPATH . 'libraries/PHPExcel_1.8.0/Classes/PHPExcel/IOFactory.php';

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

    public function _insert_excel($filename) {




        //recuperamos los parametros
        //$filename = $this->post('filename');
        //creamos el reder del documento excel
        $nombre_archivo = "public/excel/" . $filename;
        $tipo_archivo = PHPExcel_IOFactory::identify($nombre_archivo);
        $reader = PHPExcel_IOFactory::createReader($tipo_archivo);
        $reader->setReadDataOnly(TRUE);
        //leemos el documento excel
        $objPHPExcel = $reader->load($nombre_archivo);

        //obtenemos los datos de la hoja activa (la primera)
        $worksheet = $objPHPExcel->getActiveSheet();
        if (!isset($worksheet)) {
            $worksheet = $objPHPExcel->getSheet(0);
        }
        $objHoja = $worksheet->toArray(null, true, true, true);

//iniciamos la transaccion
        $this->db->trans_start();
        //contador para el numero de filas
        $i = 1;
        foreach ($objHoja as $fila) {

            $clave = trim($fila['A']);
            $marca = trim($fila['B']);
            $modelo = trim($fila['C']);
            $segmento = trim($fila['D']);
            $categoria = trim($fila['E']);
            $ancho = trim($fila['F']);
            $seguridad = trim($fila['G']);
            $precio = trim($fila['H']);
            $proteccion_uv = trim($fila['I']);
            $rechazo_solar = trim($fila['J']);
            $transmision_luz = trim($fila['K']);


            if (
                    !empty($modelo) && 
                    !empty($segmento) && 
                    !empty($categoria) && 
                    !empty($ancho) && 
                    !empty($precio) && 
                    is_numeric($segmento) && 
                    is_numeric($categoria) && 
                    is_numeric($ancho) && 
                    is_numeric($precio)) {

                //insertamos la partida
                $data = array(
                    "clave" => $clave,
                    "modelo" => $modelo,
                    "rechazo_solar" => $rechazo_solar,
                    "proteccion_uv" => $proteccion_uv,
                    "transmision_luz" => $transmision_luz,
                    "precio" => $precio,
                    "id_ancho" => $ancho,
                    "id_categoria" => $categoria,
                    "marca" => $marca,
                    "id_seguridad" => $seguridad,
                    "id_segmento" => $segmento,
                );
                $this->db->insert('producto', $data);

                //guardamos el id del producto
                $id_producto = $this->db->insert_id();
            }


            $i++;
        }

        //termina la transaccion
        $this->db->trans_complete();

        //si hay algun error
        if ($this->db->trans_status() === FALSE) {
            $error = $this->db->error();
            $this->response($error, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        //no hay errores, devolvemos el id del prototipo creado
        //$this->response(array("id_prototipo" => $id_prototipo));
    }

    public function upload_post() {
        $config['upload_path'] = './public/excel';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = 4096; //4MB
        $config['overwrite'] = FALSE;
        $config['file_ext_tolower'] = TRUE;
        $config['remove_spaces'] = TRUE;


        $this->load->library('upload', $config);

        $file = 'file';
        if (!$this->upload->do_upload($file)) {
            $error = $this->upload->error_msg;
            $this->response(["error" => $error], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $data = $this->upload->data();

            $this->_insert_excel($data['file_name']);


            $this->response(["data" => $data]);
        }
    }

}
