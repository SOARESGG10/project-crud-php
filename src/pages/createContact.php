<?php
function autoload($className){ require "../$className.php"; }
spl_autoload_register('autoload');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  <title>Agenda | Criar contato</title>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../index.php">Página inicial</a>
          </li>
        </ul>
      </div>
    </div>
</nav>

  <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="w-25 mb-2">

    <h1 class="text-center py-3">Crie um Contato</h1>

      <form action="createContact.php" method="post">
          <div class="mb-3">
                  <label class="form-label" for="">Nome: </label>
                  <input class="form-control" type="text" name="name" id="name" placeholder="Infome o nome do contato">
              </div>
              <div class="mb-3">
                  <label class="form-label" for="">E-mail: </label>
                  <input class="form-control" type="email" name="email" id="email" placeholder="Infome o e-mail do contato">
              </div>
              <div class="mb-3">
                  <label class="form-label" for="">Telefone: </label>
                  <input class="form-control" type="text" name="phone" id="phone" placeholder="Infome o telefone do contato">
              </div>
              <div class="mb-3">
              <button class="btn btn-outline-primary btn-sm w-100" name="submit" type="submit">Cadastrar</button>
          </div>
      </form>

      <?php
      
      if (isset($_POST["submit"])) {
      
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
    
        if (!empty($name) && !empty($email)) {
        $contact = new Contato($name, $email, $phone);
        $crud = new ContatoDAO();
    
        if ($crud->create($contact)) { ?>
          <div class="alert alert-success text-center" role="alert">
            Contato criado com sucesso
          </div>
        <?php
        }
        } else { ?>
          <div class="alert alert-danger text-center" role="alert">
            Preencha todos os campos
          </div>
        <?php
        }     
      }
      ?>

    </div>
  </div>
</body>
</html>