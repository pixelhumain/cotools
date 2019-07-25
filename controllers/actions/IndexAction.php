<?php
class IndexAction extends CAction
{
    public function run()
    {
    	$this->getController()->layout = "//layouts/cotools";
    	$this->getController()->render("index");
    }
}