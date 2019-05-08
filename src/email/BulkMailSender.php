<?php

require_once("Email.php");
require_once("../template/TemplateManager.php");

class BulkMailSender{

    private $emailPath = __DIR__ . '/../../storage/emails';
    private $indexPath = __DIR__ . '/../../storage/index';
    private $fromEmail = __DIR__ . '/../../storage/from_email';

    private $email;
    private $index;

    private $emailList;
    private $templateManager;

    public function __construct(){
        $this->email = new Email();
        $this->templateManager = new TemplateManager();
    }

    public function addEmail($email){
        $this->emailList[] = $email;
    }

    public function sendEmails(){
        $this->templateManager->setTemplateName('template');
        foreach($this->emailList as $emailData){
            $this->templateManager->setData([
                "entreprise" => $emailData['name']
            ]);
            $message = $this->templateManager->getParsedTemplate();
            $this->email->from($this->fromEmail);
            $this->email->to($emailData['email']);
            $this->email->message($message);
            $this->email->subject("");

            $this->email->sendMail();
        }
    }

    public function setIndex($index){
        $this->index = $index;
    }

    private function saveEmails(){
        $emailFileContent = '';
        foreach($this->emailList as $emailData){
            $emailFileContent .= $emailData['name'] . '#' . $emailData['email'];
        }
        file_put_contents($this->emailPath, $emailFileContent);
    }

    public function resume(){
        $this->getSavedIndex();
        $this->getSavedEmails();
        $this->sendEmails();
    }

    private function getSavedEmails(){
        $this->emailList = file_get_contents($this->emailPath);
    }

    private function getSavedIndex(){
        $this->index = file_get_contents($this->indexPath);
    }

}