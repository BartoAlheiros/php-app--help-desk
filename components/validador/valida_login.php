<?php

    //iniciando a sessão
    session_start();

    //variavel que verifica se a autenticacao foi realizada
    $usuario_autenticado = false;
    //variáveis para armazenar as informações do usuário logado
    $usuario_id = null;
    $usuario_perfil_id = null;
    $usuario_nome_login = null;

    $perfis = array(1 => 'Administrativo', 2 => 'Usuário');

    //usuarios do sistema
    $usuarios_app = array(
        array('id' => 1, 'login_user' => 'Admin', 'email' => 'admn@teste.com.br', 'senha' => '1234', 'perfil_id' => 1),
        array('id' => 2, 'login_user' => 'Teste', 'email' => 'user@teste.com.br', 'senha' => '1234', 'perfil_id' => 1),
        array('id' => 3, 'login_user' => 'José', 'email' => 'jose@teste.com.br', 'senha' => '1234', 'perfil_id' => 2),
        array('id' => 4, 'login_user' => 'Maria', 'email' => 'maria@teste.com.br', 'senha' => '1234', 'perfil_id' => 2),
    );
    
    //percorre todos os usuários cadastrados e, para cada um, verifica se
    // o email e a senha são os mesmos dos obtidos pelo $_POST, informado no formulário de login
    foreach($usuarios_app as $user) {
        if($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']) {
            $usuario_autenticado = true;
            $usuario_id = $user['id'];
            $usuario_perfil_id = $user['perfil_id'];
            $usuario_nome_login = $user['login_user'];
        }
    
    }

    //se o usuário foi autenticado com sucesso,
    //salva em variáveis de sessão as informações do usuário
    if($usuario_autenticado) {
        $_SESSION['id'] = $usuario_id;
        $_SESSION['autenticado'] = 'SIM';
        $_SESSION['perfil_id'] = $usuario_perfil_id;
        $_SESSION['login_user'] = $usuario_nome_login;
        header('Location: ../home.php');
    } else {
        $_SESSION['autenticado'] = 'NAO';
        header('Location: ../index.php?login=erro');
    }

