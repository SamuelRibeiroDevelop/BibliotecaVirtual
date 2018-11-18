<?php
/**
 * Created by PhpStorm.
 * User: aluno
 * Date: 05/11/2018
 * Time: 19:25
 */

require_once "banco/connection.php";
require_once "classes/categoria.php";

class categoriaDAO
{
    public function remover($categoria)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM categoria WHERE idCategoria = :id");
            $statement->bindValue(":id", $categoria->getId());
            if ($statement->execute()) {
                return "<script> alert('Registo foi excluído com êxito !'); </script>";
            } else {
                throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function salvar($categoria)
    {
        global $pdo;
        try {
            if ($categoria->getId() != "") {
                $statement = $pdo->prepare("UPDATE categoria SET nome=:nome, esta_ativo=:esta_ativo, descricao=:descricao WHERE idCategoria = :id;");
                $statement->bindValue(":id", $categoria->getId());
            } else {
                $statement = $pdo->prepare("INSERT INTO categoria (nome, esta_ativo, descricao) VALUES (:nome, :esta_ativo, :descricao) ");
            }
            $statement->bindValue(":nome", $categoria->getNome());
            $statement->bindValue(":esta_ativo", $categoria->getEstaAtivo());
            $statement->bindValue(":descricao", $categoria->getDescricao());

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

    public function atualizar($categoria)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT idCategoria, nome, esta_ativo, descricao FROM categoria WHERE idCategoria = :id");
            $statement->bindValue(":id", $categoria->getId());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $categoria->setId($rs->idCategoria);
                $categoria->setNome($rs->nome);
                $categoria->setEstaAtivo($rs->esta_ativo);
                $categoria->setDescricao($rs->descricao);
                return $categoria;
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
        $sql = "SELECT idCategoria, nome, esta_ativo, descricao FROM categoria LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);

        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM categoria";
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
     <table class='table table-striped table-bordered'>
     <thead>
       <tr style='text-transform: uppercase;' class='active'>
        <th style='text-align: center; font-weight: bolder;'>ID</th>
        <th style='text-align: center; font-weight: bolder;'>Nome</th>
        <th style='text-align: center; font-weight: bolder;'>Está ativo?</th>
        <th style='text-align: center; font-weight: bolder;'>Descrição</th>
        <th style='text-align: center; font-weight: bolder;' colspan='2'>Ações</th>
       </tr>
     </thead>
     <tbody>";
            foreach ($dados as $categoria):
                echo "<tr>
        <td style='text-align: center'>$categoria->idCategoria</td>
        <td style='text-align: center'>$categoria->nome</td>
        <td style='text-align: center'>$categoria->esta_ativo</td>
        <td style='text-align: center'>$categoria->descricao</td>
        <td style='text-align: center'><a href='?act=upd&id=$categoria->idCategoria' title='Alterar'><i class='fa-rotate-right'></i></a></td>
        <td style='text-align: center'><a href='?act=del&id=$categoria->idCategoria' title='Remover'><i class='fa-times'></i></a></td>
       </tr>";
            endforeach;
            echo "
</tbody>
     </table>

    <div class='box-paginacao' style='text-align: center'>
       <a class='box-navegacao  $exibir_botao_inicio' href='$endereco?page=$primeira_pagina' title='Primeira Página'> Primeira  |</a>
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