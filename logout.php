<?php

session_start();
unset ($_SESSION['id']);
unset ($_SESSION['nome']);
unset ($_SESSION['cpf']);
unset ($_SESSION['telefone']);
unset ($_SESSION['email']);
unset ($_SESSION['endereco']);
unset ($_SESSION['cidade']);
unset ($_SESSION['uf']);
unset ($_SESSION['login']);
unset ($_SESSION['senha']);
unset ($_SESSION['tipo']);
session_destroy();
header('location:index.php');

?>