<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

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
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Pesquisar por produto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/pesquisarProduto.css" rel="stylesheet">
</head>

<script>
    function refreshParent(idproduto) {
        window.close();
        window.opener.location.href = "./inserirItensEntrada.php?identrada=<?= $_GET['identrada'] ?>&idproduto=" + idproduto;
    }
</script>

<body>
    <div id="container">
    <h1>
        <span class="badge bg-light text-dark">PESQUISAR PRODUTO</span>
    </h1>


        <form method="post" action="">
            <div id="preferencias">
                <h1 id="titulo2">
                    <span class="badge bg-light text-dark">PREFERÊNCIAS DA PESQUISA</span>
                </h1>
                <div id="dados">
                    <label>MOTOR</label>
                    <label id="MODELO">MODELO DO CARRO</label>
                    <div class="input-group">
                        <select class="form-control" name="idmotor">
                            <option selected disabled>TODAS</option>
                            <?php
                            foreach ($motores->findAll() as $obj) { ?>
                                <option value="<?= $obj->getIdmotor(); ?>"><?= $obj->getPotencia() ?></option>
                            <?php } ?>
                        </select>
                        <select style="margin-left: 28px;"  class="form-control" name="idcarro">
                            <option selected disabled>TODAS</option>
                            <?php
                            foreach ($carros->findAll() as $obj) { ?>
                                <option value="<?= $obj->getIdcarro(); ?>"><?= $obj->getModelo() ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <label>QUANTIDADE DE VÁLVULAS</label>
                    <label id="ANO">ANO DE FABRICAÇÃO</label>
                    <div class="input-group">
                        <select class="form-control" name="idvalvulas">
                            <option selected disabled>TODAS</option>
                            <?php
                            foreach ($valvulas->findAll() as $obj) { ?>
                                <option value="<?= $obj->getIdvalvulas(); ?>"><?= $obj->getQuantidade() ?></option>
                            <?php } ?>
                        </select>
                        <select style="margin-left: 28px;" class="form-control" name="idfabricacao">
                            <option selected disabled>TODAS</option>
                            <?php
                            foreach ($fabricacoes->findAll() as $obj) { ?>
                                <option value="<?= $obj->getIdfabricacao(); ?>"><?= $obj->getAno() ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <label>CATEGORIA</label>
                    <label id="MARCA">MARCA</label>
                    <div class="input-group">        
                        <select class="form-control" name="idcategoria">
                            <option selected disabled>TODAS</option>
                            <?php
                            foreach ($categorias->findAll() as $obj) { ?>
                                <option value="<?= $obj->getIdcategoria(); ?>"><?= $obj->getCategoria() ?></option>
                            <?php } ?>
                        </select>
                        <select style="margin-left: 28px;" class="form-control" name="idmarca">
                            <option selected disabled>TODAS</option>
                            <?php
                            foreach ($marcas->findAll() as $obj) { ?>
                                <option value="<?= $obj->getIdmarca(); ?>"><?= $obj->getMarca(); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <label>LOCALIZAÇÃO</label>
                    <label id="REFERÊNCIA">REFERÊNCIA</label>
                    <div class="input-group">
                        <select class="form-control" name="idlocalizacao" class="form-control">
                                <option selected disabled>TODAS</option>
                                <?php
                                foreach ($localizacoes->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdlocalizacao(); ?>"><?= $obj->getDepartamento() ?></option>
                                <?php } ?>
                            </select>
                            <input style="margin-left: 28px;" class="form-control" type="text" name="referencia" placeholder="PROCURAR POR REFERÊNCIA" />   
                    </div>
                    <label id="REFERÊNCIA">DESCRIÇÃO</label>
                    <input style="margin-left: 28px;" class="form-control" type="text" name="descricao" placeholder="PROCURAR POR DESCRIÇÃO" />   
                </div>
                <div id="pesquisar" class="mb-3">
                    <input class="btn btn-primary" type="submit" value="PESQUISAR" />
                </div>
            </div>
           
            
    
        </form>

        <table style="margin-top: 1%"  class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CATEGORIA/MARCA</th>
                    <th>REFERÊNCIA</th>
                    <th>DESCRIÇÃO</th>
                    <th>QUANTIDADE</th>
                    <th>VALOR DE VENDA</th>
                    <th>LOCALIZAÇÃO</th>
                    <th>AÇÃO</th>
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
                $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : null;

                foreach ($produtos->findWithFilter($idmotor, $idcarro, $idvalvulas, $idfabricacao, $idcategoria, $idmarca, $idlocalizacao, $referencia, $descricao) as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIdproduto() ?></td>
                        <td><?= $categorias->findOne($obj->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($obj->getIdmarca())->getMarca() ?></td>
                        <td><?= $obj->getReferencia() ?></td>
                        <td><?= $obj->getDescricao() ?></td>
                        <td><?= $obj->getQuantidade() ?></td>
                        <td><?= $obj->getValorvenda() ?></td>
                        <td><?= $localizacoes->findOne($obj->getIdlocalizacao())->getDepartamento() ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="refreshParent(<?= $obj->getIdproduto() ?>);">SELECIONAR</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>