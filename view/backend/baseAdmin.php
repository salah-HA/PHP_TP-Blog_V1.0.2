<!-- créer un nouvel articles -->

<?php ob_start(); ?>

<div class="row" id="adminCards">
  <div class="col-lg-6">

 <h2>Partager un nouvelle article</h2>
<form action="index.php?action=newPost" method="post" enctype="multipart/form-data">
  <div class="form-group">
      <label for="author">Auteur</label>
      <input type="text" class="form-control" id="author"  placeholder="Votre peudo" name="author" value="<?php echo $_SESSION['username']; ?>" required>
  </div>
  <div class="form-group">
      <label for="title">Titre</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Titre de l'article"  required>
  </div>
  <div class="form-group">

      <label for="categorie">Categorie</label>
      <select name="categorie" id="categorie">
<?php
  foreach($categories as $categorie){
?>
    <option value="<?php echo $categorie['id_cat']; ?>"><?php echo $categorie['name']; ?></option> 
<?php
  }
?>
</select>
  </div>
  <div class="form-group">
      <label for="postContent">Contenu de l'article</label>
      <textarea id="postContent" name="content" rows="15"></textarea>
  </div>
  <div class="custom-file">
    <label class="custom-file-label" for="img_posting">Selectionnez une image</label>
    <input type="file" class="custom-file-input" id="img_posting" name="img_posting">
  </div>
  <button type="submit" class="btn btn-primary">Publier</button>
</form>



<?php $content = ob_get_clean(); ?>

<?php require('view/backend/template.php'); ?>