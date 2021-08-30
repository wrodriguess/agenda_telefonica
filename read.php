<?php
    require_once 'config.php';

    if(!isset($_COOKIE['idUsuarioLogado']) && empty($_COOKIE['idUsuarioLogado'])){
        header("Location: login.html");
        exit;
    }

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $id_user = $_COOKIE['idUsuarioLogado'];

    $usuario = $pdo->prepare("SELECT * FROM contatos WHERE id = :id AND id_user = :id_user");
    $usuario->bindValue(":id", $id);
    $usuario->bindValue(":id_user", $id_user);
    $usuario->execute();

    if($usuario->rowCount() > 0){
        $usuario = $usuario->fetch(PDO::FETCH_ASSOC);
    }else{
        header("Location: index.php");
        exit;
    }
?>
    <style>
        rotulo{
            font-size: 20px;
            font-weight: bold;
        }
    </style>
    <?= ($usuario['is_favorite'])? '<img src="icons/star.png"/>' : ''; ?><br>
    <rotulo>Id:</rotulo> <?= $usuario['id']; ?><br><br>
    <rotulo>Nome:</rotulo> <?= $usuario['nome']; ?><br><br>
    <rotulo>Sobrenome:</rotulo> <?= $usuario['sobrenome']; ?><br><br>
    <rotulo>Telefone:</rotulo> <?= $usuario['telefone']; ?><br><br>
    <rotulo>Celular:</rotulo> <?= $usuario['celular']; ?><br><br>
    <rotulo>E-mail:</rotulo> <?= $usuario['email']; ?><br><br>

    <a href="index.php">Voltar</a>