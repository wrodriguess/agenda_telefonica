<?php

    try{
        $pdo = new PDO("mysql:dbname=agenda_telefonica;host=localhost", "root", "");
    }catch(PDOException $e){
        echo "Falhou: ".$e->getMessage();
    }