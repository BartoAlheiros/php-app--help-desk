<?php

    session_start();

    //variavel que verifica se a autenticacao foi realizada
    $usuario_autenticado = false;

    //usuarios do sistema
    $usuarios_app = array(
        array('email' => 'admn@teste.com.br', 'senha' => '123456'),
        array('email' => 'user@teste.com.br', 'senha' => 'abcd')
    );

   /*  echo '<pre>';
    print_r($usuarios_app);
    echo '</pre>'; */
    
    foreach($usuarios_app as $user) {
        if($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']) {
            $usuario_autenticado = true;
        }
    
    }

    if($usuario_autenticado) {
        echo 'Usuário autenticado';
    } else {
        echo header('Location: index.php?login=erro');
    }

    /* print_r($_POST);
    echo '<br>';
    print_r($_POST['email']);
    echo '<br>';
    print_r($_POST['senha']);
    echo '<br>'; */

  
