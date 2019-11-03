<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-9">
        <h2 style="text-align: center"> Éditions des categories</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <tr class="column-border">
                    <th scope="col"></th>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
                <tr>
                    <?php
                    while ($data = $categories->fetch()) {
                    ?>
                    <th scope="col"></th>
                    <th scope="row"><?php echo nl2br(htmlspecialchars($data['id_cat'])); ?></th>
                    <td><?php echo htmlspecialchars($data['name']); ?></td>
                    <th scope="col"></th>
                </tr>
                    <?php
                    }
                    $categories->closeCursor();
                    ?>
            </table>
            <td><a href="index.php?action=addCategories" ?><button type="button" class="btn btn-warning">Ajouter une catégorie</button></a></td>
        </div>

        <?php $content = ob_get_clean(); ?>

        <?php require('view/backend/template.php'); ?>
    </div>
</div>