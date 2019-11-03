<?php ob_start(); ?>
<!--affiche l'articles -->
<div class="container">
      <div class="row">
        <div class="col-lg-11">
          <!-- Title -->
          <h2 class="mt-4"><?= htmlspecialchars($post['title']) ?></h2>
          <!-- Author -->
          <p class="lead">
            Par
            <?= $post['author'] ?>
          </p>
          <hr>
          <img class="img-fluid rounded" src="<?php echo $post['img_posting']?>" alt="illustration article">
          <hr>
          <!-- Post Content -->
          <p class="lead"><?= nl2br($post['content']) ?></p>
          <p>
  <?php

  //Mode edition depuis l'article si connecter en Admin
  if(isset($_SESSION['username']) && $_SESSION['username']){
  ?>
  <div class= "col-3 offset-3">
    <a href="index.php?action=editPostView&amp;id=<?php echo $post['id'];?>"><button class="btn btn-secondary" type="button">Éditer</button></a>
  </div>
  <div class= "col-6">
    <a href="index.php?action=deletePost&amp;id=<?php echo $post['id']; ?>"><button class="btn btn-danger" type="button" onclick="return confirm('Etes vous sur de vouloir supprimer cet article ?')">Supprimer</button></a>
  </div>
  <?php
  }
  ?>
<!-- redaction d'un commentaire -->
<div class="col-lg-12">
  <h2 class="comment-title">Vos Commentaires</h2>
  <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post" class="border-form">
      <div class="col-lg-12">
        <label for="author">Auteur</label><br>
        <input type="text" id="author" name="author">
      </div>
      <div class="col-lg-12">
        <label for="comment">Commentaire</label>
        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
      </div>
      <div class="col-lg-12">
      <button type="submit" class="btn btn-primary">Envoyer</button>
    </div>
  </form>
</div>

<!--affiche les commentaires-->
<div class="col-lg-12">
<div class="comment-comment">
<?php
while ($comment = $comments->fetch())
{
?>
<div class="col-lg-12 info-author">
  <p><strong>Auteur : </strong><?= htmlspecialchars($comment['author']) ?></p>
</div>
<div class="complet-info">
  <div class="col-lg-12">
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
  </div>
</div>
<?php
  }
?>
</div>
</div>


<!-- signalement d'un message -->
<span id="signalMessage">
<p><?php
if(isset($message)){
echo $message;
}
?>
</p>
</span>
</div>
<!--On insert dans la variable content le contenu ci dessus-->
<?php $content = ob_get_clean(); ?>


<?php require('view/frontend/home.php'); ?>