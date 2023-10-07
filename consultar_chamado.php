<?php require_once "./components/validador/validador_acesso.php"; ?>

<?php

    //chamados
    $chamados = array();

    //abrir o arquivo .hd
    $arquivo = fopen('../../php-app--help-desk/arquivo.hd', 'r');

    //enquanto houver registros (linhas) a serem recuperados
    while( !feof( $arquivo ) ) { //testa pelo fim de um arquivo
        //linhas
        $registro   = fgets($arquivo);
        $chamado_dados = explode('#', $registro);

        if(count($chamado_dados) < 4) {
          continue;
        }

        if($_SESSION['perfil_id'] == 1) {

          $chamados[] = $chamado_dados;
       
        } elseif($_SESSION['perfil_id'] == 2) {

          //so vamos exibir o chamado, se ele foi criado pelo usuario
          if($_SESSION['id'] != $chamado_dados[0]) {
            continue;
          }

          $chamados[] = $chamado_dados;

        }
    }

    //fechar o arquivo aberto
    fclose($arquivo);

?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="home.php">
        <img src="./img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
      <?php include("./components/logoff/sair.php"); ?>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            
            <div class="card-body">

              <?php foreach($chamados as $chamado) { ?>
                
                <div class="card mb-3 bg-light">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $chamado[1]; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $chamado[2]; ?></h6>
                    <p class="card-text"><?php echo $chamado[3]; ?></p>

                  </div>
                </div>

              <?php } ?>

              <div class="row mt-5">
                <div class="col-6">
                  <a class="btn btn-lg btn-warning btn-block" href="home.php">Voltar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>