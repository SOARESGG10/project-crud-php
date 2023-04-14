<?php

session_start();
require_once 'actions/AutoLoad.php';

$crud = new ContatoDAO(); 
$contacts = $crud->read(); 

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp"
      crossorigin="anonymous"
    />
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
      crossorigin="anonymous"
    ></script>
    <title>Agenda | CRUD</title>
  </head>
  <body>
    <div
      class="modal fade"
      id="create-contact"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div>
                <h1 class="text-center py-3">Crie um Contato</h1>

                <form action="" method="post">
                  <div class="mb-3">
                    <label class="form-label" for="">Nome: </label>
                    <input
                      class="form-control"
                      type="text"
                      name="name"
                      id="name"
                      placeholder="Infome o nome do contato"
                      required
                      maxlength="45"/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="">E-mail: </label>
                    <input
                      class="form-control"
                      type="email"
                      name="email"
                      id="email"
                      placeholder="Infome o e-mail do contato"
                      required
                      maxlength="45"/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="">Telefone: </label>
                    <input
                      class="form-control"
                      type="tel"
                      name="phone"
                      id="phone"
                      placeholder="Infome o telefone do contato"
                      maxlength="15"/>
                  </div>
                  <div class="mb-3">
                    <button
                      class="btn btn-outline-primary btn-sm w-100"
                      name="submit">
                      Cadastrar
                    </button>
                  </div>
                </form>

      <?php

      session_destroy();
      
      if (isset($_POST["submit"])):
      
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $contact = new Contato($name, $email, $phone);
        $crud = new ContatoDAO();
    
        if ($crud->create($contact)):              
          $_SESSION['success'] = "Contato criado com sucesso";
          header("Location: index.php");
          endif;
      endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="p-5 text-center">
      <h1 class="title text-center p-2">Contatos</h1>
      <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#create-contact">
        Criar novo contato
      </button>

      <?php if($_SESSION["success"]): ?>
      <div class="p-4">
        <div class="alert alert-success text-center" role="alert">
          <?php echo $_SESSION['success']?>
        </div>
      </div>
      
      <?php endif; ?>

      <?php if($contacts): ?>
      
      <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">Telefone</th>
              <th colspan="2" scope="col">Operação</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($contacts as $contact) { ?>
            <tr>
              <td><?php echo $contact["name"] ?></td>
              <td><?php echo $contact["email"] ?></td>
              <td><?php echo $contact["phone"] ?></td>
              <td class="p-2">
                <a type="button" 
                href="<?php echo 'updateContact.php?id='.$contact["id"] ?>" 
                class="btn btn-warning"
                id="edit-action" 
                name="edit-action">
                Editar
              </a>

                <a type="button"
                class="btn btn-danger" 
                href="<?php echo 'deleteContact.php?id='.$contact["id"] ?>">
                Apagar
              </a>
              </td>
              <?php } ?>
            </tr>
          </tbody>
        </table>
      </div>

      <?php else: ?>

        <div class="p-3">
          <h3 class="text-danger">📠 | Não existe contatos cadastrados</h3>
        </div>

      <?php endif; ?>
    </div>
  </body>
</html>
