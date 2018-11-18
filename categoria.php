<?php
/**
 * Created by PhpStorm.
 * User: samue
 * Date: 15/11/2018
 * Time: 15:14
 */

require_once "classes/template.php";

require_once "dao/categoriaDAO.php";
require_once "classes/categoria.php";

$object = new categoriaDAO();

$template = new Template();

$template->head();
$template->navbartop();
$template->sidebar();

$erro = false;

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $esta_ativo = (isset($_POST["esta_ativo"]) && $_POST["esta_ativo"] != null) ? $_POST["esta_ativo"] : "";
    $descricao = (isset($_POST["descricao"]) && $_POST["descricao"] != null) ? $_POST["descricao"] : "";

} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $esta_ativo= NULL;
    $descricao = NULL;

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $categoria = new categoria($id,'','','');

    $resultado = $object->atualizar($categoria);
    $nome= $resultado->getNome();
    $esta_ativo= $resultado->getEstaAtivo();
    $descricao = $resultado->getDescricao();

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "" && $esta_ativo!= "" && $descricao != "") {
    $categoria = new categoria($id, $nome, $esta_ativo, $descricao);
    $msg = $object->salvar($categoria);
    $id = null;
    $nome = null;
    $esta_ativo = null;
    $descricao = null;

}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $categoria = new categoria($id, '', '','');
    $msg = $object->remover($categoria);
    $id = null;
}


if((! isset($nome) || !is_string($nome)) && !$erro){
    $erro = 'O campo "Nome" contém valores não válidos';
}

if((! isset($esta_ativo) || !is_string($esta_ativo)) && !$erro){
    $erro = 'O campo "Está ativo" contém valores não válidos';
}

if((! isset($descricao) || !is_string($descricao)) && !$erro){
    $erro = 'O campo "Descrição" contém valores não válidos';
}

?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="glyphicon-book"></i> Área Categorias </h1>
            <div class='content table-responsive'>
                <form action="?act=save&id=" method="POST" name="form1">
                    <input type="hidden" name="id" value="<?php
                    echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                    ?>"/>
                    Nome:
                    <input class="form-control" type="text" name="nome" maxlength="100" required value="<?php
                    // Preenche o nome no campo nome com um valor "value"
                    echo (isset($nome) && ($nome != null || $nome != "")) ? $nome: '';
                    ?>"/>
                    <br/>
                    Está ativo: (?)
                    <input class="form-control" type="text" maxlength="3" name="esta_ativo" required placeholder="Sim ou Não" value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($esta_ativo) && ($esta_ativo != null || $esta_ativo != "")) ? $esta_ativo : '';
                    ?>"/>
                    <br/>
                    Descrição:
                    <input class="form-control" type="text" maxlength="14" name="str_cpf" required value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    echo (isset($str_cpf) && ($str_cpf != null || $str_cpf != "")) ? $str_cpf : '';
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
