<?php
// ******************************************************
// * stripeuse4.0 for lapin.org                         *
// * this file is under GLPv3 or higher                 *
// * 2017 Quentin Pourriot <quentinpourriot@outlook.fr> *
// ******************************************************


  function loginDomain($domain,$data){
    $pwd = $data['pwd'];

    $db = connectDb($domain);

    $query = $db->select()
                ->from('info')
                ->where('pwd','=',$pwd);
    $exec = $query->execute();

    $data = $exec->fetchAll();

    return $data;
  }

  function login($data){
    if(isMd5($data['pwd'])){
    $db = connectDb();

    $query = $db->select()
                ->from('admin')
                ->where('name','=',$data['login'])->orWhere('login','=',$data['login']);

    $exec = $query->execute();
    $donnee = $exec->fetch();

      if($donnee['pwd'] == $data['pwd']){
       return true;
    }
    else{
      echo 'password/login incorrect';
    }
  }
  else {
    echo 'Mauvais format de mots de passe';
  }
}

  function isSadmin($data){
    if(login($data)){
    $db = connectDb();
    $query = $db->select(array('id'))
                ->from('admin')
                ->where('name','=',$data['login'])->orWhere('login','=',$data['login']);

    $exec = $query->execute();
    $id = $exec->fetch();


    $query = $db->select()
                ->from('s_admin')
                ->where('id_admin','=',$id['id']);
    $exe = $query->execute();

    if(count($exe->fetch()) >= 2){
      return true;
      }
    else{
      return false;
    }
  }
}
?>
