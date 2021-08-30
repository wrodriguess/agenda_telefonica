<?php
    require_once 'config.php';

    if(!isset($_COOKIE['idUsuarioLogado']) && empty($_COOKIE['idUsuarioLogado'])){
        header("Location: login.html");
        exit;
    }
    
    $id_user = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)?? null;
    $favorito = filter_input(INPUT_POST, 'favorito', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $is_favorite = ($favorito == 'on')? 1 : '';

    $sql = $pdo->prepare("INSERT INTO contatos SET id_user = :id_user, nome = :nome, sobrenome = :sobrenome, telefone = :telefone, celular = :celular, email = :email, is_favorite = :is_favorite");
    $sql->bindValue(":id_user", $id_user);
    $sql->bindValue(":nome", $nome);
    $sql->bindValue(":sobrenome", $sobrenome);
    $sql->bindValue(":telefone", $telefone);
    $sql->bindValue(":celular", $celular);
    $sql->bindValue(":email", $email);
    $sql->bindValue(":is_favorite", $is_favorite);
    $sql->execute();

    header("Location: index.php");
    exit;