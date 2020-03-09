
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Novo Usuário</title>
    
<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-white">
    <img src="<?php echo base_url('assets/img/logo_ifnmg.jpg');?>" width=”20px” height=”40px”>
  <br>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="#">Home</a> 
      <a class="nav-item nav-link" href="#">Ajuda</a>
      <a class="nav-item nav-link" href="#">Sobre</a>
    </div>
  </div>
    <button type="button" class="col-lg-1 btn btn-outline-danger btn-sm float-right">Logar</button>
    <p>
      <div class="col-auto">
      </div>
    </p>
    <button type="button" class="col-lg-1 btn btn-outline-success btn-sm float-right">Cadastrar</button>
    
  </nav>
  <br>
  <hr>
  <br>
      <div class="float-right col-lg-5">
        <img src="<?php echo base_url('assets/img/logo.png');?>" width=”20%” height=”40%”>
      </div>
    <div class="col-md-8 order-md-1">



    <div class="accordion" id="accordionExample">
      <div class="card bg-white">
        <div class="card-header" id="headingOne">

      <form class="needs-validation form-group" novalidate>
        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-5 mb-3">
            <label for="sobre_nome">Sobre nome</label>
            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="data_de_nascimento">Data de Nascimento</label>
            <input type="date" class="form-control" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-5 mb-3">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10 mb-2">
            <label for="campus">Campus</label>
            <select class="custom-select">
              <option selected>Selecione</option>
              <option value="1">Intituto Federal do Norte de Minas Gerais Campus Arinos</option>
              <option value="2">Intituto Federal do Norte de Minas Gerais Campus Januária</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-10 mb-2">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="@aluno.ifnmg.edu.br">
            <div class="invalid-feedback">
              Please enter a valid email address for shipping updates.
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-5 mb-3">
            <label for="repetir_senha">Repetir Senha</label>
            <input type="password" class="form-control" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>
    


        
        <hr class="mb-4">
        <div class="row">
          <div class="col-md-6 mb-3">
            <button class="btn btn-success btn-lg" type="submit">Salvar</button>
            <button class="btn btn-danger btn-lg" type="submit">Cancelar</button>
          </div>  
        </div>
      </form>
      </div>
      </div>
      </div>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2020 Code System</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
        <script src="form-validation.js"></script></body>
</html>
