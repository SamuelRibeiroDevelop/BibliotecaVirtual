<?php
/**
 * Created by PhpStorm.
 * User: samue
 * Date: 15/11/2018
 * Time: 15:14
 */

require_once "classes/template.php";

require_once "dao/exemplarDAO.php";
require_once "classes/exemplar.php";

$object = new exemplarDAO();

$template = new Template();

$template->head();
$template->navbartop();
$template->sidebar();

$erro = false;

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $fornecedor = (isset($_POST["fornecedor"]) && $_POST["fornecedor"] != null) ? $_POST["fornecedor"] : "";
    $doador = (isset($_POST["doador"]) && $_POST["doador"] != null) ? $_POST["doador"] : "";
    $situacao = (isset($_POST["situacao"]) && $_POST["situacao"] != null) ? $_POST["situacao"] : "";
    $localizacao = (isset($_POST["localizacao"]) && $_POST["localizacao"] != null) ? $_POST["localizacao"] : "";
    $data_cadastro = (isset($_POST["data_cadastro"]) && $_POST["data_cadastro"] != null) ? $_POST["data_cadastro"] : "";
    $preco = (isset($_POST["preco"]) && $_POST["preco"] != null) ? $_POST["preco"] : "";
    $tipo = (isset($_POST["tipo"]) && $_POST["tipo"] != null) ? $_POST["tipo"] : "";
    $qtd_disponivel= (isset($_POST["qtd_disponivel"]) && $_POST["qtd_disponivel"] != null) ? $_POST["qtd_disponivel"] : "";
    $livro_idLivro = (isset($_POST["livro_idLivro"]) && $_POST["livro_idLivro"] != null) ? $_POST["livro_idLivro"] : "";
    $download = (isset($_POST["download"]) && $_POST["download"] != null) ? $_POST["download"] : "";

} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $fornecedor = NULL;
    $doador = NULL;
    $situacao = NULL;
    $localizacao = NULL;
    $data_cadastro = NULL;
    $preco = NULL;
    $tipo = NULL;
    $qtd_disponivel = NULL;
    $livro_idLivro = NULL;
    $download = NULL;

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $exemplar = new exemplar($id,'','','','','','','','','','');

    $resultado = $object->atualizar($exemplar);
    $fornecedor = $resultado->getFornecedor();
    $doador = $resultado->getDoador();
    $situacao = $resultado->getSituacao();
    $localizacao = $resultado->getLocalizacao();
    $data_cadastro = $resultado->getDataCadastro();
    $preco = $resultado->getPreco();
    $tipo = $resultado->getTipo();
    $qtd_disponivel = $resultado->getQtdDisponivel();
    $livro_idLivro = $resultado->getLivroIdLivro();
    $download = $resultado->getDownload();

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $fornecedor != "" && $doador != "" && $situacao != "" && $localizacao != "" && $data_cadastro != "" && $preco != "" && $tipo != "" && $qtd_disponivel != "" && $livro_idLivro != "" && $download != "") {
    $exemplar = new exemplar($id, $fornecedor, $doador, $situacao, $localizacao, $data_cadastro, $preco, $tipo, $qtd_disponivel, $livro_idLivro, $download);
    $msg = $object->salvar($exemplar);
    $id = null;
    $fornecedor = null;
    $doador = null;
    $situacao = null;
    $localizacao = null;
    $data_cadastro = null;
    $preco = null;
    $tipo = null;
    $qtd_disponivel = null;
    $livro_idLivro = null;
    $download = null;

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $exemplar = new exemplar($id, '', '','','','','','','','','');
    $msg = $object->remover($exemplar);
    $id = null;
}

if((! isset($data_cadastro) || !is_string($data_cadastro)) && !$erro){
    $erro = 'O campo "Data de Cadastro" contém valores não válidos';
}

if((! isset($tipo) || !is_string($tipo)) && !$erro){
    $erro = 'O campo "Tpo" contém valores não válidos';
}

