<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recaptcha {

    const RECAPTCHA_API_SERVER = "https://www.google.com/recaptcha/api/siteverify";


    protected $post_data;
    protected $publicKey;
    protected $privatekey;
    protected $ip;
    protected $has_error;
            
    function __construct() {
            log_message('debug', "RECAPTCHA Class Initialized.");
            $this->_ci =& get_instance();
            $this->_ci->load->config('recaptcha');

            $this->post_data   = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';
            $this->publicKey  = $this->_ci->config->item('public_key');
            $this->privatekey  = $this->_ci->config->item('private_key');
            $this->ip = $_SERVER["REMOTE_ADDR"];
            
    }

    function html(){
        $html = "<script src='https://www.google.com/recaptcha/api.js'></script>";
        $html .= '<div class="g-recaptcha" data-sitekey="'. $this->publicKey .'"></div>';
        if($this->has_error)
            $html .= '<p style="color:#f56">There is some problem</p>';
        return $html;
    }

    function verification(){
        $request  = $this->_get_server_content();
        
        if(!strstr($request, "true")){
            $this->has_error = true;
            return false;
        }
        return true;
    }

    function _get_server_content()
    {
        $secretKey = $this->privatekey;
        $recaptchaResponse = $this->post_data;
        $userIP = $this->ip;
        return file_get_contents(self::RECAPTCHA_API_SERVER."?secret={$secretKey}&response={$recaptchaResponse}&remoteip={$userIP}");
    }
    
    



    



    







    


}
