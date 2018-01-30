# Créer une application ou un élément
_Traduction anglaise: [Create an application or item](https://github.com/pixelhumain/wiki-en/wiki/Create-an-application-or-item)_

## Définition
CO2 est le nom du module correspondant à la 2nd version du module Communecter (www.communecter.org).
Le module CO2 fait parti du projet PixelHumain, au même titre que d'autres modules développés au sein de PixelHumain ([qu'est qu'un module ?](http://www.yiiframework.com/doc/guide/1.1/en/basics.module)).

CO2 a lui même été construit de façon à pouvoir intégrer facilement de nouvelles applications, et les activer/désactiver très facilement, via 1 seul fichier de configuration : https://github.com/pixelhumain/co2/blob/master/config/CO2/params.json

Les applications actuellement activées pour le site communecter.org sont : welcome, recherche, agenda, annonces, live, page, et info.
Ce fichier sert à configurer un certain nombre de paramètres pour chaque application, ce qui permet de configurer très rapidement une nouvelle app, sans toucher au code commun qui gère toutes les applications. 

Cela permet aussi de mettre en place des instances différentes de communecter.org (exemple : autrerezo.org, makietjichel.com, ou autres...), sur lesquelles les administrateurs de l'instance peuvent activer et désactiver les applications qu'ils souhaitent utiliser, sans avoir à supprimer ou modifier du code.

Les développeurs peuvent aussi créer de nouvelles applications à volonté.

# Créer une nouvelle application dans CO2

## 1- Ajouter l'application dans le fichier /modules/co2/config/CO2/params.json, en suivant l'exemple suivant : 

Il convient bien évidemment de remplacer "#nomdelapplication" par le nom de votre application, les titres ect ...
Pour l'icône, choisir un nom parmi cette liste : http://fontawesome.io/icons/

```JSON
"#nomdelapplication": {
            "inMenu" : true, 
            "useHeader" : true, 
            "open" : true, 
            "subdomain" : "nomdelapplication", 
            "subdomainName" : "Nomdelapplication",
            "hash" : "#app.nomdelapplication",
            "icon" : "nomDeLIconeFontawesome", 
            "mainTitle" : "Nom de l'application",
            "placeholderMainSearch" : "Rechercher dans ..."
        }, 
```
(il est conseillé d'indiquer tous les paramètres, mais il est possible d'en enlever ou d'en rajouter selon vos besoins.)


## 2- Ajouter une nouvelle fonction dans le fichier AppController.php du module CO2 

Ouvrir le fichier /modules/co2/controllers/AppController.php et rajouter par exemple : 

```PHP
  public function actionNomdelapplication(){
    CO2Stat::incNbLoad("co2-nomdelapplication");
    echo $this->renderPartial("nomdelapplication", array(), true);
  }
```

## 3- Créer les liens vers les actions

Dans /modules/co2/components/CommunecterController.php, il faut ajouter votre lien dans l'array "app" : 
(l'array app se situe environ à la ligne 460 du fichier)

```PHP
"app" => array(
      "nomdelapplication" => array('href' => "/ph/communecter/app/nomdelapplication", "public" => true),
), 
```

## 4- Créer la vue 

Elle est appelée par le contrôleur pour gérer l'affichage (code HTML, CSS, JS).

Créer le fichier /modules/co2/views/app/nomdelapplication.php

On peut inclure le code d'une autre vue en utilisant $this->renderPartial


## 5- Accéder à votre application 

Bravo ! Maintenant vous n'avez plus qu'à accéder à votre application grâce à l'url suivante : 

` http://127.0.0.1/ph/co2#nomdelapplication `

----------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------

# Créer un nouvel élément dans CO2
Communecter permet déjà de gérer plusieurs éléments : citoyens, organisations, projets, événement, news, point d'intérets, annonces, etc...)

Voici la marche à suivre pour ajouter et gérer un nouvel élément : 
(si vous créez une nouvelle application, vous aurez probablement besoin de gérer un (ou plusieurs) nouveau(x) type(s) d'élément(s))

## 1- Créer un nouveau controller dans le module CitizenToolKit

Créer le dossier /modules/citizenToolKit/controllers/nomdelelement 

Ce dossier contiendra l'ensemble de la logique métier.

A l'intérieur de ce dossier, créer les actions dont vous avez besoin. IndexAction est l'action par défaut.
Pour créer une action, créer un fichier comme "/modules/citizenToolKit/controllers/nomdelelement/IndexAction.php" qui contiendra par exemple :

```PHP
<?php
class IndexAction extends CAction
{
    public function run( $type=null, $id= null )
    {
      $controller=$this->getController();
      $params = array();
      $params["itemId"] = $id;
      $params['itemType'] = $type;

      if(Yii::app()->request->isAjaxRequest)
        echo $controller->renderPartial("index", $params,true);
      else
        $controller->render( "index" , $params );
    }
}
```
Et le fichier "/modules/citizenToolKit/controllers/nomdelelement/AutreAction.php"
```PHP
class AutreAction extends CAction
{
    public function run()
    {
      ...
    }
}
```

Créer les autres actions de la même manière : 
"/modules/citizenToolKit/controllers/nomdelelement/searchAction.php"
"/modules/citizenToolKit/controllers/nomdelelement/saveAction.php"
etc

## 2- Créer un nouveau modèle dans le module CitizenToolKit (si besoin)

Créer le fichier /modules/citizenToolKit/models/nomdelelement.php

```PHP
<?php 
class Nomdelelement {

  const COLLECTION = "nomdelelement";
  const CONTROLLER = "nomdelelement";
  const ICON = "fa-rss";
  const COLOR = "#F9B21A";

  public static function nomdelafonction() {
  }

}
```


## 3- Créer un nouveau controller dans le module CO2 

C'est lui qui sera appelé en premier et qui redigirera vers le controller du module CitizenToolKit.
Créer le fichier /modules/co2/controllers/NomdelelementController.php et le remplir comme dans l'exemple suivant : 

```PHP
<?php
/**
 * NomdelelementController.php
 * 
 * description
 *
 * @author: Prénom Nom <email@email.ext>
 * Date: dd/mm/yyyy
 */

class NomdelelementController extends CommunecterController {
  protected function beforeAction($action) {
      parent::initPage();
      return parent::beforeAction($action);
  }

  public function actions()
  {
    return array(
      'index'       => 'citizenToolKit.controllers.nomdelelement.IndexAction',
      'autre'       => 'citizenToolKit.controllers.nomdelelement.AutreAction'
    );
  }
}
```

L'array retourné par la fonction actions() contient l'essemble des pages qui seront traitées par les classes précédemment créées dans le module CitizenToolKit.



## 4- Créer les liens vers les actions

Dans /modules/co2/components/CommunecterController.php, il faut créer les liens vers les actions (qui afficheront les sous pages) dans l'array $pages :

```PHP
"nomdelelement" => array(
  "index"   => array("href" => "/ph/communecter/nomdelelement/index", "public" => true),
  "autre"   => array("href" => "/ph/communecter/nomdelelement/autre", "public" => true)
),
```



## 5- Créer la vue 

Elle est appelée par le contrôleur pour gérer l'affichage (code HTML, CSS, JS).

Créer le dossier /modules/co2/views/nomdelelement puis fichiers nommés en fonction du nom des actions :
- /modules/co2/views/nomdelelement/index.php
- /modules/co2/views/nomdelelement/autre.php

## 6- Accéder à l'élément

` http://127.0.0.1/co2/nomdelelement/index ` ou ` http://127.0.0.1/co2/nomdelelement/autre `
