<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class DefaultController extends CommunecterController {

  public $version = "v0.1.0";
  public $versionDate = "07/01/2018";
  public $keywords = "tools, opensource, collaboration, CO, communecter";
  public $description = "Any tools used for collaboration for CO Elements";
  public $pageTitle = "CO Tools";

  protected function beforeAction($action)
	{
    //parent::initPage();
	  return parent::beforeAction($action);
	}

  public function actions()
  {
      return array(
          'index'  => 'cotools.controllers.actions.IndexAction',
          'jsonedit'  => 'cotools.controllers.actions.JsoneditAction',
      );
  }
  
}
