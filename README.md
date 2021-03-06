# CODI integrace
[![PHP from Packagist](https://img.shields.io/packagist/php-v/ispalliance/codi-integration.svg?style=flat-square)](https://packagist.org/packages/ispalliance/codi-integration)
[![Build Status](https://img.shields.io/travis/ispalliance/codi-integration.svg?style=flat-square)](https://travis-ci.org/ispalliance/codi-integration)
[![Code coverage](https://img.shields.io/coveralls/ispalliance/codi-integration.svg?style=flat-square)](https://coveralls.io/r/ispalliance/codi-integration)
[![Licence](https://img.shields.io/packagist/l/ispalliance/codi-integration.svg?style=flat-square)](https://packagist.org/packages/ispalliance/codi-integration)
[![Downloads this Month](https://img.shields.io/packagist/dm/ispalliance/codi-integration.svg?style=flat-square)](https://packagist.org/packages/ispalliance/codi-integration)
[![Downloads total](https://img.shields.io/packagist/dt/ispalliance/codi-integration.svg?style=flat-square)](https://packagist.org/packages/ispalliance/codi-integration)
[![Latest stable](https://img.shields.io/packagist/v/ispalliance/codi-integration.svg?style=flat-square)](https://packagist.org/packages/ispalliance/codi-integration)

Základní entity, dokumentace, popis API a příklady k integraci platformy CODI do vašich systémů.

## Instalace
```
composer require ispalliance/codi-integration
```

## Volání

Z CODI se volá server subjektu metodou GET s HTTP Basic authentication.
Server/servery subjektu by měli mít endpointy pro internet a volitelně pro open access.
V adrese volaného serveru je umístěn RUIAN CODE, pro který zjišťujeme dostupnost internetu / open accessu.

Příklad volání pro open access a internet, kde 9268979 je RUIAN CODE

```
https://domain.tld/open-access.php?ruian=9268979
```

```
https://domain.tld/internet.php?ruian=9268979
```

## Odpověď
Odpověď je očekávána jako json, který obsahuje status a data. Data obsahují pole entit, nalezených dle ruianu. Použité kódování je UTF-8.
```json
{
  "status":"success",
  "data":[
    ...
  ]
}
```

Každá entita by měla reprezentovat unikátní technologii, která se na adrese nachází.
V případě, že bude v odpovědi zasláno více entit se shodnou technologií, uloží se v CODI pouze ta  první a ostatní budou zahozeny.
Pokud není žádná technologie v objektu dostupná, je očekáváno prázné pole.
V případě, že není objekt dle RUIAN CODE nalezen, je očekávána odpověď se statusem 404.
V případě, že vše proběhlo v pořádku je očekávána odpověď se statusem 200 a status v jsonu success, viz. příklady.

V případě php je možné použít entity, které lze poté pomocí json_encode
převést na json. V ostatních případech je vyžadován níže popsaný tvar jsonu.

### Internet
Pro php lze využít CodiInternetResponseEntity

#### Ukázka implementace
Základní implementaci včetně HTTP Basic auth bez logiky získávání dat pro PHP naleznete v příkladech v souboru [Internet.php](examples/Internet.php)

#### Položky entity:

```
objekt CodiInternetResponseEntity:
technology - string *
speedUp    - objekt FromToEntity *
speedDown  - objekt FromToEntity *
price      - objekt FromToEntity *
additional - pole stringu *
webLink    - string
orderLink  - string
promoText  - string, maximální dílka 100 znaků, delší text bude zkrácen.
```
```
objekt FromToEntity:
    from - int
    to   - int
```
\* povinné položky

#### Příklad json entity:
```json
{
  "technology":"fwa_licensed",
  "speedUp":{
    "from":10,
    "to":20
  },
  "speedDown":{
    "from":20,
    "to":40
  },
  "price":{
    "from":189,
    "to":799
  },
  "additional":["TV","VOIP"],
  "webLink":"http://www.ispalliance.cz",
  "orderLink":"http://ispalliance.cz/order",
  "promoText":"Akční nabídka."
}
```

#### Příklad odpovědi bez technologie:
```json
{
  "status":"success",
  "data":[]
}
```

#### Příklad minimální odpovědi, která vrací jen technologii:
```json
{
 "status":"success",
 "data":[
   {
     "technology":"fwa_licensed",
     "speedUp":{
       "from":null,
       "to":null
     },
     "speedDown":{
       "from":null,
       "to":null
     },
     "price":{
       "from":null,
       "to":null
     },
     "additional":[],
     "webLink":null,
     "promoText":null
   }
 ]
}
```

#### Příklad kompletní odpovědi, která vrací 2 technologie:
```json
{
 "status":"success",
 "data":[
   {
     "technology":"fwa_licensed",
     "speedUp":{
       "from":10,
       "to":20
     },
     "speedDown":{
       "from":20,
       "to":40
     },
     "price":{
       "from":189,
       "to":799
     },
     "additional":["TV","VOIP"],
     "webLink":"http://www.ispalliance.cz",
     "orderLink":"http://ispalliance.cz/order",
     "promoText":"Máme nejlepší poměr cena výkon na trhu. Nyní navíc akční nabídku půl roku za polovic."
   },
   {
     "technology":"xdsl",
     "speedUp":{
       "from":10,
       "to":30
     },
     "speedDown":{
       "from":20,
       "to":60
     },
     "price":{
       "from":399,
       "to":1999
     },
     "additional":[],
     "webLink":"http://www.ispalliance.cz",
     "orderLink":"http://ispalliance.cz/order",
     "promoText":"Máme nejlepší poměr cena výkon na trhu. Nyní navíc akční nabídku půl roku za polovic."
   }
 ]
}
```

### OpenAccess

Pro php lze využít CodiOpenAccessResponseEntity

#### Ukázka implementace
Základní implementaci včetně HTTP Basic auth bez logiky získávání dat pro PHP naleznete v příkladech v souboru [OpenAccess.php](examples/OpenAccess.php)

#### Položky entity:
```
technology - string *
note - string
priceLevel - string
speedDown - int
speedUp - int
```
\* povinné položky

#### Příklad json entity:
```json
{
  "technology":"fwa_licensed",
  "note":"Poznámka",
  "priceLevel": "level_a",
  "speedDown": 4096,
  "speedUp": 512
}
```

#### Příklad odpovědi bez technologie:
```json
{
  "status":"success",
  "data":[]
}
```

#### Příklad minimální odpovědi, která vrací jen technologii:
```json
{
 "status":"success",
 "data":[
   {
     "technology":"fwa_licensed",
     "note":null,
     "priceLevel":null,
     "speedDown":null,
     "speedUp":null
   }
 ]
}
```

#### Příklad kompletní odpovědi, která vrací 2 technologie:
```json
{
 "status":"success",
 "data":[
   {
     "technology":"xdsl",
     "note":"note",
     "priceLevel":null,
     "speedDown":null,
     "speedUp":null
   },
   {
     "technology":"fwa_licensed",
     "note":"Lorem ipsum, bla bla bla.",
     "priceLevel": "level_a",
     "speedDown": 4096,
     "speedUp": 512
   }
 ]
}
```
