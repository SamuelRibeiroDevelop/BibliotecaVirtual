<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 05/11/2018
 * Time: 19:27
 */

require_once "banco/connection.php";
require_once "classes/usuario.php";

class usuarioDAO
{
    public function remover($user)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM usuario WHERE idUsuario = :id");
            $statement->bindValue(":id", $user->getId());
            if ($statement->execute()) {
                return "<script> alert('Registo foi excluído com êxito !'); </script>";
            } else {
                throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function salvar($user)
    {
        global $pdo;
        try {
            if ($user->getId() != "") {
                $statement = $pdo->prepare("UPDATE usuario SET nome=:nome, cpf=:cpf, telefone=:telefone, email=:email, endereco=:endereco, cidade=:cidade, uf=:uf, login=:login, senha=:senha, tipo=:tipo WHERE idUsuario = :id;");
                $statement->bindValue(":id", $user->getId());
            } else {
                $statement = $pdo->prepare("INSERT INTO usuario (nome, cpf, telefone, email, endereco, cidade, uf, login, senha, tipo) VALUES (:nome, :cpf, :telefone, :email, :endereco, :cidade, :uf, :login, :senha, :tipo) ");
            }
            $statement->bindValue(":nome", $user->getNome());
            $statement->bindValue(":cpf", $user->getCpf());
            $statement->bindValue(":telefone", $user->getTelefone());
            $statement->bindValue(":email", $user->getEmail());
            $statement->bindValue(":endereco", $user->getEndereco());
            $statement->bindValue(":cidade", $user->getCidade());
            $statement->bindValue(":uf", $user->getUf());
            $statement->bindValue(":login", $user->getLogin());
            $statement->bindValue(":senha", sha1($user->getSenha()));
            $statement->bindValue(":tipo", $user->getTipo());

            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    return "<script> alert('Dados cadastrados com sucesso !'); </script>";
                } else {
                    return "<script> alert('Erro ao tentar efetivar cadastro !'); </script>";
                }
            } else {
                throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function atualizar($user)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT idUsuario, nome, cpf, telefone, email, endereco, cidade, uf, login, senha, tipo FROM usuario WHERE idUsuario = :id");
            $statement->bindValue(":id", $user->getId());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $user->setId($rs->idUsuario);
                $user->setNome($rs->nome);
                $user->setCpf($rs->cpf);
                $user->setTelefone($rs->telefone);
                $user->setEmail($rs->email);
                $user->setEndereco($rs->endereco);
                $user->setCidade($rs->cidade);
                $user->setUf($rs->uf);
                $user->setLogin($rs->login);
                $user->setSenha($rs->senha);
                $user->setTipo($rs->tipo);
                return $user;
            } else {
                throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function tabelapaginada()
    {

        //carrega o banco
        global $pdo;

        //endereço atual da página
        $endereco = $_SERVER ['PHP_SELF'];

        /* Constantes de configuração */
        define('QTDE_REGISTROS', 10);
        define('RANGE_PAGINAS', 2);

        /* Recebe o número da página via parâmetro na URL */
        $pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

        /* Calcula a linha inicial da consulta */
        $linha_inicial = ($pagina_atual - 1) * QTDE_REGISTROS;

        /* Instrução de consulta para paginação com MySQL */
        $sql = "SELECT idUsuario, nome, cpf, telefone, email, endereco, cidade, uf, login, senha, tipo FROM usuario LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);

        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM usuario";
        $statement = $pdo->prepare($sqlContador);
        $statement->execute();
        $valor = $statement->fetch(PDO::FETCH_OBJ);

        /* Idêntifica a primeira página */
        $primeira_pagina = 1;

        /* Cálcula qual será a última página */
        $ultima_pagina = ceil($valor->total_registros / QTDE_REGISTROS);

        /* Cálcula qual será a página anterior em relação a página atual em exibição */
        $pagina_anterior = ($pagina_atual > 1) ? $pagina_atual - 1 : 0;

        /* Cálcula qual será a pŕoxima página em relação a página atual em exibição */
        $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual + 1 : 0;

        /* Cálcula qual será a página inicial do nosso range */
        $range_inicial = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1;

        /* Cálcula qual será a página final do nosso range */
        $range_final = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;

        /* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */
        $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder';

        /* Verifica se vai exibir o botão "Anterior" e "Último" */
        $exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';

        if (!empty($dados)):
            echo "
     <table width='100%' class='table table-striped table-bordered table-hover'>
     <thead>
        <tr style='text-transform: uppercase;' class='active'>
        <th style='text-align: center; font-weight: bolder;'>ID</th>
        <th style='text-align: center; font-weight: bolder;'>Name</th>
        <th style='text-align: center; font-weight: bolder;'>CPF</th>
        <th style='text-align: center; font-weight: bolder;'>Telefone</th>
        <th style='text-align: center; font-weight: bolder;'>Email</th>
        <th style='text-align: center; font-weight: bolder;'>Endereço</th>
        <th style='text-align: center; font-weight: bolder;'>Cidade</th>
        <th style='text-align: center; font-weight: bolder;'>UF</th>
        <th style='text-align: center; font-weight: bolder;'>Login</th>
        <!--<th style='text-align: center; font-weight: bolder;'>Password</th> -->
        <th style='text-align: center; font-weight: bolder;'>Tipo</th>";
            if($_SESSION['tipo'] == 0){
                echo "<th style='text-align: center; font-weight: bolder;' colspan='2'>Ações</th>";
            }
            echo "</tr>
     </thead>
     <tbody>";
            foreach ($dados as $var):
                echo "<tr>
        <td style='text-align: center'>$var->idUsuario</td>
        <td style='text-align: center'>$var->nome</td>
        <td style='text-align: center'>$var->cpf</td>
        <td style='text-align: center'>$var->telefone</td>
        <td style='text-align: center'>$var->email</td>
        <td style='text-align: center'>$var->endereco</td>
        <td style='text-align: center'>$var->cidade</td>
        <td style='text-align: center'>$var->uf</td>
        <td style='text-align: center'>$var->login</td>
        <!--<td style='text-align: center'>$var->senha</td>-->
        <td style='text-align: center'>";
                echo ($var->perfil == 0)? "Adm" : "User";
                if($_SESSION['tipo'] == 0){
                    echo "</td>
            <td style='text-align: center'><a href='?act=upd&id=$var->idUsuario' title='Alterar'><i class='fa-rotate-right'></i></a></td>
            <td style='text-align: center'><a href='?act=del&id=$var->idUsuario' title='Remover'><i class='fa-times'></i></a></td>
            </tr>";

                }else{
                    echo "</tr>";
                }
            endforeach;
            echo "
</tbody>
     </table>

     <div class='box-paginacao' style='text-align: center'>
       <a class='box-navegacao  $exibir_botao_inicio' href='$endereco?page=$primeira_pagina' title='Primeira Página'> Primeiro  |</a>
       <a class='box-navegacao  $exibir_botao_inicio' href='$endereco?page=$pagina_anterior' title='Página Anterior'> Anterior  |</a>
";

            /* Loop para montar a páginação central com os números */
            for ($i = $range_inicial; $i <= $range_final; $i++):
                $destaque = ($i == $pagina_atual) ? 'destaque' : '';
                echo "<a class='box-numero $destaque' href='$endereco?page=$i'> ( $i ) </a>";
            endfor;

            echo "<a class='box-navegacao $exibir_botao_final' href='$endereco?page=$proxima_pagina' title='Próxima Página'>| Próxima  </a>
                  <a class='box-navegacao $exibir_botao_final' href='$endereco?page=$ultima_pagina'  title='Última Página'>| Última  </a>
     </div>";
        else:
            echo "<p class='bg-danger'>Nenhum registro foi encontrado!</p>
     ";
        endif;

    }
}