## Introduction
N'ayez pas peur ! Le code est écrit de manière accessible afin que vous puissiez y contribuer facilement.
Si vous êtes à l'aise avec les méthodes plus "standard" dans l'industrie, il est possible de coder de votre côté et de communiquer via l'API.

## Ressources pour débuter
* **[Présentation du code en vidéo (30 minutes)](https://www.youtube.com/watch?v=2rkE69--LxM)**
* [Documentation de l'API](http://co.tools/API)
* [Fonctionnement PHP](https://docs.google.com/drawings/d/1nSlaLy6ce7CWxvkXUbwIEYNVTeL6f35qm0CqoBjlvR0/edit?usp=sharing)
* [Communauté des développeurs](https://www.communecter.org/#@codev)
* [Pense-bête de commandes GIT](https://gist.github.com/aquelito/8596717)
* [Feuille de route des développeurs](https://raw.githubusercontent.com/pixelhumain/communecter/master/docs/roadmap.org)

## Architecture
Le motif utilisé est le classique [Modèle-vue-contrôleur](https://fr.wikipedia.org/wiki/Mod%C3%A8le-vue-contr%C3%B4leur). Une grosse partie du code se trouve dans le [dépôt CO2 de notre Github](https://github.com/pixelhumain/co2/), tandis que [citizenToolKit](https://github.com/pixelhumain/citizenToolKit) gère plutôt le backend.

## Construction d'une URL
Les URL sont gérées par [co.js](https://github.com/pixelhumain/co2/blob/master/assets/js/co.js) et se présentent sous la forme suivante : `/ph/[module]/#[application]`

* `module` est un outil possédant une interface dédiée (CO2 est la plus visible mais il y a également le [network](https://wiki.communecter.org/fr/network---cr%C3%A9er-une-carte.html) ou l'[API](http://co.tools/API) par exemple).
* `application` correspond aux [applications utilisateurs](https://wiki.communecter.org/fr/pr%C3%A9sentation-fonctionnelle.html). Elles sont déclarées dans [params.json](https://github.com/pixelhumain/co2/blob/master/config/CO2/params.json). Le paramètre `hash` au sein de chacune des applications défini quel contrôleur sera utilisé. Les contrôleurs se trouvent dans [co2/controllers](https://github.com/pixelhumain/co2/tree/master/controllers), et définissent quelle vue va être chargée ([liste des vues](https://github.com/pixelhumain/co2/tree/master/views)).

> Par exemple la page `communecter.org/#search` correspond à la vue [co2/views/app/search.php](https://github.com/pixelhumain/co2/blob/master/views/app/search.php).
