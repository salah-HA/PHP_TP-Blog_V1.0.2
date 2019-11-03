<?php

//ecrire un commentaire
    function getComments($postId)
    {
        $db = dbConnect();
        $comments = $db->prepare('SELECT * FROM comments WHERE post_id = ?');
        $comments->execute(array($postId));
        return $comments;
    }
    //insert un commentaire
    function postComment($postId, $author, $comment)
    {
        $db = dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment) VALUES(?, ?, ?)');
        $affectedLines = $comments->execute(array($postId, $author, $comment));
        return $affectedLines;
    }
    //afficher les commentaire
    function getAllComments()
    {
        $db = dbConnect();
        $comments = $db->query('SELECT id, post_id, author, comment FROM comments');
        return $comments;
    }
    
    function getComment($comId)
    {
        $db = dbConnect();
        $req = $db->prepare('SELECT id, author, comment, status FROM comments WHERE id = ?');
        $req->execute(array($comId));
        $comment = $req->fetch();
        return $comment;
    }
    
    function getPostByComment($comId)
    {
        $db = dbConnect();
        $req = $db->prepare('SELECT post_id FROM comments WHERE id = ?');
        $req->execute(array($comId));
        $postId = $req->fetch();
        return $postId;
    }
    //supprimer un commentaire
    function commentDelete($comId)
    {
        $db = dbConnect();
        $comment = $db->prepare("DELETE FROM comments WHERE id=".$comId);
        $affectedLines = $comment->execute(array($comId));
        return $affectedLines;
    }