<?php
namespace Application\Plugin\PHPMailer;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Application\Plugin\PHPMailer\PHPMailer;
/**
 * Description of EnvoiMail
 *
 * @author kjkoffi
 */
class EnvoiMail {
    public $expediteur;
    public $nomExpediteur;
    public $destinataire;
    public $objet;
    public $message;
    private $mail;
    
    public function __construct() {
        $this->mail = new PHPMailer();
        $this->initConfig();
    }
    
    private function initConfig(){
        $env = isset($_SERVER['APPLICATION_ENV']) ? $_SERVER['APPLICATION_ENV'] :'development';
        require __DIR__ . '/../../../../../config/envs/'.$env.'.php';
        $globalConfig = $conf;
        //var_dump($globalConfig['mailConf']);die;

        //$this->mail->SMTPDebug = 3;                                   // Enable verbose debug output
        try {
            $this->mail->isSMTP();                                      // Set mailer to use SMTP
            $this->mail->Host = $globalConfig['mailConf']['host'];      // Specify main and backup SMTP servers
            $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
            $this->mail->Username = $globalConfig['mailConf']['user'];  // SMTP username
            $this->mail->Password = $globalConfig['mailConf']['pass'];  // SMTP password
            $this->mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port = 465;  
            $this->mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true)
               );                                                 // TCP port to connect to
            
            $this->mail->CharSet="utf-8";
            $this->destinataire = $globalConfig['mailConf']['user'];
            
        } catch (Exception $e) {
            error_log("InitConfig: {$this->mail->ErrorInfo}");
        }
    }
    
    public function envoyer(){
        
        if(empty($this->expediteur) || empty($this->objet) || empty($this->message)){
            error_log("EnvoiMail: Donnée invalide");
            return false;
        }
        
        try {
            $this->mail->From = $this->expediteur; //'kjonas9@yahoo.fr';
            if(!empty($this->nomExpediteur)){
                $this->mail->FromName = $this->nomExpediteur;
            }
            //$this->mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
            $this->mail->addAddress($this->destinataire);               // Name is optional
            //$this->mail->addReplyTo('info@example.com', 'Information');
            //$this->mail->addCC('cc@example.com');
            //$this->mail->addBCC('bcc@example.com');

            //$this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $this->mail->isHTML(true);                            // Set email format to HTML
            $this->mail->Subject = $this->objet;
            $this->mail->Body    = $this->message;
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients rokyeli.com';

            if(!$this->mail->send()) {
                //echo 'Message could not be sent.';
                //echo 'Mailer Error: ' . $this->mail->ErrorInfo;
                error_log($this->mail->ErrorInfo);
                return false;
            } else {
                //echo 'Message has been sent';
                $this->mail->clearAddresses();
                $this->mail->clearAttachments();
                return true;
            }
        
        } catch (Exception $e) {
            error_log("Envoi de mail echoué: {$this->mail->ErrorInfo}");
            return false;
        }
    }
    
}
