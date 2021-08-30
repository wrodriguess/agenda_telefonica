<?php
    require_once 'config.php';

    if(!isset($_COOKIE['idUsuarioLogado']) && empty($_COOKIE['idUsuarioLogado'])){
        header("Location: login.html");
        exit;
    }

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS)?? null;
    $id_user = $_COOKIE['idUsuarioLogado'];

    $sql = $pdo->prepare("SELECT * FROM contatos WHERE id = :id AND id_user = :id_user");
    $sql->bindValue(":id", $id);
    $sql->bindValue(":id_user", $id_user);
    $sql->execute();

    if($sql->rowCount() > 0){
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
    }else{
        header("Location: index.php");
        exit;
    }
?>

<h1>Novo Contato</h1>

<form action="actionUpdate.php" method="post">
    <input type="hidden" name="id" value="<?= $usuario['id']; ?>">
    
    <label>
        Nome<br>
        <input type="text" name="nome" id="nome" required value="<?= $usuario['nome']; ?>">
    </label><br><br>

    <label>
        Sobrenome<br>
        <input type="text" name="sobrenome" id="sobrenome" value="<?= $usuario['sobrenome']; ?>"><br>
    </label><br>

    <label>
        Telefone<br>
        <input type="tel" name="telefone" id="telefone" value="<?= $usuario['telefone']; ?>">
    </label><br><br>

    <label>
        Celular<br>
        <input type="tel" name="celular" id="celular" value="<?= $usuario['celular']; ?>">
    </label><br><br>

    <label>
        Email<br>
        <input type="email" name="email" id="email" value="<?= $usuario['email']; ?>">
    </label><br><br>

    <label>
        <input type="checkbox" name="favorito" id="favorito" <?= ($usuario['is_favorite'] == 1)? "checked": ""?> > Favorito
    </label><br><br>

    <input type="submit" value="Atualizar">

</form>

<a href="index.php">Voltar</a>