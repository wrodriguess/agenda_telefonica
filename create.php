<?php
    $id = $_COOKIE['idUsuarioLogado'];

    if(!isset($_COOKIE['idUsuarioLogado']) && empty($_COOKIE['idUsuarioLogado'])){
        header("Location: login.html");
        exit;
    }
?>

<h1>Novo Contato</h1>

<form action="actionCreate.php" method="post">
    <input type="hidden" name="id_usuario" value="<?= $id; ?>">
    
    <label>
        Nome<br>
        <input type="text" name="nome" id="nome" required>
    </label><br><br>

    <label>
        Sobrenome<br>
        <input type="text" name="sobrenome" id="sobrenome"><br>
    </label><br>

    <label>
        Telefone<br>
        <input type="tel" name="telefone" id="telefone">
    </label><br><br>

    <label>
        Celular<br>
        <input type="tel" name="celular" id="celular">
    </label><br><br>

    <label>
        Email<br>
        <input type="email" name="email" id="email">
    </label><br><br>

    <label>
        <input type="checkbox" name="favorito" id="favorito"> Favorito
    </label><br><br>

    <input type="submit" value="Criar">

</form>

<a href="index.php">Voltar</a>