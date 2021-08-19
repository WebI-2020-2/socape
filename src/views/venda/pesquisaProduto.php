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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
</head>

<script>
    function refreshParent(idproduto) {
        window.close();
        window.opener.location.href = "./itensVenda.php?idvenda=<?= $_GET['idvenda'] ?>&idproduto=" + idproduto;
    }
</script>

<body>
    <main class="container-fluid bg-light min-vh-100 text-dark">
        <section class="container py-3">
            <div class="row align-items-center d-flex">
                <div class="col-12 col-md-12 col-sm-12 text-center">
                    <span class="display-6">PESQUISAR PRODUTO</span>
                </div>
            </div>
        </section>

        <section class="container-fluid min-vh-100 py-5">
            <section class="text-start mb-3">
                <div class="row align-items-center d-flex mb-3">
                    <div class="col-12 col-md-12 col-sm-12">
                        <span class="display-6">PREFERÊNCIAS DA PESQUISA</span>
                    </div>
                </div>

                <form method="POST" action="">
                    <div class="row mb-3">
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idmotor" class="form-label">MOTOR</label>
                            <select class="form-control" id="idmotor" name="idmotor">
                                <option selected disabled>TODAS</option>
                                <?php foreach ($motores->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdmotor(); ?>"><?= $obj->getPotencia() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label id="idcarro" class="form-label">MODELO DO CARRO</label>
                            <select class="form-control" id="idcarro" name="idcarro">
                                <option selected disabled>TODAS</option>
                                <?php foreach ($carros->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdcarro(); ?>"><?= $obj->getModelo() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idvalvulas" class="form-label">QUANTIDADE DE VÁLVULAS</label>
                            <select class="form-control" id="idvalvulas" name="idvalvulas">
                                <option selected disabled>TODAS</option>
                                <?php foreach ($valvulas->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdvalvulas(); ?>"><?= $obj->getQuantidade() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idfabricacao" class="form-label">ANO DE FABRICAÇÃO</label>
                            <select class="form-control" id="idfabricacao" name="idfabricacao">
                                <option selected disabled>TODAS</option>
                                <?php foreach ($fabricacoes->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdfabricacao(); ?>"><?= $obj->getAno() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idcategoria" class="form-label">CATEGORIA</label>
                            <select class="form-control" id="idcategoria" name="idcategoria">
                                <option selected disabled>TODAS</option>
                                <?php foreach ($categorias->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdcategoria(); ?>"><?= $obj->getCategoria() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idmarca" class="form-label">MARCA</label>
                            <select class="form-control" id="idmarca" name="idmarca">
                                <option selected disabled>TODAS</option>
                                <?php foreach ($marcas->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdmarca(); ?>"><?= $obj->getMarca(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idlocalizacao" class="form-label">LOCALIZAÇÃO</label>
                            <select class="form-control" id="idlocalizacao" name="idlocalizacao" class="form-control">
                                <option selected disabled>TODAS</option>
                                <?php foreach ($localizacoes->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdlocalizacao(); ?>"><?= $obj->getDepartamento() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="referencia" class="form-label">REFERÊNCIA</label>
                            <input class="form-control" type="text" id="referencia" name="referencia" placeholder="PROCURAR POR REFERÊNCIA" />
                        </div>
                    </div>
                    <div class="row d-flex">
                        <div class="col-12 col-md-4 col-sm-6 mb-3 ms-auto d-flex align-items-end">
                            <button class="btn btn-primary ms-auto" type="submit">PESQUISAR</button>
                        </div>
                    </div>
                </form>
            </section>

            <section class="container-fluid text-start mb-5">
                <div class="row align-items-center d-flex mb-3">
                    <div class="col-12 col-md-12 col-sm-12">
                        <span class="display-6">PRODUTOS</span>
                    </div>
                </div>

                <div class="table-responsive-lg">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">PRODUTO</th>
                                <th scope="col">ESTOQUE</th>
                                <th scope="col">VALOR DE VENDA</th>
                                <th scope="col">LOCALIZAÇÃO</th>
                                <th scope="col">AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = $_POST;

                            $idmotor = isset($data["idmotor"]) ? $data["idmotor"] : null;
                            $idcarro = isset($data["idcarro"]) ? $data["idcarro"] : null;
                            $idvalvulas = isset($data["idvalvulas"]) ? $data["idvalvulas"] : null;
                            $idfabricacao = isset($data["idfabricacao"]) ? $data["idfabricacao"] : null;
                            $idcategoria = isset($data["idcategoria"]) ? $data["idcategoria"] : null;
                            $idmarca = isset($data["idmarca"]) ? $data["idmarca"] : null;
                            $idlocalizacao = isset($data["idlocalizacao"]) ? $data["idlocalizacao"] : null;
                            $referencia = isset($data["referencia"]) ? $data["referencia"] : null;

                            foreach ($produtos->findWithFilter($idmotor, $idcarro, $idvalvulas, $idfabricacao, $idcategoria, $idmarca, $idlocalizacao, $referencia) as $obj) { ?>
                                <tr>
                                    <td><?= $obj->getIdproduto(); ?></td>
                                    <td><?= $categorias->findOne($obj->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($obj->getIdmarca())->getMarca() . ' ' . $obj->getReferencia(); ?></td>
                                    <td><?= $obj->getQuantidade(); ?></td>
                                    <td><?= $obj->getValorvenda(); ?></td>
                                    <td><?= $localizacoes->findOne($obj->getIdlocalizacao())->getDepartamento(); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-primary" onclick="refreshParent(<?= $obj->getIdproduto(); ?>);">SELECIONAR</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>