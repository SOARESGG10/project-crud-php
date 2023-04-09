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
    <div class="w-0 mb-2">

    <h1 class="text-center py-3">Procure um Contato</h1>

    <form action="searchContact.php" method="post">
          <div class="mb-3">
                  <input class="form-control text-center" type="number" name="id" id="id" placeholder="Infome um ID" min="1">
              </div>
              <div class="mb-3">
              <button class="btn btn-outline-primary btn-sm w-100" name="submit" type="submit">Procurar</button>
          </div>
      </form>

<?php 

    if (isset($_POST["submit"])) {

      $id = $_POST["id"];

      if (!empty($id)) {
        $crud = new ContatoDAO();
        $data = $crud->read($id);

        if ($data === null) { ?>

          <div class="alert alert-danger text-center" role="alert">
            Não existe um registro com esse ID
        </div>
        
        <?php
        } else {   
?>

  <div class="p-2">
    <h1 class="title text-center p-2">Registro</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Telefone</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $data["name"] ?></td>
            <td><?php echo $data["email"] ?></td>
            <td><?php echo $data["phone"] ?></td>
          </tr>
      </tbody>
    </table>
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