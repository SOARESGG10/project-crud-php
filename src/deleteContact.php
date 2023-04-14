<?php

require_once 'actions/AutoLoad.php';
session_start();

$id = $_GET['id'];

$crud = new ContatoDAO();

if ($crud->delete($id)):

    $_SESSION['success'] = "Contado deletado com sucesso";
    header("Location: index.php");

endif;


?>