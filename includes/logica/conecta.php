<?php
   try {
    $conexao = new PDO("mysql:host=localhost; dbname=atv1daw; charset=utf8", "root","");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
?>