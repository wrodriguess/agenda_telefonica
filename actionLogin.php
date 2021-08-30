<?php    
    require_once 'config.php'; 

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)?? null;
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS)?? null;

    if($email && $senha){
        $usuario = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
        $usuario->bindValue(":email", $email);
        $usuario->bindValue(":senha", $senha);
        $usuario->execute();

        if($usuario->rowCount() > 0){
            $usuario = $usuario->fetch(PDO::FETCH_ASSOC);

            setcookie('idUsuarioLogado', $usuario['id'], time() + 3600000);
            
            header("Location: index.php");
            exit;
        }else{
            header("Location: login.html");
            exit;
        }
    }else{
        header("Location: login.html");
        exit;
    }

