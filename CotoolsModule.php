<?php
/**
 * CO Tools Module
 *
 * @author Tibor Katelbach <oceatoon@mail.com>
 * @version 0.1
 *
*/

class CotoolsModule extends CWebModule {

	private $_assetsUrl;

	public function getAssetsUrl()
	{
		if ($this->_assetsUrl === null)
	        $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
	            Yii::getPathOfAlias($this->id.'.assets') );
	    return $this->_assetsUrl;
	}

	public function beforeControllerAction($controller, $action)
	{
		if (parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		Yii::app()->setComponents(array(
		    'errorHandler'=>array(
		        'errorAction'=>'/'.$this->id.'/error'
		    )
		));
		
		Yii::app()->homeUrl = Yii::app()->createUrl($this->id);
		
		//Apply theme
		$themeName = $this->getTheme();
		Yii::app()->theme = $themeName;
		
       if(@Yii::app()->request->cookies['lang'] && !empty(Yii::app()->request->cookies['lang']->value))
        	Yii::app()->language = (string)Yii::app()->request->cookies['lang'];
        else 
			Yii::app()->language = (isset(Yii::app()->session["lang"])) ? Yii::app()->session["lang"] : 'fr';

		Yii::app()->params["module"] = array(
			"parent" => "co2",
			"overwriteList" => array(
				"views" => array(),
				"assets" => array(),
				"controllers" => array(),
			));

		$this->setImport(array(
			'citizenToolKit.models.*',
			Yii::app()->params["module"]["parent"].'.models.*',
			Yii::app()->params["module"]["parent"].'.components.*',
			$this->id.'.models.*',
			$this->id.'.components.*',
			$this->id.'.messages.*',
		));
	}


	/**
	 * Retourne le theme d'affichage de communecter.
	 * Si option "theme" dans paramsConfig.php : 
	 * Si aucune option n'est précisée, le thème par défaut est "ph-dori"
	 * Si option 'tpl' fixée dans l'URL avec la valeur "iframesig" => le theme devient iframesig
	 * Si option "network" fixée dans l'URL : theme est à network et la valeur du parametres fixe les filtres d'affichage
	 * @return type
	 */
	public function getTheme() {
		//$theme = "CO2";
		$theme = (@Yii::app()->session["theme"]) ? Yii::app()->session["theme"] : "CO2";
		//$theme = "notragora";
		if (!empty(Yii::app()->params['theme'])) {
			$theme = Yii::app()->params['theme'];
		} else if (empty(Yii::app()->theme)) {
			$theme = (@Yii::app()->session["theme"]) ? Yii::app()->session["theme"] : "CO2";
			//$theme = "CO2";
			//$theme = "notragora";
		}

        Yii::app()->session["theme"] = $theme;
		return $theme;
	}
}
