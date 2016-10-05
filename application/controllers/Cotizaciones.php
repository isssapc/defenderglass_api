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
        $data = $this->cotizacion_model->add_cotizacion($cotizacion);
        $this->response($data);
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
            $pdf->SetFont('Arial', '', 10);
            $h = 6;
            $borde = 0;
            $ln = 1;
            $x = 40;

            $w_key = 20;
            $w_value = 50;
            $x_header = -100;
//            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Fecha:'), $borde);
//            $pdf->Cell($w_value, $h, iconv('utf-8', 'iso-8859-1', '27/Julio/2016'), $borde);
//            $pdf->SetX($x_header);
//            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Cot:'), $borde);
//            $pdf->Cell($w_value, $h, iconv('utf-8', 'iso-8859-1', 'DGAR-1222'), $borde, $ln);
//
//            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Cliente:'), $borde);
//            $pdf->Cell($w_value, $h, iconv('utf-8', 'iso-8859-1', 'Procesa Glass'), $borde);
//            $pdf->SetX($x_header);
//            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Tel:'), $borde);
//            $pdf->Cell($w_value, $h, iconv('utf-8', 'iso-8859-1', '(55)63027019'), $borde, $ln);
//
//            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Atención:'), $borde);
//            $pdf->Cell($w_value, $h, iconv('utf-8', 'iso-8859-1', 'Alfonzo Libaro'), $borde);
//            $pdf->SetX($x_header);
//            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Email:'), $borde);
//            $pdf->Cell($w_value, $h, iconv('utf-8', 'iso-8859-1', 'edder@procesaglass.com'), $borde, $ln);
//
//            $pdf->Cell($w_key, $h, iconv('utf-8', 'iso-8859-1', 'Domicilio:'), $borde);
//            $pdf->MultiCell(0, $h, iconv('utf-8', 'iso-8859-1', 'Conocido'));
//            $pdf->Ln();
//            $intro = "Por medio de la presente ponemos a su consideración el presupuesto "
//                    . "de instalación de la película, la cual tiene las siguientes "
//                    . "características:";



            $pdf->Cell(0, $h, iconv('utf-8', 'iso-8859-1', $cotizacion['fecha']), $borde, $ln, 'R');
            $pdf->MultiCell(0, $h, mb_strtoupper(iconv('utf-8', 'iso-8859-1', $cotizacion['dirigido']), 'iso-8859-1'));
            $pdf->Ln();
            $intro = $cotizacion['intro'];
            $pdf->MultiCell(0, $h, iconv('utf-8', 'iso-8859-1', $intro));
            $pdf->Ln();

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'CARACTERÍSTICAS GENERALES'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', 'VALORES NOMINALES'), $borde, $ln);
            $pdf->Ln(3);
            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'MODELO'), $borde);
            $pdf->Cell(50, $h, mb_strtoupper(iconv('utf-8', 'iso-8859-1', $cotizacion['rollo_152']['modelo']), 'iso-8859-1'), $borde, $ln);

            $pdf->SetX($x);

            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'GARANTÍA'), $borde);
            $pdf->Cell(50, $h, mb_strtoupper(iconv('utf-8', 'iso-8859-1', $cotizacion['garantia']['nombre']), 'iso-8859-1'), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'PROTECCIÓN CONTRA RAYOS UV'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', $cotizacion['rollo_152']['proteccion_uv'] . " %"), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'TOTAL DE ENERGÍA RECHAZADA'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', "HASTA UN " . $cotizacion['rollo_152']['rechazo_solar'] . " %"), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'TRANSMISIÓN DE LUZ VISIBLE'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', "HASTA UN " . $cotizacion['rollo_152']['transmision_luz'] . " %"), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'm2 TOTALES'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', $cotizacion['efectivo_m2']), $borde, $ln);


            //$inversion = ($cotizacion['total_efectivo_152'] + $cotizacion['total_merma_152']);
            $inversion = $cotizacion['total_dolares'];
            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'INVERSIÓN CONTROL SOLAR'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', 'USD ' . number_format($inversion, 2, '.', ',')), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'INVERSIÓN ANUAL POR GARANTÍA'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', 'USD ' . number_format($inversion / 10, 2, '.', ',')), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'INVERSIÓN MENSUAL POR GARANTÍA'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', 'USD ' . number_format($inversion / (10 * 12), 2, '.', ',')), $borde, $ln);

            $pdf->SetX($x);
            $pdf->Cell(80, $h, iconv('utf-8', 'iso-8859-1', 'INVERSIÓN DIARIA POR GARANTÍA'), $borde);
            $pdf->Cell(50, $h, iconv('utf-8', 'iso-8859-1', 'USD ' . number_format($inversion / (10 * 12 * 30), 2, '.', ',')), $borde, $ln);


            $pdf->Ln();
//            $nota = "- Precios más IVA \n"
//                    . "- Garantía de 10 años en desadhesión y decoloración \n"
//                    . "- Precios no incluyen gastos extras \n"
//                    . "- Se requiere anticipo de 70% \n"
//                    . "- Sujeto a programa de instalación \n"
//                    . "- Precios Sujetos al tipo de cambio del Dólar del día (Banco Santander Serfin)";

            $nota = $cotizacion['notas'];

            $pdf->SetFont('Arial', '', 8);
            $h_xs = 4;
            $pdf->MultiCell(0, $h_xs, iconv('utf-8', 'iso-8859-1', $nota));

            $pdf->Ln();

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(0, $h, iconv('utf-8', 'iso-8859-1', 'ATENTAMENTE'), $borde, $ln, "C");
            $pdf->Ln();
            $pdf->Cell(0, $h, mb_strtoupper(iconv('utf-8', 'iso-8859-1', $cotizacion['autor']), 'iso-8859-1'), $borde, $ln, "C");
            $pdf->Cell(0, $h, mb_strtoupper(iconv('utf-8', 'iso-8859-1', $cotizacion['autor_cargo']), 'iso-8859-1'), $borde, $ln, "C");



//            $cuenta = "Información Bancaria para Depósitos:\n"
//                    . "Austral de Chiapas  S. A. de  C.V.\n"
//                    . "Banco: Bancomer\n"
//                    . "N. Cta.: 0163887138\n"
//                    . "Cta. Clave: 012100001638871381\n"
//                    . "Correo Electrónico: defenderglass_veracruz@hotmail.com";

            $cuenta = $cotizacion['cuenta'];

            $pdf->SetFont('Arial', '', 8);
            $pdf->MultiCell(0, $h_xs, iconv('utf-8', 'iso-8859-1', $cuenta));

            //$pdf->Output();
            //$pdf->Output("ReporteEntradas.pdf", "I");
//            $value = $pdf->Output("Reporte.pdf", "S");             
//            $s = base64_encode($value);
//            $this->response(["pdfbase64" => $s]);

            $value = $pdf->Output("public/Reporte.pdf", "F");
            $this->response(["filename" => 'Reporte.pdf']);
        } catch (Exception $exc) {
            $this->response("NULL", REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
