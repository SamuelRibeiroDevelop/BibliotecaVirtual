<?php

require_once "banco/connection.php";

session_start();
$login = $_POST['login'];
$passwd = $_POST['password'];
$id = null;
$nome = null;
$cpf = null;
$telefone = null;
$email = null;
$endereco = null;
$cidade = null;
$uf = null;
$loginDB = null;
$pass = null;
$tipo = null;

try {
    global $pdo;
    $statement = $pdo->prepare("SELECT idUsuario, cpf, telefone, email, endereco, cidade, uf, login, senha, tipo FROM usuario WHERE login = :login and senha = :pass; ");
    $statement->bindValue(":login", $login);
    $statement->bindValue(":pass", sha1($passwd));
    if ($statement->execute()) {
        $rs = $statement->fetch(PDO::FETCH_OBJ);

        $id = $rs->idUsuario;
        $nome = $rs->nome;
        $cpf = $rs->cpf;
        $telefone = $rs->telefone;
        $email = $rs->email;
        $endereco = $rs->endereco;
        $cidade = $rs->cidade;
        $uf = $rs->uf;
        $loginDB = $rs->login;
        $pass = $rs->senha;
        $tipo = $rs->tipo;

        if( $loginDB != null and $pass != null)
        {
            $_SESSION['id'] = $id;
            $_SESSION['nome'] = $nome;
            $_SESSION['cpf'] = $cpf;
            $_SESSION['telefone'] = $telefone;
            $_SESSION['email'] = $email;
            $_SESSION['endereco'] = $endereco;
            $_SESSION['cidade'] = $cidade;
            $_SESSION['uf'] = $uf;
            $_SESSION['login'] = $loginDB;
            $_SESSION['senha'] = $pass;
            $_SESSION['tipo'] = $tipo;

            header('location:index.php');
        }
        else{
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
            echo "<script> alert('Usuario ou Senha incorretos !'); </script>";

            header('location:index.php');

        }
    } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
    }
} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
}

?>