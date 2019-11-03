<?php ob_start(); ?>
    <head>
        <link href="public/css/style.css" rel="stylesheet">
    </head>
    <div class="body-post">
    <section>


        <?php
        //recupération des informations des posts ecrit.
            while ($data = $posts->fetch())
            {
        ?>

        <!-- // affiche les posts ecrit -->
        <div class="containerArticle">
            <div class="content-image">
                <img class="card-img-top" src="<?php echo $data['img_posting']?>" alt="illustration article">
            </div>
            <div class="content-info">
                <h3><?= htmlspecialchars($data['title']) ?></h3>
                <p class="card-text"><?= nl2br($data['content'])?>...</p>
                <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-primary">Lire la suite</a>
                <div class="content-footer-info">
                    Categorie: <?= $data['name'] ?>
                    par :<?= $data['author'] ?>
                </div>
            </div>
        </div>
        <?php
        }
        $posts->closeCursor();
        ?>
    </section>
    <aside>
        <h4>Cest jujujul</h4>
    </aside>
    </div>
    <?php $content = ob_get_clean(); ?>

<?php require('view/frontend/home.php'); ?>