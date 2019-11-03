<?php
require_once('model/PostManager.php');
require_once('model/commentManager.php');
require_once('model/UserManager.php');
require_once('model/categoryManager.php');
/*
* Créer un nouvel article
*
* @param newPost

* @param gere le titre l'autheur et le contenu
*
* @throws gere l'exception en cas d'erreur
*
* @else renvoie sur la page management des articles
*/
function newPost($title, $author, $content, $img_posting, $categorie)
{
    $affectedLines = writePost($title, $author, $content, $img_posting, $categorie);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter un article');
    }
    else {
        header('Location: index.php?action=managePosts');
    }
}
/*
* Vision global des articles
*
* @param listPostBack
*/

function listPostsBack()
{
    $posts = getPosts();
    require('view/backend/managePostsView.php');
}
/*
* Supprime un article
*
* @param deletePost

* @param supprime l'article par l'id
*
* @throws gere l'exception en cas d'erreur
*
* @else renvoie sur la page management des articles
*/
function deletePost($postId)
{
    $affectedLines = postDelete($postId);
    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer l\'article');
    }
    else {
        header('Location: index.php?action=managePosts');
    }
}
/*
* Modifier un article 
*
* @param editPost

* @param gere le titre l'autheur et le contenu et l'image
*
* @throws gere l'exception en cas d'erreur
*
* @else renvoie sur la page de l'article en question
*
*gestion des deux cas de figure (avec changement d'image et sans)
*/
function editPost($id, $title, $author, $content, $imgUrl)
{
    //si pas d'image selectionné on ne fait pas l'update de l'image et on garde celle présente
    if($imgUrl == null){
        $affectedLines = postEdit($id, $title, $author, $content);
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'éditer l\'article');
        }
        else {
            header('Location: index.php?action=post&id='.$id);
        }
    //Sinon on fait un update complete de l'article
    }else{
        $affectedLines = postEditImg($id, $title, $author, $content, $imgUrl);
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'éditer l\'article');
        }
        else {
            header('Location: index.php?action=post&id='.$id);
        }
    }
}
/*
* gère la vu vers un article
*
* @param viewEditPost
*
* @require envoie sur la page de modification d'article
*/
function viewEditPost($postId)
{
    $post = getPost($postId);
    require('view/backend/editPostView.php');
}
/*
* gere la liste des commentaires
*
* @param listCommentsBack
*
* @require envoie sur la page management des commentaires
*/
function listCommentsBack()
{
    $comments = getAllComments();
    require('view/backend/manageCommentsView.php');
}
/*
* gere la suppression d'un commentaire
*
* @param deleteCom
*
* envoi sur la page d'administration des commentaires
*/
function deleteCom($comId)
{
    $affectedLines = commentDelete($comId);
    if ($affectedLines === false) {
        throw new Exception('Impossible de supprimer le commentaires');
    }
    else {
        header('Location: index.php?action=manageComments');
    }
}
/*
* gère la vu vers une categories
*
* @param viewEditcat
*
* @require envoie sur la page de modification de categories
*/
function editCat()
{
    $cat = getCat();
    require('view/backend/addCategory.php');
}
/*
* gere la liste des categories
*
* @param listCategoryBack
*
* @require envoie sur la page management des categoris
*/
function listCategoryBack()
{
    $categories = getAllCategories();
    require('view/backend/manageCategoriesView.php');
    
}
/*
* gere l'ajout d'une catégories
*
* @param addCat
*
* envoi sur la page d'administration des categories
*/
function newCat($name)
{
    $affectedLines = writeCat($name);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter une categorie');
    }
    else {
        header('Location: index.php?action=manageCategories');
    }
}

/*
* gere l'ajout et le changement d'une image 
*
* @param getImgUrl
*
* @require envoie sur la page d'administration des commentaires
*/
function getImgUrl()
{
    $target_dir = "public/img/";
    $target_file = $target_dir . basename($_FILES['img_posting']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if($imageFileType == "jpg" OR $imageFileType == "png" OR $imageFileType == "jpeg"
    OR $imageFileType == "gif" ){
        if ($_FILES["img_posting"]["size"] <= 4000000){
            move_uploaded_file($_FILES['img_posting']['tmp_name'], $target_file);
        }
        else{
            throw new Exception('Fichier trop volumineux, 4Mo maximum');
        }
    }
    else{
        throw new Exception('Extension d\'image incompatible, veuillez charger une image .jpg, .png, .jpeg, .gif');
    }
    return $target_file;
}
?>