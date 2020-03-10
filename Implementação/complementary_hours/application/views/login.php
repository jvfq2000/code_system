
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Login</title>

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
    
    <link href="floating-labels.css" rel="stylesheet">
  </head>
  <body>
  <div class="col-12">
  <br>
  <br>
  <div class="accordion" id="accordionExample">

    <div class="card-header rounded mx-auto col-4" id="headingOne">
    <img src="<?php echo base_url('assets/img/logo_complementary_hours.png');?>" class="rounded mx-auto d-block"/>
  <form>
      <div class="row">
        <div class="col-md-12 mb-2">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" placeholder="email@example.com">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-2">
          <label for="senha">Senha</label>
          <input type="password" class="form-control" id="senha" placeholder="Password">
        </div>
      </div>
      <br>
      <div class="form-group">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="dropdownCheck">
          <label class="form-check-label" for="dropdownCheck">
            Remember me
          </label>
          <a class="float-right text-dark" href="#">Esqueceu a senha?</a>
        </div>
      </div>
      <br>
      <button type="submit" class="rounded mx-auto d-block btn btn-primary col-6">Login</button>
  </form>
  <br>
  <a class="text-center rounded mx-auto d-block col-12 text-dark" href="<?php echo base_url('cadastro')?>">Novo por aqui? Cadastre-se!</a>
  </div>
  
  </div>
  
  </div>
  
  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2020 Code System</p>
  </footer>
</body>
</html>
