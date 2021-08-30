<?php
    require_once 'config.php';

    if(!isset($_COOKIE['idUsuarioLogado']) && empty($_COOKIE['idUsuarioLogado'])){
        header("Location: login.html");
        exit;
    }
    
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)?? null;
    $favorito = filter_input(INPUT_POST, 'favorito', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $is_favorite = ($favorito == 'on')? 1 : '';

    $sql = $pdo->prepare("UPDATE contatos SET nome = :nome, sobrenome = :sobrenome, telefone = :telefone, celular = :celular, email = :email, is_favorite = :is_favorite WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->bindValue(":nome", $nome);
    $sql->bindValue(":sobrenome", $sobrenome);
    $sql->bindValue(":telefone", $telefone);
    $sql->bindValue(":celular", $celular);
    $sql->bindValue(":email", $email);
    $sql->bindValue(":is_favorite", $is_favorite);
    $sql->execute();

    header("Location: index.php");
    exit;