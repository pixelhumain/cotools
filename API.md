# Documentation de l'API
_Traduction anglaise: [Documentation of the API](https://github.com/pixelhumain/wiki-en/wiki/Documentation-of-the-API)_

## Get : Récupérer des informations
Depuis l'API vous avez la possibilité de récupérer différentes informations en provenance de Communecter :
 
* `[citoyens]` Citoyen
* `[organizations]` Organisation
* `[projects]` Projet
* `[events]` Événement
* `[needs]` Besoin
* `[news]` News

## Récupérer toutes les entités
`/api/[project || person || organization || event || need || news]/get/`

Exemple :
```html
https://www.communecter.org/api/organization/get
```

Pour voir la description du résultat aller dans la rubrique "Les attributs".

## Paramétrer la recherche
Vous avez la possibilité d'ajouter des paramètres pour peaufiner votre recherche : 
* `[id]` Identifiant
* `[tags]` Tags
* `[insee]` Code Insee
* `[format]` Format

### Récupérer une entité via son identifiant
`/ph/communecter/data/get/type/(projects || citoyens || organizations || events || news)/id/[id_entity]`

Exemple :
```html
https://www.communecter.org/api/organization/get/id/57186ed894ef47210d7b242d
```

### Rechercher par tags
Vous avez la possibilité de paramétrer la recherche des entités en fonctions des tags.
Vous pouvez ajouter plusieurs tags qui devront être séparé par une virgule.
Par défauts, si vous avez mis plusieurs tags, il suffit pour l'entité d'avoir un de ces tags pour être affiché. Si vous souhaitez que l'entité possède tout les tags alors il faut mettre le paramètre suivant : `/multiTags/true`

Exemples : 
```html
https://www.communecter.org/api/organization/get?tags=nuitdebout
https://www.communecter.org/api/organization/get?tags=education,social
https://www.communecter.org/api/organization/get?tags=education,social/multiTags/true
```

### Rechercher par Insee
Si vous connaissez le code Insee de votre commune, vous pouvez faire une recherche via ce code.

Exemple :
```html
https://www.communecter.org/api/organization/get?insee=33402
```

## Formats
L'API prend en compte différents formats pour le résultat. Par défaut, c'est le format que propose Communecter.
Nous prenons aussi en comptes les formats suivant : 

* SCHEMA  `/ph/communecter/data/get/type/organizations/format/schema`
* PLP  `/ph/communecter/data/get/type/citoyens/format/plp`
* RSS `/ph/api/news/get/format/rss`
* JSONFEED `/ph/api/news/get/format/jsonfeed`
* KML `/ph/api/event/get/format/kml`
* GEOJSON `/ph/api/person/get/format/geojson`
* CSV `/ph/api/person/get/format/csv`

Attention certains formats ne retourne pas forcement toutes les entités, voici la liste pour chaque format.

COMMUNECTER
* `[citoyens]` Citoyen
* `[organizations]` Organisation
* `[projects]` Projet
* `[events]` Événement
* `[needs]` Besoin
* `[news]` News

SCHEMA
* `[citoyens]` Citoyen
* `[organizations]` Organisation
* `[projects]` Projet
* `[events]` Événement
* `[needs]` Besoin
* City
* `[news]` News

PLP
* `[citoyens]` Citoyen

KML
* `[citoyens]` Citoyen
* `[organizations]` Organisation
* `[projects]` Projet
* `[events]` Événement
* `[needs]` Besoin
* City
* `[news]` News

GEOJSON
* `[citoyens]` Citoyen
* `[organizations]` Organisation
* `[projects]` Projet
* `[events]` Événement
* `[needs]` Besoin
* City
* `[news]` News

CSV
* `[organizations]` Organisation

RSS
* `[news]` news

JSONFEED 
* `[news]` news

## Les attributs
Ici, vous aurez la description de tout les attribues des différentes entités qui sont retournés via l'API.

### Format Communecter
Exemple : 
meta : 
* `limit` Nombre d'entités retournée
* `next` url retournant la suite des entités
* `previous` url retournant la liste précédente des entités

`entities` toutes les entités en leurs identifiants en clé
* `name` Nom de l'entité
* `image` Url de l'image de profil de l'entité
* `urlCommunecter` Url de la fiche de l'entité sur Communecter
* `urlApi` Url qui retourne les informations d'une entité via l'API
* `address`
    * `streetAddress` Numéro et nom de la rue
    * `postalCode` Code postal
    * `addressLocality` Nom de la commune
    * `addressCountry` Nom du Pays
    * `codeInsee` Code Insee de la commune
* `geo` 
    * `latitude`
    * `longitude`
* `geoPosition` Autre format pour la position géographique de l'entité
* `shortDescription` Courte description de l'entité
* `description` Description de l'entité.
* `email` L'email de l'entité.
* `phone` L'ensemble des numéros de téléphones de l'entité ( fixe, mobile et fax)
* `socialNetwork` L'ensemble des liens vers les autres réseaux sociaux de l'entité
* `tags` Tous les tags associés à l'entité
* `links` Les différents liens que l'entité a avec les autres : 
    * `memberOf` Liste des organisations dont l'entité est membre
    * `projects` Liste des projets dont l'entité contribue
    * `events` Liste des événements dont l'entité est invitée ou participe
    * `followers` Liste des citoyens dont l'entité suit.
    * `members` Liste des citoyens membres de l'entité.
    * `needs` Liste des besoins de l'entité.

## Convert : Récupérer des données en onthologie PH
Depuis l'API, vous avez la possibilité de convertir les données sous différents format que vous possédez directement en onthologie PH.

* `[geojson]` GeoJson
* `[wikipedia]` Json issu de l'API de Wikidata
* `[datagouv]` Json issu de l'API de Data.gouv
* `[osm]` Json issu de l'API de Open Street Map
* `[ods]` JSon issu de l'API de OpenDataSoft (on intéroge uniquement la base SIRENE)
* `[datanova]` Json issu de l'API de Datanova 
* `[poleemploi]` Json issu de l'API de Pôle Emploi

* `[educstruct]` Json issu de l'API de ScanR(structures de recherche)
* `[educetab]` Json issu de l'API de ScanR (établissements impliqués dans la recherche)
* `[educmembre]` Json issu de l'API de ScanR (membre des universités de France)
* `[educecole]` Json issu de l'API de ScanR (école doctorales accrédités)

## Obtenir l'ontologie ph pour un type d'élément donnée via une url
`/ph/communecter/api/convert/geojson/type/[organizations || citoyens || events || projects]?url="http://votreurl"` 

Exemple : 
```html
https://www.communecter.org/api/convert/geojson/type/organizations?url=http://umap.openstreetmap.fr/en/datalayer/306808/
```

### Cas particuliers : les uMap

L'API permet de convertir les données geojson d'une uMap donnée via la paramètre "url".

Exemple :
```html
https://www.communecter.org/api/convert/geojson/type/organizations?url=http://umap.openstreetmap.fr/en/datalayer/306808/
```

On peut aussi mettre en paramètre l'URL courte d'une umap (visible en appuyant sur le bouton partager à gauche de la umap): 

Exemple : `/ph/communecter/api/convert/type/organizations?url=http://u.osmfr.org/m/62176/`

Attention pour le moment, il faut que l'url soit en "http" et non pas en "https", retirez le "s" si tel est le cas.

## Obtenir l'ontologie ph pour un type d'élément donnée via un fichier

Il faut envoyer à l'API le paramètre "file" via méthode POST. (en utilisant curl ou RESTED par exemple)

## Obtenir l'ontologie ph pour une url intérrogeant une API externe

`/ph/communecter/api/convert/[type interop]?url="http://votreurlinterop"`

### Exemple Wikidata : 

`/ph/api/convert/wikipedia?url=https://www.wikidata.org/wiki/Special:EntityData/[wikidataID].json`

Pour la ville de Saint-Louis dont le WikidataID est Q47045, l'exemple serait : 

`/ph/api/convert/wikipedia?url=https://www.wikidata.org/wiki/Special:EntityData/Q47045.json`

On va pouvoir récupérer le wikidataID de la ville est ainsi filtrer l'enssemble des éléments qui ont pour propriété P:131 (located in the administrative territorial entity) le wikidataID de la ville.

### Exemple Data.gouv : 

`/ph/api/convert/datagouv?url=https://www.data.gouv.fr/api/1/spatial/zone/fr/town/[insee]/datasets`

Pour la ville de Rodez, dont l'insse est 12202, l'exemple serait : 

`/ph/api/convert/datagouv?url=https://www.data.gouv.fr/api/1/spatial/zone/fr/town/12202/datasets`

On va pouvoir ensuite obtenir l'enssemble des datasets de la ville mentionné et au final parcourir l'enssemble des données des différents jeux de données de la ville.

### Exemple OpenStreetMap : 

`/ph/api/convert/osm?url=http://overpass-api.de/api/interpreter?data=[out:json];node[%22name%22](poly:[geoshape]);out;`

Pour la ville de Saint-Louis, l'exemple serait : 

```SQL
/ph/api/convert/osm?url=http://overpass-api.de/api/interpreter?data=[out:json];node[%22name%22](poly:%22-21.303505996763%2055.403919253998%20-21.292626813288%2055.391189163162%20-21.282029142394%2055.381522536523%20-21.256155186265%2055.392395046639%20-21.232012804782%2055.387888015185%20-21.211100938923%2055.390619722192%20-21.199480966855%2055.382654775478%20-21.185882138486%2055.385961778627%20-21.173346518752%2055.389949958731%20-21.16327583783%2055.399563417107%20-21.14709868917%2055.405379688232%20-21.166028899095%2055.414700890276%20-21.184085220909%2055.432085218794%20-21.190290936422%2055.440880800108%20-21.195166490948%2055.462318490892%20-21.237553168259%2055.459769285867%20-21.258726107298%2055.463692709631%20-21.286021128961%2055.455515913879%20-21.294777773557%2055.419916682666%20-21.303505996763%2055.403919253998%22);out;
```

On va pouvoir filtrer l'enssemble des noeuds qui sont présent dans le geoshape fourni et enfin filtrer tous les noeuds qui possède au moins le tag "name"

### Exemple OpenDataSoft : 

`/ph/api/convert/ods?url=https://data.opendatasoft.com/api/records/1.0/search/?dataset=sirene%40public&sort=datemaj&facet=categorie&facet=proden&facet=libapen&facet=siege&facet=libreg_new&facet=saisonat&facet=libtefen&facet=depet&facet=libnj&facet=libtca&facet=liborigine&rows=30&start=0&geofilter.polygon=[geofilter]`

Pour la ville de Saint-Louis, l'exemple serait : 

`/ph/api/convert/ods?url=https://data.opendatasoft.com/api/records/1.0/search/?dataset=sirene%40public&sort=datemaj&facet=categorie&facet=proden&facet=libapen&facet=siege&facet=libreg_new&facet=saisonat&facet=libtefen&facet=depet&facet=libnj&facet=libtca&facet=liborigine&rows=30&start=0&geofilter.polygon=(-21.303505996763,55.403919253998),(-21.292626813288,55.391189163162),(-21.282029142394,55.381522536523),(-21.256155186265,55.392395046639),(-21.232012804782,55.387888015185),(-21.211100938923,55.390619722192),(-21.199480966855,55.382654775478),(-21.185882138486,55.385961778627),(-21.173346518752,55.389949958731),(-21.16327583783,55.399563417107),(-21.14709868917,55.405379688232),(-21.166028899095,55.414700890276),(-21.184085220909,55.432085218794),(-21.190290936422,55.440880800108),(-21.195166490948,55.462318490892),(-21.237553168259,55.459769285867),(-21.258726107298,55.463692709631),(-21.286021128961,55.455515913879),(-21.294777773557,55.419916682666),(-21.303505996763,55.403919253998)`

On va pouvoir filtrer l'enssemble des éléments présent dans le geofilter fournit. 

On peut filtrer les éléments par thématique en mentionnant des refine.libapen dans l'url.

L'exemple suivant fait la même chose que l'exemple précédent sauf qu'il filtre tous les éléments qui sont dans le secteur d'activité : Pratique dentaire

`/ph/api/convert/ods?url=https://data.opendatasoft.com/api/records/1.0/search/?dataset=sirene%40public&facet=categorie&facet=proden&facet=libapen&facet=siege&facet=libreg_new&facet=saisonat&facet=libtefen&facet=depet&facet=libnj&facet=libtca&facet=liborigine&rows=30&start=0&geofilter.polygon=(44.810795852605,-0.5738778170842),(44.817148298105,-0.57643460444186),(44.823910193873,-0.58695822406613),(44.818476638462,-0.60304723869607),(44.822474304509,-0.61064859861704),(44.824937843733,-0.61415033833008),(44.835177466959,-0.61079419661495),(44.841384923705,-0.62771243191386),(44.860667021743,-0.63833642556746),(44.871658097695,-0.63105127891779),(44.86227970331,-0.61630176568479),(44.854215265872,-0.59460939385687),(44.865671076253,-0.57646019656194),(44.869188961886,-0.57608874140575),(44.909402227434,-0.58088555560083),(44.908480410411,-0.57648917779388),(44.916666965125,-0.54773554113942),(44.889099273803,-0.53553255107571),(44.869138522062,-0.54141014437767),(44.868086689933,-0.53680669655034),(44.861267174723,-0.53784686147751),(44.848134506953,-0.53761462401784),(44.842390488778,-0.5422310311368),(44.836291776079,-0.54665943781219),(44.829021270567,-0.53642317794196),(44.822772234064,-0.53766321563778),(44.813135278103,-0.55606047183132),(44.810795852605,-0.5738778170842)&refine.libapen=Pratique%20dentaire`

### Exemple Datanova : 

`/ph/api/convert/datanova?url=https://datanova.laposte.fr/api/records/1.0/search/?dataset=laposte_poincont&rows=30&start=0&geofilter.polygon=[geofilter]`

Pour la ville de Bordeaux l'exemple serait : 

`/ph/api/convert/datanova?url=https://datanova.laposte.fr/api/records/1.0/search/?dataset=laposte_poincont&rows=30&start=0&geofilter.polygon=(44.810795852605,-0.5738778170842),(44.817148298105,-0.57643460444186),(44.823910193873,-0.58695822406613),(44.818476638462,-0.60304723869607),(44.822474304509,-0.61064859861704),(44.824937843733,-0.61415033833008),(44.835177466959,-0.61079419661495),(44.841384923705,-0.62771243191386),(44.860667021743,-0.63833642556746),(44.871658097695,-0.63105127891779),(44.86227970331,-0.61630176568479),(44.854215265872,-0.59460939385687),(44.865671076253,-0.57646019656194),(44.869188961886,-0.57608874140575),(44.909402227434,-0.58088555560083),(44.908480410411,-0.57648917779388),(44.916666965125,-0.54773554113942),(44.889099273803,-0.53553255107571),(44.869138522062,-0.54141014437767),(44.868086689933,-0.53680669655034),(44.861267174723,-0.53784686147751),(44.848134506953,-0.53761462401784),(44.842390488778,-0.5422310311368),(44.836291776079,-0.54665943781219),(44.829021270567,-0.53642317794196),(44.822772234064,-0.53766321563778),(44.813135278103,-0.55606047183132),(44.810795852605,-0.5738778170842)`

On récupère l'enssemble des enseignes La Poste présent dans le geofilter donné.

### Exemple Pôle Emploi :

L'url à passer en paramètre est du type : 

`/ph/api/convert?url=https://api.emploi-store.fr/partenaire/infotravail/v1/datastore_search_sql?sql=SELECT%20%2A%20FROM%20%22421692f5%2Df342%2D4223%2D9c51%2D72a27dcaf51e%22%20WHERE%20%22CITY_CODE%22=%27[insee]%27%`

Pour la ville de Saint-Louis, l'url serait : 

`/ph/api/convert?url=https://api.emploi-store.fr/partenaire/infotravail/v1/datastore_search_sql?sql=SELECT%20%2A%20FROM%20%22421692f5%2Df342%2D4223%2D9c51%2D72a27dcaf51e%22%20WHERE%20%22CITY_CODE%22=%2797414%27%`

L'essemble du procesus est le suivant : 

* On demande à avoir un token : 

`https://entreprise.pole-emploi.fr/connexion/oauth2/access_token?realm=%2Fpartenaire`

avec en paramètre POST : 

* grant_type = client_credential
* client_id = [identifiant]
* scope = [mot de passe]

Ensuite on lance la requête : 

`https://api.emploi-store.fr/partenaire/infotravail/v1/datastore_search_sql?sql=SELECT%20%2A%20FROM%20%22421692f5%2Df342%2D4223%2D9c51%2D72a27dcaf51e%22%20WHERE%20%22CITY_CODE%22=%27[insee]%27%`

Pour la ville de Saint-Louis : 

`https://api.emploi-store.fr/partenaire/infotravail/v1/datastore_search_sql?sql=SELECT%20%2A%20FROM%20%22421692f5%2Df342%2D4223%2D9c51%2D72a27dcaf51e%22%20WHERE%20%22CITY_CODE%22=%2797414%27%`

Il faut indiquer en paramètre POST ses identifiants du Pôle Emploi (inscription sur https://www.emploi-store-dev.fr/) et aussi mettre un token dans le HEADER : "Authorization: Bearer [token]".

On récupère donc l'enssemble des offres d'emplois filtré par insee.

### Exemple ScanR :  

ScanR comporte 4 jeux de données que l'on peut intéroger : 

* Structure de recherche publique :

`/ph/api/convert/educstruct?url=https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-structures-recherche-publiques-actives&facet=numero_national_de_structure&facet=annee_de_creation&facet=tutelles&facet=type_de_tutelle&facet=nature_de_tutelle&facet=nature_de_structure&facet=type_de_structure&facet=niveau_de_structure&facet=domaine_scientifique&facet=panel_erc&facet=theme_de_recherche&facet=commune&facet=unite_urbaine&facet=departement&facet=region&facet=pays&facet=comue&facet=region_avant_2016&rows=30&start=0&geofilter.polygon=[geofilter]`

Pour la ville de Saint-Louis,l'exemple serait : 

`/ph/api/convert/educstruct?url=https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-structures-recherche-publiques-actives&facet=numero_national_de_structure&facet=annee_de_creation&facet=tutelles&facet=type_de_tutelle&facet=nature_de_tutelle&facet=nature_de_structure&facet=type_de_structure&facet=niveau_de_structure&facet=domaine_scientifique&facet=panel_erc&facet=theme_de_recherche&facet=commune&facet=unite_urbaine&facet=departement&facet=region&facet=pays&facet=comue&facet=region_avant_2016&rows=30&start=0&geofilter.polygon=(44.810795852605,-0.5738778170842),(44.817148298105,-0.57643460444186),(44.823910193873,-0.58695822406613),(44.818476638462,-0.60304723869607),(44.822474304509,-0.61064859861704),(44.824937843733,-0.61415033833008),(44.835177466959,-0.61079419661495),(44.841384923705,-0.62771243191386),(44.860667021743,-0.63833642556746),(44.871658097695,-0.63105127891779),(44.86227970331,-0.61630176568479),(44.854215265872,-0.59460939385687),(44.865671076253,-0.57646019656194),(44.869188961886,-0.57608874140575),(44.909402227434,-0.58088555560083),(44.908480410411,-0.57648917779388),(44.916666965125,-0.54773554113942),(44.889099273803,-0.53553255107571),(44.869138522062,-0.54141014437767),(44.868086689933,-0.53680669655034),(44.861267174723,-0.53784686147751),(44.848134506953,-0.53761462401784),(44.842390488778,-0.5422310311368),(44.836291776079,-0.54665943781219),(44.829021270567,-0.53642317794196),(44.822772234064,-0.53766321563778),(44.813135278103,-0.55606047183132),(44.810795852605,-0.5738778170842)`

*  Etablissement impliqués dans la recherche : 

`/ph/api/convert/educetab?url=https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-etablissements-publics-prives-impliques-recherche-developpement&facet=siren&facet=libelle&facet=date_de_creation&facet=categorie&facet=libelle_ape&facet=tranche_etp&facet=categorie_juridique&facet=wikidata&facet=commune&facet=unite_urbaine&facet=departement&facet=region&facet=pays&facet=badge&facet=region_avant_2016&rows=30&start=0&geofilter.polygon=[geofilter]`

Pour la ville de Bordeaux, l'exemple serait : 

`/ph/api/convert/educetab?url=https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-etablissements-publics-prives-impliques-recherche-developpement&facet=siren&facet=libelle&facet=date_de_creation&facet=categorie&facet=libelle_ape&facet=tranche_etp&facet=categorie_juridique&facet=wikidata&facet=commune&facet=unite_urbaine&facet=departement&facet=region&facet=pays&facet=badge&facet=region_avant_2016&rows=30&start=0&geofilter.polygon=(44.810795852605,-0.5738778170842),(44.817148298105,-0.57643460444186),(44.823910193873,-0.58695822406613),(44.818476638462,-0.60304723869607),(44.822474304509,-0.61064859861704),(44.824937843733,-0.61415033833008),(44.835177466959,-0.61079419661495),(44.841384923705,-0.62771243191386),(44.860667021743,-0.63833642556746),(44.871658097695,-0.63105127891779),(44.86227970331,-0.61630176568479),(44.854215265872,-0.59460939385687),(44.865671076253,-0.57646019656194),(44.869188961886,-0.57608874140575),(44.909402227434,-0.58088555560083),(44.908480410411,-0.57648917779388),(44.916666965125,-0.54773554113942),(44.889099273803,-0.53553255107571),(44.869138522062,-0.54141014437767),(44.868086689933,-0.53680669655034),(44.861267174723,-0.53784686147751),(44.848134506953,-0.53761462401784),(44.842390488778,-0.5422310311368),(44.836291776079,-0.54665943781219),(44.829021270567,-0.53642317794196),(44.822772234064,-0.53766321563778),(44.813135278103,-0.55606047183132),(44.810795852605,-0.5738778170842)`

* Membres des universités de France : 

`/ph/api/convert/educmembre?url=https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-iuf-les-membres&rows=30&start=0&geofilter.polygon=[geofilter]`

Pour la ville de Bordeaux, l'exemple serait : 

`/ph/api/convert/educmembre?url=https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-iuf-les-membres&rows=30&start=0&geofilter.polygon=(44.810795852605,-0.5738778170842),(44.817148298105,-0.57643460444186),(44.823910193873,-0.58695822406613),(44.818476638462,-0.60304723869607),(44.822474304509,-0.61064859861704),(44.824937843733,-0.61415033833008),(44.835177466959,-0.61079419661495),(44.841384923705,-0.62771243191386),(44.860667021743,-0.63833642556746),(44.871658097695,-0.63105127891779),(44.86227970331,-0.61630176568479),(44.854215265872,-0.59460939385687),(44.865671076253,-0.57646019656194),(44.869188961886,-0.57608874140575),(44.909402227434,-0.58088555560083),(44.908480410411,-0.57648917779388),(44.916666965125,-0.54773554113942),(44.889099273803,-0.53553255107571),(44.869138522062,-0.54141014437767),(44.868086689933,-0.53680669655034),(44.861267174723,-0.53784686147751),(44.848134506953,-0.53761462401784),(44.842390488778,-0.5422310311368),(44.836291776079,-0.54665943781219),(44.829021270567,-0.53642317794196),(44.822772234064,-0.53766321563778),(44.813135278103,-0.55606047183132),(44.810795852605,-0.5738778170842)`

* Liste des écoles doctorales accréditées

`/ph/api/convert/educecole?url=https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-ecoles_doctorales_annuaire&facet=numero&facet=groupe_disciplinaire&facet=toutes_les_disciplines&facet=discipline_principale&facet=localisation&facet=liste_tous_etablissements&facet=laboratoires_rattaches&facet=annee_de_creation&facet=annee_accreditation&facet=etablissement_support&facet=liste_codes_tous_etablissements&facet=identifiants_des_laboratoires&facet=libelle_unite_urbaine&facet=libelle_departement&facet=libelle_academie&facet=libelle_region&rows=30&start=0&geofilter.polygon=[geofilter]`

Pour la ville de Bordeaux, l'exemple serait : 

`/ph/api/convert/educecole?url=https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-ecoles_doctorales_annuaire&facet=numero&facet=groupe_disciplinaire&facet=toutes_les_disciplines&facet=discipline_principale&facet=localisation&facet=liste_tous_etablissements&facet=laboratoires_rattaches&facet=annee_de_creation&facet=annee_accreditation&facet=etablissement_support&facet=liste_codes_tous_etablissements&facet=identifiants_des_laboratoires&facet=libelle_unite_urbaine&facet=libelle_departement&facet=libelle_academie&facet=libelle_region&rows=30&start=0&geofilter.polygon=(44.810795852605,-0.5738778170842),(44.817148298105,-0.57643460444186),(44.823910193873,-0.58695822406613),(44.818476638462,-0.60304723869607),(44.822474304509,-0.61064859861704),(44.824937843733,-0.61415033833008),(44.835177466959,-0.61079419661495),(44.841384923705,-0.62771243191386),(44.860667021743,-0.63833642556746),(44.871658097695,-0.63105127891779),(44.86227970331,-0.61630176568479),(44.854215265872,-0.59460939385687),(44.865671076253,-0.57646019656194),(44.869188961886,-0.57608874140575),(44.909402227434,-0.58088555560083),(44.908480410411,-0.57648917779388),(44.916666965125,-0.54773554113942),(44.889099273803,-0.53553255107571),(44.869138522062,-0.54141014437767),(44.868086689933,-0.53680669655034),(44.861267174723,-0.53784686147751),(44.848134506953,-0.53761462401784),(44.842390488778,-0.5422310311368),(44.836291776079,-0.54665943781219),(44.829021270567,-0.53642317794196),(44.822772234064,-0.53766321563778),(44.813135278103,-0.55606047183132),(44.810795852605,-0.5738778170842)`

#REST Services 
* Almost every actions could be exposed as a REST service.

#Documentation about REST Services
## Register a new user
* url : xxxxx.communecter.org/communecter/person/register
* params dans le post :
    * `name` string
    * `username` string. Unique on the plateforme
    * `email` well formated email
    * `cp` existing postalCode
    * `geoPosLatitude` float
    * `geoPosLongitude` float
    * `pwd :` non encrypted password
    * `city` String Insee code
    * `pendingUserId` String. Si l'utilisateur est déjà en base de données (il a été invité et son profil est temporaire), son identifiant est passé en paramètre. Dans ce cas l'utilisateur n'est pas créé, mais il est mis à jour.

* Retour (json) : 
    * `result` boolean
    * `msg` String : message d'erreur
    * `id` identifiant de l'utilisateur nouvellement créé.

* Fonctionnement :
    * L'utilisateur est créé en base de données.
    * Il n'est pas encore validé et ne pourra pas se logguer
    * Un mail lui est envoyé avec un lien de validation pour activer son compte
    * En version bêta, il y a un flag `betaTester` qui est positionné pour filtrer les utilisateurs bêta testeur. Par défaut, il est à `false`.

Le code utilisé est ici : [citizenToolKit/controllers/person/RegisterAction.php](citizenToolKit/controllers/person/RegisterAction.php) (lien mort)
