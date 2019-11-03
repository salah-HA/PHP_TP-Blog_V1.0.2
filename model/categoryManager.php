<?php

    //afficher les categories
    function getAllCategories()
    {
        $db = dbConnect();
        $categories = $db->query('SELECT * FROM categories');
        return $categories;
    }
    function writeCat($name)
    {
        $db = dbConnect();
        $cat = $db->prepare('INSERT INTO categories(name) VALUES(?)');
        $affectedLines = $cat->execute(array($name));
        return $affectedLines;
    }