if((! isset($qtd_disponivel) || !is_numeric($qtd_disponivel)) && !$erro){
    $erro = 'O campo "Quantidade Disponível" só aceita números';
}


?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-book fa-fw"></i> Área Exemplares </h1>
            <div class='content table-responsive'>
                <form action="?act=save&id=" method="POST" name="form1">
                    <input type="hidden" name="id" value="<?php
                    echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                    ?>"/>
                    Fornecedor:
                    <input class="form-control" type="text" name="fornecedor" maxlength="100" placeholder="Se houver doador, não fornecer registro aqui ..." value="<?php
                    // Preenche o nome no campo nome com um valor "value"
                    echo (isset($fornecedor) && ($fornecedor != null || $fornecedor != "")) ? $fornecedor: '';
                    ?>"/>
                    <br/>
                    Doador:
                    <input class="form-control" type="text" maxlength="100" name="doador" placeholder="Se houver fornecedor, não fornecer registro aqui ..." value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($doador) && ($doador != null || $doador != "")) ? $doador : '';
                    ?>"/>
                    <br/>
                    Situação:
                    <input class="form-control" type="text" maxlength="45" name="situacao" placeholder="Está novo, estragado, rasgado, velho, conservado, etc ..." value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($situacao) && ($situacao != null || $situacao != "")) ? $situacao : '';
                    ?>"/>
                    <br/>
                    Localização:
                    <input class="form-control" type="text" maxlength="45" name="localizacao" placeholder="Está disponível ou emprestado? ..." value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($localizacao) && ($localizacao != null || $localizacao != "")) ? $localizacao : '';
                    ?>"/>
                    <br/>
                    Data de Cadastro:
                    <input class="form-control" type="text" maxlength="10" name="data_cadastro" required placeholder="dd/MM/yyyy" value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($data_cadastro) && ($data_cadastro != null || $data_cadastro != "")) ? $data_cadastro : '';
                    ?>"/>
                    <br/>
                    Preço:
                    <input class="form-control" type="numeric" name="preco" placeholder="Se não foi doado, forneça o preço ..." value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($preco) && ($preco != null || $preco != "")) ? $preco : '';
                    ?>"/>
                    <br/>
                    Tipo:
                    <input class="form-control" type="text" maxlength="45" name="tipo" required placeholder="Físico ou virtual ..." value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($tipo) && ($tipo != null || $tipo != "")) ? $tipo : '';
                    ?>"/>
                    <br/>
                    Quantidade Disponível:
                    <input class="form-control" type="numeric" name="qtd_disponivel" required value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($qtd_disponivel) && ($qtd_disponivel != null || $qtd_disponivel != "")) ? $qtd_disponivel : '';
                    ?>"/>
                    <br/>
                    Livro:
                    <select class="form-control" required name="livro_idLivro">
                        <?php
                        $query = "SELECT * FROM livro order by titulo;";
                        $statement = $pdo->prepare($query);
                        if ($statement->execute()) {
                            $result = $statement->fetchAll(PDO::FETCH_OBJ);
                            foreach ($result as $rs) {
                                if ($rs->idLivo == $livro_idLivro) {
                                    echo "<option value='$rs->idLivro' selected>$rs->titulo</option>";
                                } else {
                                    echo "<option value='$rs->idLivro'>$rs->titulo</option>";
                                }
                            }
                        } else {
                            throw new PDOException("<script> alert('Não foi possível executar a declaração SQL !'); </script>");
                        }
                        ?>
                    </select>
                    <br/>
                    Download:
                    <input class="form-control" type="text" maxlength="45" name="tipo" placeholder="Físico ou virtual ..." value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($download) && ($download != null || $download != "")) ? $download : '';
                    ?>"/>
                    <br/>
                    <input class="btn btn-success" type="submit" value="Gravar">
                    <hr>
                </form>
                <?php
                echo (isset($msg) && ($msg != null || $msg != "")) ? $msg : '';
                //chamada a paginação
                $object->tabelapaginada();
                ?>
            </div>
        </div>
    </div>
</div>

<?php
$template->footer();
?>
