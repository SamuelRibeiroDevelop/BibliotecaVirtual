<?php
/**
 * Created by PhpStorm.
 * User: samue
 * Date: 15/11/2018
 * Time: 15:14
 */

require_once "classes/template.php";

require_once "dao/usuarioDAO.php";
require_once "classes/usuario.php";

$object = new usuarioDAO();

$template = new Template();

$template->head();
$template->navbartop();
$template->sidebar();

$typeUser = $_SESSION['typeUser'];
$erro = false;

//tipo: 0:Adm, 1:User
//Se o tipo for diferente de Adm e for digitado o endereço no browse, redireciona o usuario para o index.
if($typeUser != 0){
     echo "<script>script:window.open('index.php', '_self');</script>";
}
// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $cpf = (isset($_POST["cpf"]) && $_POST["cpf"] != null) ? $_POST["cpf"] : "";
    $telefone = (isset($_POST["telefone"]) && $_POST["telefone"] != null) ? $_POST["telefone"] : "";
    $email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
    $endereco = (isset($_POST["endereco"]) && $_POST["endereco"] != null) ? $_POST["endereco"] : "";
    $cidade = (isset($_POST["cidade"]) && $_POST["cidade"] != null) ? $_POST["cidade"] : "";
    $uf = (isset($_POST["uf"]) && $_POST["uf"] != null) ? $_POST["uf"] : "";
    $login = (isset($_POST["login"]) && $_POST["login"] != null) ? $_POST["login"] : "";
    $senha = (isset($_POST["senha"]) && $_POST["senha"] != null) ? $_POST["senha"] : "";
    $tipo = (isset($_POST["tipo"]) && $_POST["tipo"] != null) ? $_POST["tipo"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = null;
    $cpf = null;
    $telefone = null;
    $email = null;
    $endereco = null;
    $cidade = null;
    $uf = null;
    $login = null;
    $senha = null;
    $tipo = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {

    $user = new usuario($id, '','','','','','','','','','');

    $resultado = $object->atualizar($user);
    $nome = $resultado->getNome();
    $cpf = $resultado->getCpf();
    $telefone = $resultado->getTelefone();
    $email = $resultado->getEmail();
    $endereco = $resultado->getEndereco();
    $cidade = $resultado->getCidade();
    $uf = $resultado->getUf();
    $login = $resultado->getLogin();
    $senha = $resultado->getSenha();
    $tipo = $resultado->getTipo();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "" && $cpf != "" && $telefone != "" && $email != "" && $endereco != "" && $cidade != "" && $uf != "" && $login != "" && $senha != "" && $tipo != "")
{
    $user = new usuario($id, $nome, $cpf, $telefone, $email, $endereco, $cidade, $uf, $login, $senha, $tipo);
    $msg = $object->salvar($user);
    $id = null;
    $nome = null;
    $cpf = null;
    $telefone = null;
    $email = null;
    $endereco = null;
    $cidade = null;
    $uf = null;
    $login = null;
    $senha = null;
    $tipo = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $user = new usuario($id, '','','','','','','','','','');

    $msg = $object->remover($user);
    $id = null;
}

if((! isset($nome) || !is_string($nome)) && !$erro){
    $erro = 'O campo "Nome" contém valores não válidos';
}

if((! isset($cpf) || !is_string($cpf)) && !$erro){
    $erro = 'O campo "CPF" contém valores não válidos';
}

if((! isset($telefone) || !is_string($telefone)) && !$erro){
    $erro = 'O campo "Telefone" contém valores não válidos';
}

if((! isset($email) || !is_string($email)) && !$erro){
    $erro = 'O campo "Email" contém valores não válidos';
}

if((! isset($endereco) || !is_string($endereco)) && !$erro){
    $erro = 'O campo "Endereço" contém valores não válidos';
}

if((! isset($cidade) || !is_string($cidade)) && !$erro){
    $erro = 'O campo "Cidade" contém valores não válidos';
}

if((! isset($uf) || !is_string($uf)) && !$erro){
    $erro = 'O campo "UF" contém valores não válidos';
}

if((! isset($login) || !is_string($login)) && !$erro){
    $erro = 'O campo "Login" contém valores não válidos';
}

if((! isset($senha) || !is_string($senha)) && !$erro){
    $erro = 'O campo "Senha" contém valores não válidos';
}


?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-user fa-fw"></i> Área Usuários </h1>
            <div class='content table-responsive'>
                <?php
                if($typeUser == 1){
                    $object->tabelapaginada();
                }
                ?>
                <form action="?act=save&id=" method="POST" name="form1">

                    <input type="hidden" name="id" value="<?php
                    // Preenche o id no campo id com um valor "value"
                    echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                    ?>"/>
                    <br/>
                    <Laber>Nome:</Laber>
                    <input class="form-control" type="<?php echo ($typeUser == 0) ? 'text' : 'hidden' ?>" size="100" required name="nome" value="<?php
                    // Preenche o nome no campo nome com um valor "value"
                    echo (isset($nome) && ($nome != null || $nome != "")) ? $nome : '';
                    ?>"/>
                    <br/>

                    <Laber>CPF:</Laber>
                    <input class="form-control" type="<?php echo ($typeUser == 0) ? 'text' : 'hidden' ?>" size="15" required name="cpf" value="<?php
                    // Preenche o nome no campo nome com um valor "value"
                    echo (isset($cpf) && ($cpf != null || $cpf != "")) ? $cpf : '';
                    ?>"/>
                    <br/>

                    <Laber>Telefone:</Laber>
                    <input class="form-control" type="<?php echo ($typeUser == 0) ? 'text' : 'hidden' ?>" size="15" required name="telefone" value="<?php
                    // Preenche o nome no campo nome com um valor "value"
                    echo (isset($telefone) && ($telefone != null || $telefone != "")) ? $telefone : '';
                    ?>"/>
                    <br/>

                    <Laber>Email</Laber>
                    <input class="form-control" type="<?php echo ($typeUser == 0) ? 'email' : 'hidden' ?>" size="100" required name="email" value="<?php
                    // Preenche o nome no campo nome com um valor "value"
                    echo (isset($email) && ($email != null || $email != "")) ? $email : '';
                    ?>" required/>
                    <br/>

                    <Laber>Endereço:</Laber>
                    <input class="form-control" type="<?php echo ($typeUser == 0) ? 'text' : 'hidden' ?>" size="100" required placeholder="Digite seu endereço contendo rua, número e bairro ..." name="endereco" value="<?php
                    // Preenche o nome no campo nome com um valor "value"
                    echo (isset($endereco) && ($endereco != null || $endereco != "")) ? $endereco : '';
                    ?>" required/>
                    <br/>

                    <Laber>Cidade:</Laber>
                    <input class="form-control" type="<?php echo ($typeUser == 0) ? 'text' : 'hidden' ?>" size="45" required name="cidade" value="<?php
                    // Preenche o nome no campo nome com um valor "value"
                    echo (isset($cidade) && ($cidade != null || $cidade != "")) ? $cidade : '';
                    ?>" required/>
                    <br/>

                    <Laber>UF:</Laber>
                    <select class="form-control" name="uf" required>
                        <option>--Selecione--</option>
                        <option>AC</option>
                        <option>AL</option>
                        <option>AM</option>
                        <option>AP</option>
                        <option>BA</option>
                        <option>CE</option>
                        <option>DF</option>
                        <option>ES</option>
                        <option>GO</option>
                        <option>MA</option>
                        <option>MG</option>
                        <option>MS</option>
                        <option>MT</option>
                        <option>PA</option>
                        <option>PB</option>
                        <option>PE</option>
                        <option>PI</option>
                        <option>PR</option>
                        <option>RJ</option>
                        <option>RN</option>
                        <option>RS</option>
                        <option>RO</option>
                        <option>RR</option>
                        <option>SC</option>
                        <option>SE</option>
                        <option>SP</option>
                        <option>TO</option>
                    </select>
                    <br/>

                    <Laber>Login:</Laber>
                    <input class="form-control" type="<?php echo ($typeUser == 0) ? 'text' : 'hidden' ?>" size="10" name="login" required value="<?php
                    // Preenche o nome no campo nome com um valor "value"
                    echo (isset($login) && ($login != null || $login != "")) ? $login : '';
                    ?>" required/>
                    <br/>

                    <Laber>Senha:</Laber>
                    <input class="form-control" type="<?php echo ($typeUser == 0) ? 'text' : 'hidden' ?>" size="10" name="senha" required value="<?php
                    // Preenche o sigla no campo sigla com um valor "value"
                    //echo (isset($senha) && ($senha != null || $senha != "")) ? $senha : '';
                    ?>" required/>
                    <br/>

                    <Laber>Tipo:</Laber>
                    <?php
                    if($typeUser == 0){
                        echo "<select class='form-control' name='tipo' required>
                                    <option value='1'";
                        if(isset($tipo) && ($tipo != null || $tipo != ""))
                            echo (($tipo == 1) ? ' selected' : '');
                        echo ">Aluno</option>";
                        echo "<option value='1'";
                        if (isset($tipo) && ($tipo != null || $tipo != ""))
                            echo (($tipo == 1) ? 'selected' : '');
                            echo ">Professor</option>";
                        echo "<option value='0'";
                        if (isset($tipo) && ($tipo != null || $tipo != ""))
                            echo (($tipo == 0) ? 'selected' : '');
                        echo ">Funcionário</option>";
                        echo "<option value='0'";
                        if (isset($tipo) && ($tipo != null || $tipo != ""))
                            echo (($tipo == 0) ? 'selected' : '');
                        echo ">Bibliotecário</option>";
                        echo "<option value='0'";
                        if(isset($tipo) && ($tipo != null || $tipo != ""))
                            echo (($tipo == 0) ? ' selected' : '');
                        echo ">Gerente</option></select>";
                    }
                    ?>

                    <br/>
                    <input class="btn btn-success" type="<?php echo ($typeUser == 0) ? 'submit' : 'hidden' ?>" value="Gravar">
                    <hr>
                </form>
                <?php
                if($typeUser == 0){
                    echo (isset($msg) && ($msg != null || $msg != "")) ? $msg : '';
                    //chamada a paginação
                    $object->tabelapaginada();
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
$template->footer();
?>
