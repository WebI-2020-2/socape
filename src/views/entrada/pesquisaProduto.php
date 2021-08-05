<?php
require_once __DIR__ . '/../../controller/ProdutosController.php';
$produtos = new ProdutosController();

require_once __DIR__ . '/../../controller/MarcasController.php';
$marcas = new MarcasController();

require_once __DIR__ . '/../../controller/CategoriaController.php';
$categorias = new CategoriaController();

require_once __DIR__ . '/../../controller/LocalizacaoController.php';
$localizacoes = new LocalizacaoController();

require_once __DIR__ . '/../../controller/ValvulasController.php';
$valvulas = new ValvulasController();

require_once __DIR__ . '/../../controller/FabricacaoController.php';
$fabricacoes = new FabricacaoController();

require_once __DIR__ . '/../../controller/CarrosController.php';
$carros = new CarroController();

require_once __DIR__ . '/../../controller/MotorController.php';
$motores = new MotorController();
?>

<script>
    function refreshParent(idproduto) {
        window.close();
        window.opener.location.href = "./inserirItensEntrada.php?identrada=<?= $_GET['identrada'] ?>&idproduto=" + idproduto;
    }
</script>

<form method="post" action="">
    <label>Motor:</label>
    <select name="idmotor">
        <option selected disabled>Selecione</option>
        <?php
        foreach ($motores->findAll() as $obj) { ?>
            <option value="<?= $obj->getIdmotor(); ?>"><?= $obj->getPotencia() ?></option>
        <?php } ?>
    </select>

    <label>Carro:</label>
    <select name="idcarro">
        <option selected disabled>Selecione</option>
        <?php
        foreach ($carros->findAll() as $obj) { ?>
            <option value="<?= $obj->getIdcarro(); ?>"><?= $obj->getModelo() ?></option>
        <?php } ?>
    </select>

    <label>Válvulas:</label>
    <select name="idvalvulas">
        <option selected disabled>Selecione</option>
        <?php
        foreach ($valvulas->findAll() as $obj) { ?>
            <option value="<?= $obj->getIdvalvulas(); ?>"><?= $obj->getQuantidade() ?></option>
        <?php } ?>
    </select>

    <label>Ano de fabricação:</label>
    <select name="idfabricacao">
        <option selected disabled>Selecione</option>
        <?php
        foreach ($fabricacoes->findAll() as $obj) { ?>
            <option value="<?= $obj->getIdfabricacao(); ?>"><?= $obj->getAno() ?></option>
        <?php } ?>
    </select>

    <label>Categoria:</label>
    <select name="idcategoria">
        <option selected disabled>Selecione</option>
        <?php
        foreach ($categorias->findAll() as $obj) { ?>
            <option value="<?= $obj->getIdcategoria(); ?>"><?= $obj->getCategoria() ?></option>
        <?php } ?>
    </select>

    <label>Marca:</label>
    <select name="idmarca">
        <option selected disabled>Selecione</option>
        <?php
        foreach ($marcas->findAll() as $obj) { ?>
            <option value="<?= $obj->getIdmarca(); ?>"><?= $obj->getMarca(); ?></option>
        <?php } ?>
    </select>

    <label>Localização:</label>
    <select name="idlocalizacao">
        <option selected disabled>Selecione</option>
        <?php
        foreach ($localizacoes->findAll() as $obj) { ?>
            <option value="<?= $obj->getIdlocalizacao(); ?>"><?= $obj->getDepartamento() ?></option>
        <?php } ?>
    </select>

    <label>Referência:</label>
    <input type="text" name="referencia" value="" />

    <input type="submit" value="Buscar" />
</form>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Categoria/Marca</th>
            <th scope="col">Referência</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Valor de venda</th>
            <th scope="col">Localização</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $idmotor = isset($_POST["idmotor"]) ? $_POST["idmotor"] : null;
        $idcarro = isset($_POST["idcarro"]) ? $_POST["idcarro"] : null;
        $idvalvulas = isset($_POST["idvalvulas"]) ? $_POST["idvalvulas"] : null;
        $idfabricacao = isset($_POST["idfabricacao"]) ? $_POST["idfabricacao"] : null;
        $idcategoria = isset($_POST["idcategoria"]) ? $_POST["idcategoria"] : null;
        $idmarca = isset($_POST["idmarca"]) ? $_POST["idmarca"] : null;
        $idlocalizacao = isset($_POST["idlocalizacao"]) ? $_POST["idlocalizacao"] : null;
        $referencia = isset($_POST["referencia"]) ? $_POST["referencia"] : null;

        foreach ($produtos->findWithFilter($idmotor, $idcarro, $idvalvulas, $idfabricacao, $idcategoria, $idmarca, $idlocalizacao, $referencia) as $obj) { ?>
            <tr>
                <td><?= $obj->getIdproduto() ?></td>
                <td><?= $categorias->findOne($obj->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($obj->getIdmarca())->getMarca() ?></td>
                <td><?= $obj->getReferencia() ?></td>
                <td><?= $obj->getQuantidade() ?></td>
                <td><?= $obj->getValorvenda() ?></td>
                <td><?= $localizacoes->findOne($obj->getIdlocalizacao())->getDepartamento() ?></td>
                <td>
                    <button onclick="refreshParent(<?= $obj->getIdproduto() ?>);">Selecionar</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>