<?php

require_once __DIR__ . '/../config/config.php';
  //identification de l'admin en base de donnée
function getMember($username)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id, password, username, mail FROM users WHERE username = :username');
    $req->execute(array('username' => $username));
    $result = $req->fetch();
    return $result;
}  