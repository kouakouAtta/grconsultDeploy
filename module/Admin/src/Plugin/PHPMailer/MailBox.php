<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Plugin\PHPMailer;

/**
 * Description of MailBox
 *
 * @author kjkoffi
 */

class MailBox {
    public $conn; //imap server connection
    
    // inbox storage and inbox message count
    private $inbox;
    private $msg_cnt;

    // email login credentials
    private $server = null;
    private $user   = null;
    private $pass   = null;
    private $port   = 995;
    
    function __construct() {
        //Récuperation des paramètres
        $env = isset($_SERVER['APPLICATION_ENV']) ? $_SERVER['APPLICATION_ENV'] :'development';
        require __DIR__ . '/../../../../../config/envs/'.$env.'.php';
        $globalConfig = $conf;
        $this->server = $globalConfig['mailConf']['host'];
        $this->user = $globalConfig['mailConf']['user'];
        $this->pass = $globalConfig['mailConf']['pass'];
        //var_dump($env); die;
        
        $this->connect();
        //$this->inbox();
    }
    
    function __destruct() {
        if(!empty($this->conn)){
            $this->close();
        }
    }
            
    private function close() {
        $this->inbox = [];
        $this->msg_cnt = 0;

        imap_close($this->conn);
    }
    
    // open the server connection
    // the imap_open function parameters will need to be changed for the particular server
    // these are laid out to connect to a Dreamhost IMAP server
    private function connect() {
        $this->conn = imap_open('{'.$this->server.':'.$this->port.'/pop3/ssl/novalidate-cert}', $this->user, $this->pass);
    }
    
    // move the message to a new folder
    public function move($msg_index, $folder='INBOX.Processed') {
        // move on server
        imap_mail_move($this->conn, $msg_index, $folder);
        imap_expunge($this->conn);

        // re-read the inbox
        $this->inbox();
    }

    // get a specific message (1 = first email, 2 = second email, etc.)
    /*public function get($msg_index=NULL) {
        if (count($this->inbox) <= 0) {
            return array();
        }
        elseif ( ! is_null($msg_index) && isset($this->inbox[$msg_index])) {
            return $this->inbox[$msg_index];
        }

        return $this->inbox[0];
    }*/
    public function get($msg_index) {
        //var_dump(imap_body($this->conn, $msg_index, 2)); die;
        return [
            'header'    => imap_headerinfo($this->conn, $msg_index),
            'body'      => empty(imap_fetchbody($this->conn, $msg_index, 2)) ? imap_body($this->conn, $msg_index) : imap_fetchbody($this->conn, $msg_index, 2), //imap_fetchbody($this->conn, $msg_index, 2),
            'structure' => imap_fetchstructure($this->conn, $msg_index)
        ];
    }
    
    // read the inbox
    private function inbox() {
        $this->msg_cnt = imap_num_msg($this->conn);

        $in = array();
        for($i = 1; $i <= $this->msg_cnt; $i++) {
            $header = imap_headerinfo($this->conn, $i);
            
            $in[] = array(
                'index'     => imap_uid($this->conn, $i),
                'subject'   => mb_decode_mimeheader($header->subject),
                'header'    => $header,
                //'body'      => imap_body($this->conn, $i),
                //'structure' => imap_fetchstructure($this->conn, $i)
            );
        }
        //var_dump($this->mailDecode->decode_header($in[0]['header']->subject)); die;
        //var_dump($in[count($in)-1]); die;
        $this->inbox = $in;
    }
    
    public function getIndox(){
        $this->inbox();
        return $this->inbox;
    }
    
    public function getMsgSended(){
        //imap_li
    }
}
