
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./../../../public/css/pesquisar-produto.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
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
        window.opener.location.href = "./inserirItensVenda.php?idvenda=<?= $_GET['idvenda'] ?>&idproduto=" + idproduto;
    }
</script>

<body id="Container">
    <form id="formulario" method="post" action="">
        <label>Motor:</label>        
        <label style="margin-left:46%">Carro:</label>
        <div class="input-group">
            <select id="botão" class="form-control" name="idmotor">
                <option selected disabled>Selecione</option>
                <?php
                foreach ($motores->findAll() as $obj) { ?>
                    <option value="<?= $obj->getIdmotor(); ?>"><?= $obj->getPotencia() ?></option>
                <?php } ?>
            </select>
            <select id="botão"  style="margin-left: 30px" class="form-control" name="idcarro">
                <option selected disabled>Selecione</option>
                <?php
                foreach ($carros->findAll() as $obj) { ?>
                    <option value="<?= $obj->getIdcarro(); ?>"><?= $obj->getModelo() ?></option>
                <?php } ?>
            </select>
        </div>
        <label>Válvulas:</label>
        <label style="margin-left:44%">Ano de fabricação:</label>
        <div class="input-group">
            <select id="botão" class="form-control" name="idvalvulas">
                <option selected disabled>Selecione</option>
                <?php
                foreach ($valvulas->findAll() as $obj) { ?>
                    <option value="<?= $obj->getIdvalvulas(); ?>"><?= $obj->getQuantidade() ?></option>
                <?php } ?>
            </select>
            <select id="botão"  style="margin-left: 30px" class="form-control" name="idfabricacao">
                <option selected disabled>Selecione</option>
                <?php
                foreach ($fabricacoes->findAll() as $obj) { ?>
                    <option value="<?= $obj->getIdfabricacao(); ?>"><?= $obj->getAno() ?></option>
                <?php } ?>
            </select>
        </div>
        <label>Categoria:</label>
        <label style="margin-left:43%" >Marca:</label>
        <div class="input-group">
            <select id="botão" class="form-control" name="idcategoria">
                <option selected disabled>Selecione</option>
                <?php
                foreach ($categorias->findAll() as $obj) { ?>
                    <option value="<?= $obj->getIdcategoria(); ?>"><?= $obj->getCategoria() ?></option>
                <?php } ?>
            </select>
            <select id="botão"  style="margin-left: 30px" class="form-control" name="idmarca">
                <option selected disabled>Selecione</option>
                <?php
                foreach ($marcas->findAll() as $obj) { ?>
                    <option value="<?= $obj->getIdmarca(); ?>"><?= $obj->getMarca(); ?></option>
                <?php } ?>
            </select>
        </div>
        <label>Localização:</label>
        <label style="margin-left:41%" >Referência:</label>
        <div class="input-group">
            <select id="botão" class="form-control" name="idlocalizacao">
                <option selected disabled>Selecione</option>
                <?php
                foreach ($localizacoes->findAll() as $obj) { ?>
                    <option value="<?= $obj->getIdlocalizacao(); ?>"><?= $obj->getDepartamento() ?></option>
                <?php } ?>
            </select>
            <input id="botão"  style="margin-left: 30px" class="form-control" type="text" name="referencia" value="" />
        </div>
        <div class="mb-3">
            <input id="buscar" class="form-control" type="submit" value="Buscar" />
        </div>
    </form>
    <table class="table" style="color: #FFFFFF">
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
                        <button class="btn btn-sm btn-light" onclick="refreshParent(<?= $obj->getIdproduto() ?>);">Selecionar</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>