# DOCUMENTATION

STRIPEUSE LAPIN.ORG API

## Installation

- Install [databaseLapin.sql](https://github.com/noworldausaure/API_Lapin/blob/master/api/dump/databaseLapin.sql)

- Use [Composer](https://getcomposer.org/)
```json
{
    "require": {
        "slim/slim-skeleton": "^3.1",
        "slim/pdo": "~1.9"
    }
}
```

- Configure [config-db.php.sample](https://github.com/noworldausaure/API_Lapin/blob/master/api/sql/config-db.php.sample)

-Give to /lib/script/dumpSqlDomain www-data write access

**NOTES**
 - The norme md5 is use for password he has to be generate by the client.
 - All base64file value are image encode on base64 by the client.
 - Default admin are 'root','root'
 - The domainDump are a exemple and lapin contain basic exemple data to use it 
---


**TITLE**: Get general info

**URL** : /infoGeneral

**METHOD**:GET

**URL PARAMS**: None

**SUCCESS REPONSE** : 200


---

**TITLE**: Get info from specific domain

**URL** : /info/:domain

**METHOD**:GET

**URL PARAMS**: Required = [domain]

**SUCCESS REPONSE** : 200

**ERROR REPONSE** : 404

---


**TITLE**: Get strips from specific domain given a certain range (defaults to 9 strips since the last one)

**URL** : /strips/:domain/:id/:number/:offset

**METHOD**:GET

**URL PARAMS**: Required = [domain] & Optional = [id] & Optional = [number] & Optional = [offset]

**SUCCESS REPONSE** : 200

**ERROR REPONSE** : 404

**Note** : return one strips if id is set

---

**TITLE**: Get strips from specific domain since a given date (defaults to 24H)

**URL** : /strips/:since/:domain/:date

**METHOD**:GET

**URL PARAMS**: Required = [domain] & Optional = [date]. Date is `Y-m-d H:i:s` formatted

**SUCCESS REPONSE** : 200

**ERROR REPONSE** : 404

**Note** : return one strips if id is set

---

**TITLE**: Get a strip's image

**URL** : /strips/image/:domain/:id

**METHOD**:GET

**URL PARAMS**: Required = [domain] & Required = [id]

**SUCCESS REPONSE** : 200

**ERROR REPONSE** : 404

**Note** : return one base64 content of an image

---

**TITLE**: Get stories from specific domain

**URL** : /stories/:domain/:id/:number/:offset


**METHOD**:GET

**URL PARAMS**: Required = [domain] & Optional = [id] & Optional = [number] & Optional = [offset]


**SUCCESS REPONSE** : 200

**ERROR REPONSE** : 404

**Note** : return one stories if id is set

---

**TITLE**: Get strips from specific storie

**URL** : /strips/stories/:domain/:id

**METHOD**:GET

**URL PARAMS**: Required = [domain] & [id]

**SUCCESS REPONSE** : 200

**ERROR REPONSE** : 404

**Note** : return one stories if id is set

---


**TITLE**: Get pub from specific domain

**URL** : /pub/domain/:domain/:id

**METHOD**:GET

**URL PARAMS**: Required = [domain] & Optional = [id]

**SUCCESS REPONSE** : 200

**ERROR REPONSE** : 404

**Note** : return one pub if id is set

---

**TITLE**: Get pub from lapin

**URL** : /pub/general/:domain/:id

**METHOD**:GET

**URL PARAMS**: Required = [domain] & Optional = [id]

**SUCCESS REPONSE** : 200

**ERROR REPONSE** : 404

**Note** : return one pub if id is set

---

**TITLE**: Create new domain (need admin right)

**URL** : /newDomain

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "short_name":"gluby",
    "large_name":"gluby on ice",
    "author":"Alexande droposki",
    "favicon":"base64file"
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : SAdmin Login


**Note** :
- Create domain database with info strips and stories table on it
- add automatically info on  lapin.info
- add automatically info on the domain.info create
- don't work if the short_name is the same one other domain

---

**TITLE**: login admin

**URL** : /user/login

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "login":"admin",
    "pwd":"password"
}
```

**SUCCESS REPONSE** : 200


---

**TITLE**: login admin on specific  domain

**URL** : /:domain/admin

**METHOD**:POST

**URL PARAMS**: Required = [domain]

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "pwd":"password"
}
```

**SUCCESS REPONSE** : 200


---

**TITLE**: add new strips on specific domain

**URL** : /strips/newStrip

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "title":"an awesomestrips",
    "file":"base64file",
    "date":"2015-05-19 19:05:15",
    "story_id":1
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : Admin Login

---

**TITLE**: add new stories on specific domain

**URL** : /stories/newStories

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "title":"myawesomestories"
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : Admin Login

---


**TITLE**: add pub

**URL** : /pub/addPub/

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
	"domain":"gluby",
    "name":"namepub",
	"file":"base64file",
	"link":"oK"

}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : Admin Login

**NOTE**: - Domain is optional if you don't set it i will add the pub on the lapin table.

---

**TITLE**: update info

**URL** : /update/info

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "short_name":"glubyraptor",
    "large_name":"Gluby saint raptor",
    "author":"Alexando del raptor",
    "favicon":"base64file",
    "description":"the beautiful raptor making strips for you",
    "profil_picture":"base64file",
    "ban_picture":"base64file",
    "first_pub":"base64file",
    "first_pub_name":"raptor.pub.jpg"
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : Admin Login

**Note** :
- automatically change info from lapin.info and domain.info
- if the new short_name is different than the domain name the request while update the info, create dump of the database, create a new database with the new short_name and destroy the old database;

---

**TITLE**: update strips

**URL** : /update/strips

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "title":"this strips",
    "file":"base64file",
    "date":"2015-05-19 19:05:15",
    "story_id":1,
    "id":2
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : Admin Login

---

**TITLE**: update strips

**URL** : /update/stories

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "title":"this stories",
    "id":2
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : Admin Login

---


**TITLE**: update pub

**URL** : /update/pub

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
	"id":1,
    "name":"Pub1",
	"file":"file1",
	"link":"oKkk"
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : Admin Login

**NOTE** : - domain is optional if no domain is set will update on the lapin

---

**TITLE**: drop database domain

**URL** : /delete/domain

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby"
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : Admin Login

---

**TITLE**: delete stories

**URL** : /delete/stories

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "id":1
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : Admin Login

**Note**:
- you can add the 'withStrip' params(Bool) who with delete all strips affiliate at the id send

---

**TITLE**: delete strips

**URL** : /delete/strips

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "id":1
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : Admin Login

**Note**:
- you can add the 'all' params(Bool) who with truncate the table strips of the domain specify

----

**TITLE**: delete pub

**URL** : /delete/pub

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "id":1
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : Admin Login

**Note**:
- domain is optional if is not set will delete pub from lapin

----

**TITLE**: get list of admin

**URL** : /admin/getAdmin

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "login":"admin",
    "pwd":"password"
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : SAdmin Login

---

**TITLE**: add new admin

**URL** : /admin/addAdmin

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
  "name":"MichelAdmin",
  "newLogin":"datAdmin",
  "newPwd":"newPassword",
  "sAdmin":false
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : SAdmin Login

**NOTES** :
- sAdmin is a bool but if not true is optional. In case of true this will add the new admin into the super admin(s_admin) table.

---

**TITLE**: delete an Admin

**URL** : /admin/delete

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
  "id":1
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : SAdmin Login

**NOTES** :
- this route while do a blind query to delete admin in the s_admin table

---

**TITLE**: update Admin info

**URL** : /admin/update

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
    {
     "newName":"sayMyname",
     "newLogin":"getThat",
     "newPwd":"Ok",
     "id":50
   }
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : SAdmin Login

---

## MIDDLEWARE
Basic login MIDDLEWARE you have to post your login and password on all request who need admin right.
```php
$mw = function ($request, $response, $next) {
    $dataLog = $request->getParsedBody();
    if(login($dataLog)){
      $response = $next($request, $response);
      return $response;
    }
    else{
      echo 'get Logged';
    }
};
```
add
```php
->add($mwLoginAdmin);
```
after your routes

---

Same has login middleware but check if you are a super admin
```php
$mwLoginSadmin = function ($request, $response, $next) {
    $dataLog = $request->getParsedBody();
    if(isSadmin($dataLog)){
      $response = $next($request, $response);
      return $response;
    }
};
```
add
```php
->add($mwLoginSadmin);
```
