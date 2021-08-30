<?php
    require_once 'config.php';

    if(!isset($_COOKIE['idUsuarioLogado']) && empty($_COOKIE['idUsuarioLogado'])){
        header("Location: login.html");
        exit;
    }

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_EMAIL)?? null;
    $id_user = $_COOKIE['idUsuarioLogado'];

    $sql = $pdo->prepare("DELETE FROM contatos WHERE id = :id AND id_user = :id_user");
    $sql->bindValue(":id", $id);
    $sql->bindValue(":id_user", $id_user);
    $sql->execute();

    header("Location: index.php");
    exit;