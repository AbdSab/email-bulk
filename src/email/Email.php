<?php

class Email{
    private $from;
    private $to;
    private $message;
    private $subject;
    private $header;
    
    public function from($from){
        $this->from = $from;
        $this->header = 'From: '.$this->from;
    }

    public function to($to){
        $this->to = $to;
    }

    public function message($message){
        $this->message = $message;
    }

    public function subject($subject){
        $this->subject = $subject;
    }

    public function sendMail(){
        mail($this->to,$this->subject,$this->message,$this->headers);
    }

}