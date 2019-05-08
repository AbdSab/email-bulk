<?php
require_once("TemplateParser.php");

class TemplateManager {

    private $template;
    private $parsedTemplate;
    private $data;
    private $templateName;
    private $fileName;
    private $templatesPath = __DIR__ . '/../../storage/';

    public function __construct(){
        $this->getTemplateContent();
    }

    public function setData($data){
        $this->data = $data;
    }

    public function setTemplateName($templateName){
        $this->templateName = $templateName;
        $this->fileName .= $this->templatesPath . $templateName;
    }

    private function getTemplateContent(){
        if(!file_exists($this->fileName))
            $this->template = '';
        else
            $this->template = file_get_contents($this->fileName);
    }

    private function saveTemplateToFile(){
        file_put_contents($this->fileName, $this->template);
    }

    private function parseTemplate(){
        $templateParser = new TemplateParser($this->template, $this->data);
        $this->parsedTemplate = $templateParser->parse();
    }

    public function getTemplate(){
        return $this->template;
    }
    
    public function saveTemplate($template){
        $this->template = $template;
        $this->saveTemplateToFile();
        return $this->getTemplate();
    }

    public function getParsedTemplate(){
        $this->parseTemplate();
        return $this->parsedTemplate;
    }

}