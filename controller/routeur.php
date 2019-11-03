<?php
require (__DIR__ . '/frontController.php');
require (__DIR__ . '/backController.php');

$accesdenied = 'Vous tentez d\'accéder à un espace réservé aux administrateurs !';

function getRoute(){
        //Routeur
    $accesdenied = 'Espace réservé à l \'administrateur';
    try {
        //gestion affichage des articles
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'listPosts') {
                    listPosts();
            }
            elseif ($_GET['action'] == 'post') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        post();
                    }
                    else {
                        throw new Exception('Aucun identifiant de billet envoyé');
                    }
            }
            //ecrire un commentaire
            elseif ($_GET['action'] == 'addComment') {
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                            addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                    }
                    else {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                }   
                else{
                    throw new Exception('Aucun identifiant de billet envoyé');
                    }
            }
            //gestion de connexion de l'admin dans son centre de gestion
            elseif ($_GET['action'] == 'login'){
                if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']))
                {
                    verifyMember($_POST['password'], $_POST['username']);
                }
                else{
                    throw new Exception('Tous les champs ne sont pas remplis');
                }
            }
                //redirection vers la View de creation de membre
            elseif ($_GET['action'] == 'creationUser') {
                require('view/frontend/newAcountView.php');
            }
            //Creation d'un nouveau membre
            elseif ($_GET['action'] == 'newUser') {
                if (isset($_POST['username']) && !empty($_POST['username'])
                    && isset($_POST['mail']) && !empty($_POST['mail'])
                    && isset($_POST['password']) && !empty($_POST['password'])
                    && isset($_POST['password2']) && !empty($_POST['password2']))
                {
                    addMember($_POST['username'], $_POST['mail'], $_POST['password'], $_POST['password2']  );
                }else {
                    throw new Exception('Tous les champs ne sont pas remplis');
                }
            }
            //acces à la zone d'administration
            elseif($_GET['action'] == 'admin'){
                if(isset($_SESSION['username']) && $_SESSION['username']){
                    $categories = getAllCategories();
                    require('view/backend/baseAdmin.php');
                }
                else{
                    throw new Exception($accesdenied);
                }
            }
            //acces a la gestion des articles
            elseif($_GET['action'] == 'managePosts'){
                if(isset($_SESSION['username']) && $_SESSION['username']){
                    listPostsBack();
                }
                else{
                    throw new Exception($accesdenied);
                }
            }
            //gestion de la suppression des articles 
            elseif($_GET['action'] == 'deletePost'){
                if(isset($_SESSION['username']) && $_SESSION['username']){
                    if(isset($_GET['id']) && $_GET['id'] > 0){
                        deletePost($_GET['id']);
                    }
                    else{
                        throw new Exception('Aucun id d\'article');
                    }
                }
                else{
                    throw new Exception($accesdenied);
                }
            }
            //Ecrire un nouvel article depuis la zone admin
            elseif($_GET['action'] == 'newPost'){
                if (!empty($_POST['author']) && !empty($_POST['content'])&& !empty($_POST['title'])){
                    $imgUrl = getImgUrl();
                    newPost($_POST['title'], $_POST['author'], $_POST['content'], $imgUrl,$_POST['categorie']);
                    
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis');
                }
            }
            //acces à l'edition d'un article 
            elseif ($_GET['action'] == 'editPostView') {
                if(isset($_SESSION['username']) && $_SESSION['username']){
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        viewEditPost($_GET['id']);
                    }
                    else {
                        throw new Exception('Aucun article à éditer !');
                    }
                }
                else{
                    throw new Exception($accesdenied);
                }
            }
            //validation de l'edition de l'article
            elseif($_GET['action'] == 'editPost'){
                if(isset($_SESSION['username']) && $_SESSION['username']){
                    if (isset($_GET['id']) && $_GET['id'] > 0){
                        //Image présente dans l'input file
                        if(isset($_FILES['img_posting']['name']) && !empty($_FILES['img_posting']['name'])){
                            $imgUrl = getImgUrl();
                            editPost($_GET['id'], $_POST['title'], $_SESSION['username'], $_POST['content'], $imgUrl);
                        //si pas d'image selectionner
                        }
                        else{
                            $imgUrl = null;
                            editPost($_GET['id'], $_POST['title'], $_SESSION['username'], $_POST['content'], $imgUrl);
                        }
                    }
                    else{
                        throw new Exception('Aucun id d\'article');
                    }
                }
                else{
                    throw new Exception($accesdenied);
                }
            }
            //vers la page de gestion des commentaires
            elseif($_GET['action'] == 'manageComments'){
                if(isset($_SESSION['username']) && $_SESSION['username']){
                    listCommentsBack();
                }
                else{
                    throw new Exception($accesdenied);
                }
            }
            elseif($_GET['action'] == 'editComment'){
                if(isset($_SESSION['username']) && $_SESSION['username']){
                    if (isset($_GET['id']) && $_GET['id'] > 0){
                        editCom($_GET['id'], $_POST['author'], $_POST['comment'], $_POST['status']);
                    }else{
                        throw new Exception('Aucun id de commentaire');
                    }
                }else{
                    throw new Exception($accesdenied);
                }
            }
            //Suppression d'un commentaire
            elseif($_GET['action'] == 'deleteComment'){
                if(isset($_SESSION['username']) && $_SESSION['username']){
                    if(isset($_GET['id']) && $_GET['id'] > 0){
                        deleteCom($_GET['id']);
                    }
                    else{
                        throw new Exception('Aucun id d\'article');
                    }
                }
                else{
                    throw new Exception($accesdenied);
                }
            }
            //vers la page de gestion des categories
            elseif($_GET['action'] == 'manageCategories'){
                if(isset($_SESSION['username']) && $_SESSION['username']){
                    listCategoryBack();
                }
                else{
                    throw new Exception($accesdenied);
                }
            }
             //vers la pages d'ecriture d'une categoie
            elseif($_GET['action'] == 'addCategories'){
                if(isset($_SESSION['username']) && $_SESSION['username']){
                    require('view/backend/addCategory.php');
                }
                else{
                    throw new Exception($accesdenied);
                }
            }
            //Ecrire un nouvel article depuis la zone admin
        elseif($_GET['action'] == 'newCat'){
            if (!empty($_POST['name'])){
                newCat($_POST['name']);
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis');
            }
        }
            //redirection vers la modif de mot passe
            // elseif ($_GET['action'] == 'creationUser') {
            //     if(isset($_SESSION['uusername']) && $_SESSION['username']){
            //         require('view/backend/newPassView.php');
            //     }
            // }
            //Creation d'un nouveau mot de passe
            elseif ($_GET['action'] == 'newPass') {
                if(isset($_SESSION['username']) && $_SESSION['username']){
                    if (isset($_POST['password']) && !empty($_POST['password'])
                        && isset($_POST['password2']) && !empty($_POST['password2']))
                    {
                        passMember($_POST['password'], $_POST['password2']);
                    }
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis');
                }
            }
            //logout membre
            elseif ($_GET['action'] == 'logout'){
                logout();
            }
        }
        //Affichage de la liste des billets
        else{
            listPosts();
        }
    }
    //Gestion des erreurs
    catch(Exception $e) {
        ob_start();
        ?>
        <div id="errorPage">
            <p><?php  echo 'Erreur : ' . $e->getMessage(); ?></p>
            <p>Retour à <a href="index.php">l'accueil</a></p>
        </div>
        <?php
        $content = ob_get_clean();
        require('view/frontend/home.php');
    }
}
