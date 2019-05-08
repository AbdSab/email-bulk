<?php

class TemplateParser{

    private $data;
    private $template;

    public function __construct($template, $data){
        $this->template = $template;
        $this->data = $data;
    }

    public function parse(){
        $explodedTemplate = explode("#", $this->template);
        $result = '';
        foreach($explodedTemplate as $key=>$sentence){
            if($key % 2 == 0){
                $result .= $sentence;
            }else{
                $result .= $this->data[$sentence];
            }
        }
        return $result;
    }

}