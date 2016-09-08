<?php

define('FPDF_FONTPATH', APPPATH . 'libraries/fpdf/font/');
require_once APPPATH . 'libraries/fpdf/fpdf.php';

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
        $datos = $this->cotizacion_model->get_cotizaciones();
        $this->response($datos);
    }

    public function one_get($id_cotizacion) {
        $cotizacion = $this->cotizacion_model->get_cotizacion($id_cotizacion);
        $this->response($cotizacion);
    }

    public function remove_delete($id_cotizacion) {
        $datos = $this->cotizacion_model->del_cotizacion($id_cotizacion);
        $this->response($datos);
    }

    public function update_put($id_cotizacion) {
        $cotizacion = $this->put('cotizacion');
        $datos = $this->cotizacion_model->update_cotizacion($id_cotizacion, $cotizacion);
        $this->response($datos);
    }

    public function reporte_post($id_cotizacion) {
        $cotizacion = $this->post('cotizacion');
        //$datos = $this->cotizacion_model->reporte_cotizacion($id_cotizacion, $cotizacion);
        //$this->response($datos);

        try {
            $pdf = new FPDF('P', 'mm', 'letter');
            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 12);
            $h = 7;
            $borde = 0;
            $ln = 1;
            $x = 40;

            $w_key = 20;
            $w_value = 50;
            $x_header = -100;
            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Fecha:'), $borde);
            $pdf->Cell($w_value, $h, iconv('utf-8', 'iso-8859-1', '27/Julio/2016'), $borde);
            $pdf->SetX($x_header);
            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Cot:'), $borde);
            $pdf->Cell($w_value, $h, iconv('utf-8', 'iso-8859-1', 'DGAR-1222'), $borde, $ln);

            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Cliente:'), $borde);
            $pdf->Cell($w_value, $h, iconv('utf-8', 'iso-8859-1', 'Procesa Glass'), $borde);
            $pdf->SetX($x_header);
            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Tel:'), $borde);
            $pdf->Cell($w_value, $h, iconv('utf-8', 'iso-8859-1', '(55)63027019'), $borde, $ln);

            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Atención:'), $borde);
            $pdf->Cell($w_value, $h, iconv('utf-8', 'iso-8859-1', 'Alfonzo Libaro'), $borde);
            $pdf->SetX($x_header);
            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Email:'), $borde);
            $pdf->Cell($w_value, $h, iconv('utf-8', 'iso-8859-1', 'edder@procesaglass.com'), $borde, $ln);

            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Domicilio:'), $borde);
            $pdf->MultiCell(0, $h, iconv('utf-8', 'iso-8859-1', 'Conocido'));
            $pdf->Ln();


            $intro = "Por medio de la presente ponemos a su consideración el presupuesto "
                    . "de instalación de la película, la cual tiene las siguientes "
                    . "características:";
            $pdf->MultiCell(0, $h, iconv('utf-8', 'iso-8859-1', $intro));
            $pdf->Ln();

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'Características Generales'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', 'Valores Nominales'), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'Concepto 1'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', 'Valores 1'), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'Concepto 2'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', 'Valores 2'), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'Concepto 3'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', 'Valores 3'), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'Concepto 4'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', 'Valores 4'), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'Concepto 5'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', 'Valores 5'), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'Concepto 6'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', 'Valores 6'), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'Concepto 7'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', 'Valores 7'), $borde, $ln);

            $pdf->Ln();
            $nota = "- Precios más IVA \n"
                    . "- Garantía de 10 años en desadhesión y decoloración \n"
                    . "- Precios no incluyen gastos extras \n"
                    . "- Se requiere anticipo de 70% \n"
                    . "- Sujeto a programa de instalación \n"
                    . "- Precios Sujetos al tipo de cambio del Dólar del día (Banco Santander Serfin)";

            $pdf->SetFont('Arial', '', 8);
            $h_xs = 4;
            $pdf->MultiCell(0, $h_xs, iconv('utf-8', 'iso-8859-1', $nota));

            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, $h, iconv('utf-8', 'iso-8859-1', 'ATENTAMENTE'), $borde, $ln, "C");
            $pdf->Ln();
            $pdf->Cell(0, $h, iconv('utf-8', 'iso-8859-1', 'Raúl González Calva'), $borde, $ln, "C");
            $pdf->Cell(0, $h, iconv('utf-8', 'iso-8859-1', 'Gerente General'), $borde, $ln, "C");



            $cuenta = "Información Bancaria para Depósitos:\n"
                    . "Austral de Chiapas  S. A. de  C.V.\n"
                    . "Banco: Bancomer\n"
                    . "N. Cta.: 0163887138\n"
                    . "Cta. Clave: 012100001638871381\n"
                    . "Correo Electrónico: defenderglass_veracruz@hotmail.com";

            $pdf->SetFont('Arial', '', 8);
            $pdf->MultiCell(0, $h_xs, iconv('utf-8', 'iso-8859-1', $cuenta));

            //$pdf->Output();
            //$pdf->Output("ReporteEntradas.pdf", "I");

            $value = $pdf->Output("Reporte.pdf", "S");
            $s = base64_encode($value);
            $this->response(["pdfbase64" => $s]);
        } catch (Exception $exc) {
            $this->response("NULL", REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
