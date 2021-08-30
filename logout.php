<?php
    setcookie('idUsuarioLogado', '', time() - 1);
    
    header("Location: login.html");
    exit;
