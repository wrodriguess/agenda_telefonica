<?php
    require_once 'config.php';

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)?? null;
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS)?? null;

    $sql = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, senha = :senha");
    $sql->bindValue(":nome", $nome);
    $sql->bindValue(":email", $email);
    $sql->bindValue(":senha", $senha);
    $sql->execute();

    header("Location: login.html");
    exit;
