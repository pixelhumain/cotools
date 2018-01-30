_Traduction anglaise: [Interoperability](https://github.com/pixelhumain/wiki-en/wiki/Interoperability)_

# Introduction
> À fusionner avec [[COSM]] et [[Copédia]].

## Vue d'ensemble du chantier sur l’interopérabilité
![Schéma explicatif de l’interopérabilité de Communecter avec diverses sources](https://cloud.communecter.org/index.php/apps/files_sharing/ajax/publicpreview.php?x=1880&y=604&a=true&file=interop_schema.png&t=jpxxWQJlRTduxRI&scalingup=0)

À gauche, la liste des sources extérieurs sur lesquelles on récupère les données :
* Wikidata
* Wikipédia 
* OpenStreetMap
* OpenDataSoft (la base SIRENE)
* Data.gouv
* Datanova (les enseignes La Poste)
* Pôle Emploi
* SCANR

Au milieu, le processus de Conversion des données (détails sur le prochain schéma)

A droite, l'affichage des données converties sur le site de Communecter ainsi que des exemple d'usage de ces données par des sites extérieurs.

## Conversion des données sémantiques
![Détail dela convertion Sémantique](https://cloud.communecter.org/index.php/apps/files_sharing/ajax/publicpreview.php?x=1880&y=604&a=true&file=conversion_semantique.png&t=PQ6toLyCcXyBHiA&scalingup=0)


# We interoperate with 

## using their API 

### Wikidata 

For any city, We retreive main information available on Wikidata

The process is the following : 

   * We choose a geographic scope (a country) to filter
   * We call our own semantic convert system (**[doc avaible here](https://github.com/pixelhumain/wiki/wiki/Doc-de-l'API#convert--r%C3%A9cup%C3%A9rer-des-donn%C3%A9es-en-onthologie-ph)**) : 

The convert system will interrogate the Wikidata API to get data in JSON. 

The next exemple is the data for the city of Saint-Denis, capital city of Réunion island : 

`https://query.wikidata.org/sparql?format=json&query=SELECT%20DISTINCT%20%3Fitem%20%3FitemLabel%20%3FitemDescription%20%3Fcoor%20%3Frange%20WHERE%20{%0A%20%3Fitem%20wdt%3AP131%20wd%3AQ47045.%0A%20%3Fitem%20%3Frange%20wd%3AQ47045.%0A%20%3Fitem%20wdt%3AP625%20%3Fcoor.%0A%20SERVICE%20wikibase%3Alabel%20{%20bd%3AserviceParam%20wikibase%3Alanguage%20%22fr%22.%20}%0A}`

And convert this data in the pivot language named "PH onthology" 

`/ph/api/convert/wikipedia?url=https://www.wikidata.org/wiki/Special:EntityData/Q47045.json`

**[Exemple Wikidata here](https://github.com/pixelhumain/wiki/wiki/Doc-de-l'API#exemple-wikidata-)**

Here are the mapping 

| Source's data          | PH onthology     |
|------------------------|------------------|
| itemLabel.value        | name             |
| coor.latitude          | geo.latitude     |
| coor.longitude         | geo.longitude    |
| item.value             | url              |
|itemDescription.value   | description      |

* We'll want to contributing back any extra data we can offer with **[COpédia](https://github.com/pixelhumain/wiki/wiki/Cop%C3%A9dia)** (coming soon) 

### DBpedia
* For any city, We retreive main information available on Wikipedia 

### OpenStreetMap

For any city, we retreive main information avaible on OSM

The process is the following : 
   * We choose a geographic scope (a country) to filter
   * We call our own semantic convert system (**[doc avaible here](https://github.com/pixelhumain/wiki/wiki/Doc-de-l'API#convert--r%C3%A9cup%C3%A9rer-des-donn%C3%A9es-en-onthologie-ph)**) : 

The next exemple is all the OSM data of the city of Saint-Louis : 

`http://overpass-api.de/api/interpreter?data=[out:json];node[%22name%22](poly:%22-21.303505996763%2055.403919253998%20-21.292626813288%2055.391189163162%20-21.282029142394%2055.381522536523%20-21.256155186265%2055.392395046639%20-21.232012804782%2055.387888015185%20-21.211100938923%2055.390619722192%20-21.199480966855%2055.382654775478%20-21.185882138486%2055.385961778627%20-21.173346518752%2055.389949958731%20-21.16327583783%2055.399563417107%20-21.14709868917%2055.405379688232%20-21.166028899095%2055.414700890276%20-21.184085220909%2055.432085218794%20-21.190290936422%2055.440880800108%20-21.195166490948%2055.462318490892%20-21.237553168259%2055.459769285867%20-21.258726107298%2055.463692709631%20-21.286021128961%2055.455515913879%20-21.294777773557%2055.419916682666%20-21.303505996763%2055.403919253998%22);out%2030;`

Here are the mapping

| Source's data          | PH onthology     |
|------------------------|------------------|
| tags.name              | name             |
| lat                    | geo.latitude     |
| long                   | geo.longitude    |
| type                   | type             |
| tags.amenity           | tags.0           |

**[Exemple OSM here](https://github.com/pixelhumain/wiki/wiki/Doc-de-l'API#exemple-openstreetmap-)**

* We'll want to contributin back any extra data we can offer with **[COSM](https://github.com/pixelhumain/wiki/wiki/COSM)** (coming soon)

### Data.gouv
For any city, we retreive main information of the organizations placed in this city

The process is the following : 

   * We choose a geographic scope (a country) to filter
   * We call our own semantic convert system (**[doc avaible here](https://github.com/pixelhumain/wiki/wiki/Doc-de-l'API#convert--r%C3%A9cup%C3%A9rer-des-donn%C3%A9es-en-onthologie-ph)**) : 

The module will find all the organizations placed in the geographic scope filter and then extract all the data in the differents datasets available. 

The next exemple is all the data of the different structure of Méto-France, meteorological center of France.

`https://www.data.gouv.fr/api/1/datasets/54a12162c751df720a04805a/`

Here are the mapping 

| Source's data          | PH onthology     |
|------------------------|------------------|
| slug                   | name             |
| page                   | url              |
| tags[]                 | tag[]            |
| item.value             | url              |
| owner                  | creator          |

**[Exemple Data.gouv here](https://github.com/pixelhumain/wiki/wiki/Doc-de-l'API#exemple-datagouv-)**

### Pôle emploi 
For any city, we retreive all the job offer. (no exact localisation of the job place)

The process is the following : 

   * We choose a geographic scope (a country) to filter
   * We call our own semantic convert system (**[doc avaible here](https://github.com/pixelhumain/wiki/wiki/Doc-de-l'API#convert--r%C3%A9cup%C3%A9rer-des-donn%C3%A9es-en-onthologie-ph)**) : 

To get data with the Pôle emploi's API, a token is needed. 

The next exemple fetch all the job offer of the city of Saint-Louis.

`https://api.emploi-store.fr/partenaire/infotravail/v1/datastore_search_sql?sql=SELECT%20%2A%20FROM%20%22421692f5-f342-4223-9c51-72a27dcaf51e%22%20WHERE%20%22CITY_CODE%22=%2797414%27%20LIMIT%2030`

### OpenDataSoft (SIREN database)

For any city, we retreive all the organizations and the association of the SIREN's database.

The process is the following : 

   * We choose a geographic scope (a country) to filter
   * We call our own semantic convert system (**[doc avaible here](https://github.com/pixelhumain/wiki/wiki/Doc-de-l'API#convert--r%C3%A9cup%C3%A9rer-des-donn%C3%A9es-en-onthologie-ph)**) : 

The next exemple will fetch all the data in the SIRENE database for the city of Saint-Louis.

`https://data.opendatasoft.com/api/records/1.0/search/?dataset=sirene%40public&facet=categorie&facet=proden&facet=libapen&facet=siege&facet=libreg_new&facet=saisonat&facet=libtefen&facet=depet&facet=libnj&facet=libtca&facet=liborigine&rows=30&start=0&geofilter.polygon=(-21.303505996763,55.403919253998),(-21.292626813288,55.391189163162),(-21.282029142394,55.381522536523),(-21.256155186265,55.392395046639),(-21.232012804782,55.387888015185),(-21.211100938923,55.390619722192),(-21.199480966855,55.382654775478),(-21.185882138486,55.385961778627),(-21.173346518752,55.389949958731),(-21.16327583783,55.399563417107),(-21.14709868917,55.405379688232),(-21.166028899095,55.414700890276),(-21.184085220909,55.432085218794),(-21.190290936422,55.440880800108),(-21.195166490948,55.462318490892),(-21.237553168259,55.459769285867),(-21.258726107298,55.463692709631),(-21.286021128961,55.455515913879),(-21.294777773557,55.419916682666),(-21.303505996763,55.403919253998)`

Here are the mapping 

| Source's data          | PH onthology     |
|------------------------|------------------|
| fields.l1_declaree     | name             |
| fields.categorie       | type             |
| fields.siret           | shortDescription |
| fields.coordonnees.0   | geo.latitude     |
| fields.coordonnees.1   | geo.longitude    |
| fields.libapen         | tags.0           |

**[Exemple OpenDataSoft here](https://github.com/pixelhumain/wiki/wiki/Doc-de-l'API#exemple-opendatasoft-)**

### ScanR ( National Education ) 

For any city, we retreive main information from the national education of France

The process is the following : 

   * We choose a geographic scope (a country) to filter
   * We call our own semantic convert system (**[doc avaible here](https://github.com/pixelhumain/wiki/wiki/Doc-de-l'API#convert--r%C3%A9cup%C3%A9rer-des-donn%C3%A9es-en-onthologie-ph)**) : 

The next exemple fetch all the actives research strutures of the city of Bordeaux : 

`https://data.enseignementsup-recherche.gouv.fr/api/records/1.0/search/?dataset=fr-esr-etablissements-publics-prives-impliques-recherche-developpement&facet=siren&facet=libelle&facet=date_de_creation&facet=categorie&facet=libelle_ape&facet=tranche_etp&facet=categorie_juridique&facet=wikidata&facet=commune&facet=unite_urbaine&facet=departement&facet=region&facet=pays&facet=badge&facet=region_avant_2016&rows=30&start=0&geofilter.polygon=(44.810795852605,-0.5738778170842),(44.817148298105,-0.57643460444186),(44.823910193873,-0.58695822406613),(44.818476638462,-0.60304723869607),(44.822474304509,-0.61064859861704),(44.824937843733,-0.61415033833008),(44.835177466959,-0.61079419661495),(44.841384923705,-0.62771243191386),(44.860667021743,-0.63833642556746),(44.871658097695,-0.63105127891779),(44.86227970331,-0.61630176568479),(44.854215265872,-0.59460939385687),(44.865671076253,-0.57646019656194),(44.869188961886,-0.57608874140575),(44.909402227434,-0.58088555560083),(44.908480410411,-0.57648917779388),(44.916666965125,-0.54773554113942),(44.889099273803,-0.53553255107571),(44.869138522062,-0.54141014437767),(44.868086689933,-0.53680669655034),(44.861267174723,-0.53784686147751),(44.848134506953,-0.53761462401784),(44.842390488778,-0.5422310311368),(44.836291776079,-0.54665943781219),(44.829021270567,-0.53642317794196),(44.822772234064,-0.53766321563778),(44.813135278103,-0.55606047183132),(44.810795852605,-0.5738778170842)`

Here are the mapping : 

| Source's data              | PH onthology     |
|----------------------------|------------------|
| fields.libelle             | name             |
| fields.site_web            | shortDescription |
| fields.geolocalisation.0   | geo.latitude     |
| fields.geolocalisation.1   | geo.longitude    |

**[Exemple ScanR here](https://github.com/pixelhumain/wiki/wiki/Doc-de-l'API#exemple-scanr-)**

* Datasets used : 
    * Public or private research and development structures
    * Member of the university institute of France

### Datanova ( La Poste ) 

For any city, we retreive the location of all buildings of La Poste

The process is the following : 

   * We choose a geographic scope (a country) to filter
   * We call our own semantic convert system (**[doc avaible here](https://github.com/pixelhumain/wiki/wiki/Doc-de-l'API#convert--r%C3%A9cup%C3%A9rer-des-donn%C3%A9es-en-onthologie-ph)**) : 

The next exemple will fetch all La Poste buildings localised in the city of Saint-Louis.

`https://datanova.laposte.fr/api/records/1.0/search/?dataset=laposte_poincont&rows=30&start=0&geofilter.polygon=(-21.303505996763,55.403919253998),(-21.292626813288,55.391189163162),(-21.282029142394,55.381522536523),(-21.256155186265,55.392395046639),(-21.232012804782,55.387888015185),(-21.211100938923,55.390619722192),(-21.199480966855,55.382654775478),(-21.185882138486,55.385961778627),(-21.173346518752,55.389949958731),(-21.16327583783,55.399563417107),(-21.14709868917,55.405379688232),(-21.166028899095,55.414700890276),(-21.184085220909,55.432085218794),(-21.190290936422,55.440880800108),(-21.195166490948,55.462318490892),(-21.237553168259,55.459769285867),(-21.258726107298,55.463692709631),(-21.286021128961,55.455515913879),(-21.294777773557,55.419916682666),(-21.303505996763,55.403919253998)`

Here are the mapping 

| Source's data          | PH onthology          |
|------------------------|-----------------------|
| fields.libelle_du_site | name                  |
| recordid               | type                  |
| fields.adresse         | address.streetAddress |
| fields.latlong.0       | geo.latitude          |
| fields.latlong.1       | geo.longitude         |
| fields.libapen         | tags.0                |

**[Exemple Datanova here](https://github.com/pixelhumain/wiki/wiki/Doc-de-l'API#exemple-datanova-)**

## Smart Citizen (coming soon)
* onclick : we'll show all SCK kits for a given city

## Umaps (coming soon)
* POI's of type geoJson, on click we show the content on our map  

## WordPress RSS (coming soon)
* any WP blog's RSS can be pluggued to an elements wall 

## using an iframe

## FramaPads
* users can use Framapads from inside CO(simple Iframe)
