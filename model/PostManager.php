<?php

require_once __DIR__ . '/../config/config.php';

   //Retourne tous les billet de la BDD
function getPosts()
{
    $db = dbConnect();
    $req = $db->query('SELECT * FROM posts INNER JOIN categories ON categories.id_cat = posts.idCategory LIMIT 10');
    return $req;
}
//retourne le billet correspondant à l'id en parametres
function getPost($postId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id, title, author, content, img_posting FROM posts WHERE id = ?');
    $req->execute(array($postId));
    $post = $req->fetch();
    return $post;

}
//ecrire un article
function writePost($title, $author, $content, $img_posting, $categorie)
{
    $db = dbConnect();
    $post = $db->prepare('INSERT INTO posts(title, author, content, img_posting, idCategory) VALUES(?, ?, ?, ?, ?)');
    $affectedLines = $post->execute(array($title, $author, $content, $img_posting, $categorie));
    return $affectedLines;
}
//supprimer un article
function postDelete($postId) 
{
    $db = dbConnect();
    $post = $db->prepare("DELETE FROM posts WHERE id=".$postId);
    $affectedLines = $post->execute(array($postId));
    return $affectedLines;
}
//editer une image pour l'article
function postEditImg($id, $title, $author, $content, $imgUrl) 
{
    $db = dbConnect();
    $req = $db->prepare('UPDATE posts SET title = ?, author = ?, content = ?, img_posting = ? WHERE id = ?');
    $post = $req->execute(array($title, $author, $content, $imgUrl, $id ));
    return $post;
}
//editer un article
function postEdit($id, $title, $author, $content)
{
    $db = dbConnect();
    $req = $db->prepare('UPDATE posts SET title = ?, author = ?, content = ? WHERE id = ?');
    $post = $req->execute(array($title, $author, $content, $id ));
    return $post;
}