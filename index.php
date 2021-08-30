<?php
    require_once 'config.php';

    if(!isset($_COOKIE['idUsuarioLogado']) && empty($_COOKIE['idUsuarioLogado'])){
        header("Location: login.html");
        exit;
    }

    $id = $_COOKIE['idUsuarioLogado'];
    $usuario = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
    $usuario->bindValue(":id", $id);
    $usuario->execute();

    $usuario = $usuario->fetch(PDO::FETCH_ASSOC);

    $filtro = '';
    $ordem = ''; 
    if(isset($_GET['filtro']) && !empty($_GET['nome'])){
        $filtro = $_GET['filtro'];
    }

    if(isset($_GET['op']) && !empty($_GET['op'])){
        $ordem = $_GET['op'];
    }
?>
    <h2>Bem-Vindo(a) <?= $usuario['nome']; ?> | <a href="logout.php">Sair</a></h2>
    
    <a href="create.php">
        <h3>
            <img src="icons/create.png"/>
            Novo Contato
        </h3>
    </a>

    <form action="" method="get">
        Pesquisar:  <input type="text" name="filtro" id="filtro" placeholder="nome, numero ou e-mail" value=<?= $_GET['filtro'] ?? ''; ?> >
        <button><img src="icons/lupa.png" alt="search"></button>
                 
        <select name="op" id="op" style="margin-left: 70px;" onchange="this.form.submit()">
            <option value=""  >Ordenar por</option>
            <option value="nome" <?= ($ordem == 'nome')? 'selected' : '';  ?> >Ordem Alfabetica</option>
            <option value="nome DESC" <?= ($ordem == 'nome DESC')? 'selected' : '';  ?> >Ordem Alfatica Inversa</option>
            <option value="id DESC" <?= ($ordem == 'id DESC')? 'selected' : '';  ?> >Mais Recentes</option>
            <option value="id" <?= ($ordem == 'id')? 'selected' : '';  ?> >Mais Antigos</option>
            <option value="favorito" <?= ($ordem == 'favorito')? 'selected' : '';  ?> >Favoritos</option>
        </select>

        
    </form>

    <table border="1" width="50%">
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>

        <?php
            if((isset($_GET['filtro']) && !empty($_GET['filtro'])) && (isset($_GET['op']) && !empty($_GET['op']))){
                $filtro = $_GET['filtro'];
                $ordem = $_GET['op'];
                $contatos = $pdo->query("SELECT * FROM contatos WHERE nome LIKE '%$filtro%' OR sobrenome LIKE '%$filtro%' OR telefone LIKE '%$filtro%' OR celular LIKE '%$filtro%' OR email LIKE '%$filtro%' ORDER BY $ordem");
            }else if(isset($_GET['filtro']) && !empty($_GET['filtro'])){
                $filtro = $_GET['filtro'];
                $contatos = $pdo->query("SELECT * FROM contatos WHERE nome LIKE '%$filtro%' OR sobrenome LIKE '%$filtro%' OR telefone LIKE '%$filtro%' OR celular LIKE '%$filtro%' OR email LIKE '%$filtro%'");
                
            }else if(isset($_GET['op']) && !empty($_GET['op'])){
                $ordem = $_GET['op'];
                if($ordem == 'favorito'){
                    $contatos = $pdo->query("SELECT * FROM contatos WHERE is_favorite = 1");
                }else{
                    $contatos = $pdo->query("SELECT * FROM contatos WHERE id_user = $id ORDER BY $ordem");
                }
            }else{
                $contatos = $pdo->query("SELECT * FROM contatos WHERE id_user = $id");
            }
            
                    
            if($contatos->rowCount() > 0){
                $contatos = $contatos->fetchAll(PDO::FETCH_ASSOC);
                foreach($contatos as $contato){
                    ?>
                        <tr>
                            <td><?= $contato['nome']; ?></td>
                            <td>
                                <a href="read.php?id=<?= $contato['id']; ?>">
                                    <img src="icons/read.png"/>
                                </a>
                                <a href="update.php?id=<?= $contato['id']; ?>">
                                    <img src="icons/edit.png"/>
                                </a> 
                                <a href="delete.php?id=<?= $contato['id']; ?>">
                                    <img src="icons/delete.png"/>
                                </a>
                            </td>
                        </tr>
                    <?php
                }
            }else{
                ?>
                    <tr>
                        <td colspan="2" align="center">Não há contatos cadastrados.</td>
                    </tr>
                <?php
            }

        ?>


    </table>