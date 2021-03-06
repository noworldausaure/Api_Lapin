<?php
// ******************************************************
// * stripeuse4.0 for lapin.org                         *
// * this file is under GLPv3 or higher                 *
// * 2017 Quentin Pourriot <quentinpourriot@outlook.fr> *
// ******************************************************

// GETTER INFO

// GET GENERAL INFO
function getAllInfo(){
  $db = connectDb();
  $query = $db->select()
              ->from('info')
              ->orderby('id');
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo json_encode($data);
}

// GET INFO ON DOMAINE
function getInfoByDomain($dom){
  $db = connectDb($dom);
  $query = $db->select()
              ->from('info');
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo json_encode($data);
}
// END INFO

// STRIP IMAGE GETTER
function getStripImage($dom,$id) {
  $db = connectDb($dom);
  $query = $db->select(['file'])
              ->from('strips')
              ->where('id','=',$id);
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo json_encode($data);
}

// STRIPS GETTER
function getStripsByDomain($dom,$number,$offset){
  $db = connectDb($dom);
  $number=(intval($number)==0)?9:intval($number);
  $offset=(intval($offset)==0)?0:intval($offset);
  $query = $db->select(['title','story_id','date','id'])
              ->from('strips')
              ->limit($number,$offset);
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo json_encode($data);
}

function getStripsByDate($dom,$date){
  $db = connectDb($dom);
  $d = DateTime::createFromFormat('Y-m-d H:i:s', $date);
  if($d && $d->format($format) == $date) {

  }
  else {
    $d = new DateTime();
    $d->modify('-1 day');
  }
  $query = $db->select(['title','story_id','date','id'])
              ->from('strips')
              ->where('date','>=',$d->format('Y-m-d H:i:s'));
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo json_encode($data);
}

// END STRIPS

//STORIES GETTER
function getStoriesByDomain($dom,$number,$offset){
  $db = connectDb($dom);
  $number=(!is_integer($number))?20:$number;
  $offset=(!is_integer($offset))?0:$offset;
  $query = $db->select()
              ->from('stories')
              ->limit($number,$offset);
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo json_encode($data);
}

//END STORIES

function getAdmin(){
  $db = connectDb();
  $query = $db->select()
              ->from('admin')
              ->orderby('id');
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo json_encode($data);
}

function getStripsByStories($dom,$id){
  $db = connectDb($dom);
  $query = $db->select(['title','story_id','date','id'])
              ->from('strips')
              ->where('story_id','=',$id)
              ->orderby('date','DESC');
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo json_encode($data);
}

function getLapinPub($id){
  $db = connectDb();
  $query = $db->select()
              ->from('pub');
  if(isset($id)){
    $db->where('id','=',$id);
  }
  $exe = $query->execute();
  $data = $exe->fetchAll();
  echo json_encode($data);
}

function getDomainPub($dom){
    $db = connectDb($dom);
    $query = $db->select()
                ->from('pub')
                ->orderby('id');

    $exe = $query->execute();
    $data = $exe->fetchAll();
    echo json_encode($data);
}
?>
