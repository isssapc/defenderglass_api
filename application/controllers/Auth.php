<?php

require(APPPATH . 'libraries/jose/JWT.php');
require(APPPATH . 'libraries/jose/JWS.php');
require(APPPATH . 'libraries/jose/URLSafeBase64.php');

class Auth extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
    }

    public function _create_token($user) {

        /*         * *
         * sub => Subject
         * iat => IssuedAt
         * exp => Expiration
         * iss => Issuer
         * aud => Audience
         * 
         */

        $payload = [
            "sub" => $user['id_usuario'],
            "rol" => $user['id_rol'],
            "iat" => time(),
            "exp" => time() + (60 * 60 * 4) //1 hora * 4
        ];
        $jwt = new JOSE_JWT($payload);
        $jws = $jwt->sign($this->config->item('token_secret'));

        return $jws->toString();
    }

    public function login_post() {
        $email = $this->post('email');
        $password = $this->post('password');

        $usuario = $this->usuario_model->get_usuario_by_email($email);

        if (!isset($usuario)) {
            $this->response(["error" => ["message" => "El email y/o password son incorrectos"]], REST_Controller::HTTP_UNAUTHORIZED);
        }

        if ($usuario["password"] === $password) {
            unset($usuario['password']);
            $this->response(["token" => $this->_create_token($usuario), "usuario" => $usuario]);
        } else {
            $this->response(["error" => ["message" => "El email y/o password son incorrectos"]], REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function rol_post() {
        $headers = $this->input->request_headers();

        if (!array_key_exists('Authorization', $headers)) {
            $this->response(["error" => ["message" => "Inicie sesión para acceder a los recursos del sistema"]], REST_Controller::HTTP_UNAUTHORIZED);
        }

        $authorization = $headers['Authorization'];
        $token = explode(' ', $authorization)[1];
        $jwt = JOSE_JWT::decode($token);
        $jws = new JOSE_JWS($jwt);
        //throw Exception  Signature Verification Failed en caso de fallo
        $jws->verify($this->config->item('token_secret'));

        if ($jws->claims['exp'] < time()) {
            $this->response(["error" => ["message" => "Su sesión ha caducado"]], REST_Controller::HTTP_UNAUTHORIZED);
        } else {
            $this->response($jws->claims['rol']);
        }
    }

    public function signup_post() {
        //$cliente = $this->post('cliente');
        //$datos = $this->login_model->add_cliente($cliente);
        $ramiro = [];
        $ramiro['nombre'] = "ramiro";
        $ramiro['ap_paterno'] = "jimenez";
        $ramiro['ap_materno'] = "arechar";
        $this->response($ramiro);
    }

    public function unlink_post() {
        //$cliente = $this->post('cliente');
        //$datos = $this->login_model->add_cliente($cliente);
        $ramiro = [];
        $ramiro['nombre'] = "ramiro";
        $ramiro['ap_paterno'] = "jimenez";
        $ramiro['ap_materno'] = "arechar";
        $this->response($ramiro);
    }

}
