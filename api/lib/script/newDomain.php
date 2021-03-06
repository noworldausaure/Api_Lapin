<?php
// ******************************************************
// * stripeuse4.0 for lapin.org                         *
// * this file is under GLPv3 or higher                 *
// * 2017 Quentin Pourriot <quentinpourriot@outlook.fr> *
// ******************************************************


function newDomain($data){

    $db = connectDb();

  $query = $db->insert(array('short_name','large_name','author','favicon'))
								->into('info')
								->values(array($data['short_name'],e($data['large_name']),e($data['author']),e($data['favicon'])));
  if($exe = $query->execute()){
    newDb($data);
    addDomInfo($data);
    }
  }

// CREATING NEW DOMAINE DB
function newDb($data){
  $name = e($data['short_name']);

  $conn = connectSql();

  $sql['database'] = "CREATE DATABASE ".$name;
  $sql['info'] = "CREATE TABLE " .$name. ".info (short_name varchar(255),"
                                                ."large_name varchar(255),"
                                                ."author varchar(255),"
                                                ."description varchar(255),"
                                                ."favicon BLOB,"
                                                ."profil_picture BLOB,"
                                                ."ban_picture BLOB,"
                                                ."first_pub BLOB,"
                                                ."pwd varchar(255),"
                                                ."id int primary key AUTO_INCREMENT)";

  $sql['stories'] = "CREATE TABLE ".$name. ".stories (title varchar(255),"
                                            ."id int primary key AUTO_INCREMENT)";

  $sql['strips'] = "CREATE TABLE ".$name. ".strips (title varchar(255),"
                                          ."file BLOB,"
                                          ."story_id int,"
                                          ."date datetime,"
                                          ." id int primary key AUTO_INCREMENT)";

  $sql['pub'] = "CREATE TABLE " .$name.".pub (id int primary key AUTO_INCREMENT,"
                                       ."name varchar(150),"
                                       ."file BLOB,"
                                       ."link varchar(350))";

  foreach ($sql as $key => $value) {
    if ($conn->query($sql[$key]) === TRUE) {
      echo $key. " created successfully ";
    } else {
      echo " Error creating ".$key. " : ". $conn->error;
    }
  }
  $conn->close();
}

// COMPLETE INFO ON DOMAINE INFO TABLE
function addDomInfo($data){
  $db = connectDb($data['short_name']);

  $query = $db->insert(array('short_name','large_name','author','favicon','pwd'))
              ->into('info')
              ->values(array(e($data['short_name']),e($data['large_name']),e($data['author']),e($data['favicon']),e($data['pwd'])));
  if($exe = $query->execute()){
    echo ' Ok Domain Info Enregistrer ';
  }
}

 ?>
