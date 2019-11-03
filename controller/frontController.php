<?php
error_reporting(E_ALL);

session_start();
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/commentManager.php');
require_once('model/authManager.php');
/*
* affiche les articles
*
* @param listPosts
*
* @require envoie sur la page des articles
*/
function listPosts()
{
    $posts = getPosts();
    require('view/frontend/listPostsView.php');
}
/*
* affiche un article
*
* @param post
*
* @require envoie sur la page de l'article en question
*/

function post($postId = null, $message = null)
//Passage en option de l'id de l'article et du message pour le signalement de commentaire
{
    //Dans le cas ou un commentaire a été signalé $postId contient l'id de l'article
    if(isset($postId)){
        $_GET['id'] = $postId;
    }

    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);
    require('view/frontend/postView.php');
}
/*
* ajout d'un commentaire
*
* @param addComment
*
* @renvoie sur la page de l'article en question avec prise en charge du nouveau com
*/
function addComment($postId, $author, $comment)
{

    $affectedLines = postComment($postId, $author, $comment);
    if ($affectedLines === false){
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
/*
* Verification connexion d'un membre
*
* @param verifyMember
*
* @redirection vers la pages d'acceuil avec connexion etabli
*/
function verifyMember($password, $username)
{

    $member = getMember($username);
    //comparaison du mdp saisie avec le mdp hash de la bdd
    $isPasswordCorrect = password_verify($password, $member['password']);
    //Si $member=false le membre n'est pas existant en bdd

    try{
        if (!$member)
        {
            throw new Exception('Mauvais utilisateur ou mot de passe!');
        }
        else
        //L'admin' existe 
        {
            if ($isPasswordCorrect)  {
                $_SESSION['id'] = $member['id'];
                $_SESSION['username'] = $member['username'];
                $_SESSION['password'] = $member['password'];
                $_SESSION['mail'] = $member['mail'];
                //on redirige vers la page d'accueil qui prendra en compte les variable de session
                header('Location: index.php');
            }
        //Le mdp corresponds pas
            else {
                throw new Exception('Mauvais utilisateur ou mot de passe');
            }
        }
    }
    catch(Exception $e){
        $authInfo = $e->getMessage();
        ob_start();
        ?>
        <div id="wrongPass">
            <p><?php  echo 'Erreur : ' . $e->getMessage(); ?></p>
            <?php include('include/login.php');?>
        </div>
        <?php
        $content = ob_get_clean();
        require('view/frontend/home.php');
    }
}
function addMember($username, $mail, $password, $password2)
{
    try
    {
        //Vérification de l'existance ou non du pseudo dans la bdd et verification sur les champs du formulaire
        $checkMember = checkNickname($username);
        if(!$checkMember){
            if(preg_match('#[a-zA-Z0-9_]#', $username)){
                if($password == $password2){
                    if(preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $mail)){
                        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
                        //envoi au modele pour insertion dans BDD
                        $push = pushMembers($username, $pass_hash, $mail);
                        throw new Exception('Votre compte a été créé avec succès');
                    }else{
                        throw new Exception('veuillez vérifier votre adresse email');
                        }
                }else{
                    throw new Exception('Les mots de passe ne correspondent pas');;
                    }
            }else{
                throw new Exception('Un ou plusieurs caractères non autorisé dans le mot de passe');
                }
        }else{
            throw new Exception('Ce pseudo est déjà utilisé');
            }
    }
    catch(Exception $e){
        $info = $e->getMessage();
        require('view/frontend/newAcountView.php');
    }
}
/*
* Deconnection a l'admin
*
* @param logout
*
* @redirection vers la pages d'acceuil avec deconnexion etabli
*/
function logout()
{
    session_destroy();
    header('Location: index.php');
}
?>