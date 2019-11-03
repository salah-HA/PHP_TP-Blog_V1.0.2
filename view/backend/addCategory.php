<?php ob_start(); ?>

<form action="index.php?action=newCat" method="post" enctype="multipart/form-data">
  <div class="form-group">
      <label for="author">Name</label>
      <input type="text" class="form-control" id="name"  placeholder="nom de categorie" name="name" value="" required>
  </div>

  <button type="submit" class="btn btn-primary">Publier</button>
</form>

<?php $content = ob_get_clean(); ?>


<?php require('view/backend/template.php'); ?>