<?php
require_once("model/Manager.php");

    //passage en parametre du nouveau mdp 
    function pushMember($password){
      $db = dbConnect();
      $sql = "UPDATE users SET password=? WHERE id=?";
      $db->prepare($sql)->execute([$password, 1]);
    }
    
    function pushMembers($username, $pass_hash, $mail)
    {
        $db = dbConnect();
        $req = $db->prepare('INSERT INTO users(username, password, mail) VALUES(:username, :password, :mail)');
              //On rempli la BDD avec les infos du formulaire
          $req->execute(
            array(
              'username' => $username,
              'password' => $pass_hash,
              'mail' => $mail)
            );
    }
    function checkNickname($usernameToCheck)
    {
      $db = dbConnect();
      //requete retourne 1 si pseudo existe
      $req = $db->prepare('SELECT COUNT(*) AS username FROM users WHERE username = ?');
      $req->execute(array($usernameToCheck));
      $username = $req->fetch();
      return $username['username'];
    }