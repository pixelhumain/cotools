<?php
class JsoneditAction extends CAction
{
    public function run( $col, $attr, $val )
    {
    	$params = array( "json" => null );
    	if(isset( $col ) && isset( $attr ) && isset( $val )) 
    		$params["json"] = PHDB::findOne( $col, array( $attr => $val ) );
    	//var_dump(array( $attr => $val ) );
    	$this->getController()->layout = "//layouts/empty";
    	$this->getController()->render("jsonedit",$params);
    }
}