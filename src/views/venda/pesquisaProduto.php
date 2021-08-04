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

<form>
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
    <input type="text" name="referencia" />

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
        foreach ($produtos->findWithFilter() as $obj) { ?>
            <tr>
                <td><?= $obj->getIdproduto() ?></td>
                <td><?= $categorias->findOne($obj->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($obj->getIdmarca())->getMarca() ?></td>
                <td><?= $obj->getReferencia() ?></td>
                <td><?= $obj->getQuantidade() ?></td>
                <td><?= $obj->getValorvenda() ?></td>
                <td><?= $localizacoes->findOne($obj->getIdlocalizacao())->getDepartamento() ?></td>
                <td>
                    <div class="button-group clear">
                        <a class="success button" href="./produto.php?id=<?= $obj->getIdproduto() ?>">Visualizar</a>
                        <a class="success button" href="./editar.php?id=<?= $obj->getIdproduto() ?>">Editar</a>
                        <a class="alert button" href="#" onclick="deletar('<?= $obj->getIdproduto() ?>', '<?= $obj->getIdproduto() ?>')">Apagar</a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>