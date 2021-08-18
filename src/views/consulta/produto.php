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
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Consultar produto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <?php include __DIR__ . "/../includes/header.php"; ?>

    <main>
        <section class="text-center container">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="display-6">CONSULTAR PRODUTO</h1>
                </div>
            </div>
        </section>

        <div class="py-5 bg-light vh-100">
            <?php
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 1) echo '<script>alert("Informe o produto!");</script>';
            }
            ?>


            <div class="py-5 bg-light vh-100">
                <?php if (isset($_GET["id"])) {
                    if ($produtos->findOne($_GET["id"])) {
                        $produto = $produtos->findOne($_GET["id"]);
                        if ($_POST) {
                            $data = $_POST;
                
                            $err = FALSE;
                
                            if (!$data['icms']) {
                                echo
                                '<script>
                                        alert("Informe o valor do ICMS!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$data['ipi']) {
                                echo
                                '<script>
                                        alert("Informe o valor do IPI!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$data['frete']) {
                                echo
                                '<script>
                                        alert("Informe o valor do frete!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$data['valornafabrica']) {
                                echo
                                '<script>
                                        alert("Informe o valor na fábrica!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$data['valordecompra']) {
                                echo
                                '<script>
                                        alert("Informe o valor de compra!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$data['lucro']) {
                                echo
                                '<script>
                                        alert("Informe o lucro!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$data['valorvenda']) {
                                echo
                                '<script>
                                        alert("Informe o valor de venda!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$data['desconto']) {
                                echo
                                '<script>
                                        alert("Informe o valor de desconto!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$data['quantidade']) {
                                echo
                                '<script>
                                        alert("Informe a quantidade!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$data['unidade']) {
                                echo
                                '<script>
                                        alert("Informe a Unidade!");
                                    </script>';
                                $err = TRUE;
                            } else if (strlen($data['unidade']) > 2) {
                                echo
                                '<script>
                                        alert("A unidade não pode ser maior que 2 campos!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$data['referencia']) {
                                echo
                                '<script>
                                        alert("Informe a Referência!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$err) {
                                try {
                                    $produtos->update(
                                        $produto->getIdproduto(),
                                        $data['icms'],
                                        $data['ipi'],
                                        $data['frete'],
                                        $data['valornafabrica'],
                                        $data['valordecompra'],
                                        $data['lucro'],
                                        $data['valorvenda'],
                                        $data['desconto'],
                                        $data['quantidade'],
                                        $data['unidade'],
                                        $data['referencia'],
                                        $data['idlocalizacao'],
                                        $data['idmotor'],
                                        $data['idcarro'],
                                        $data['idvalvulas'],
                                        $data['idfabricacao'],
                                        $data['idcategoria'],
                                        $data['idmarca'],
                                    );
                
                                    echo
                                    '<script>
                                        alert("Produto atualizado com sucesso!");
                                        window.location.href = "../consulta/produto.php";
                                    </script>';
                                } catch (PDOException $e) {
                                    echo $e->getMessage();
                                }
                            }
                        }
                        ?>
                        <div class="row">
                            <div class="col">
                                <a href="./produto.php" class="btn btn-primary">VOLTAR</a>
                            </div>
                        </div> 
                        <form id="formProduto" action="" method="post">
            <div class="input-group mb-3">
                <h1 style="text-align: left; margin-left: 10px;">
                    <span class="badge bg-light text-dark">PRODUTO</span>
                </h1>
                <input style="margin-left: 10px; margin-top: 13px;margin-bottom:15px;height: 40px; font-size: 15px;" type="button" class="btn btn-danger btn-lg active" name="descricao" placeholder="DESCRICAO" value="<?= $produto->getReferencia()?>" disabled>
            </div>
            <div class="input-group">
                <div id="input" >
                    <label class="form-label black-text">ICMS</label>
                    <input type="number" class="form-control" name="icms" placeholder="ICMS" value="<?= $produto->getIcms(); ?>" required>
                </div>
                <div  id="input">
                    <label class="form-label">IPI</label>
                    <input type="number" class="form-control" name="ipi" placeholder="IPI" value="<?= $produto->getIpi(); ?>" required>
                </div>
                <div  id="input">
                    <label class="form-label">FRETE</label>
                    <input type="number" class="form-control" name="frete" placeholder="FRETE" value="<?= $produto->getFrete(); ?>" required>
                </div>  
            </div>
            <div class="input-group mb-3">
                <div class="mb-3"  id="input">
                    <label class="form-label">VALOR NA FÁBRICA</label>
                    <input type="number" class="form-control" name="valornafabrica" placeholder="VALOR NA FÁBRICA" value="<?= $produto->getValornafabrica(); ?>" required>
                </div>
                <div class="mb-3"  id="input">
                    <label class="form-label">VALOR DE COMPRA</label>
                    <input type="number" class="form-control" name="valordecompra" placeholder="VALOR DE COMPRA" value="<?= $produto->getValordecompra(); ?>" required>
                </div>
                <div class="mb-3"  id="input">
                    <label class="form-label">LUCRO</label>
                    <input type="number" class="form-control" name="lucro" placeholder="LUCRO" value="<?= $produto->getLucro(); ?>" required>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="mb-3"  id="input">
                    <label class="form-label">VALOR DE VENDA</label>
                    <input type="number" class="form-control" name="valorvenda" placeholder="VALOR DE VENDA" value="<?= $produto->getValorvenda(); ?>" required>
                </div>
                <div class="mb-3"  id="input">
                    <label class="form-label">DESCONTO</label>
                    <input  type="number" class="form-control" name="desconto" placeholder="DESCONTO" value="<?= $produto->getDesconto(); ?>" required>
                </div>
                <div class="mb-3"  id="input">
                    <label  class="form-label">QUANTIDADE</label>
                    <input  type="number" class="form-control" name="quantidade" placeholder="QUANTIDADE" value="<?= $produto->getQuantidade(); ?>" required>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="mb-3"  id="input">
                    <label class="form-label">UNIDADE</label> 
                    <input  type="text" class="form-control" name="unidade" placeholder="UNIDADE" value="<?= $produto->getUnidade(); ?>" required>
                </div>
                <div class="mb-3"  id="input">
                    <label  class="form-label">REFERÊNCIA</label>
                    <input type="text" class="form-control" name="referencia" placeholder="REFERÊNCIA" value="<?= $produto->getReferencia(); ?>" required>
                </div>
                <div class="mb-3"  id="input">
                    <label class="form-label">LOCALIZAÇÃO</label>
                    <select name="idlocalizacao" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($localizacoes->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdlocalizacao(); ?>" <?= $produto->getIdlocalizacao() == $obj->getIdlocalizacao() ? 'selected' : null; ?>><?= $obj->getDepartamento(); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="mb-3"  id="input">
                    <label class="form-label">MOTOR</label>
                    <select name="idmotor" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($motores->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdmotor(); ?>" <?= $produto->getIdmotor() == $obj->getIdmotor() ? 'selected' : null; ?>><?= $obj->getPotencia(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3" id="input" >
                    <label class="form-label">MODELO DE CARRO</label>
                    <select name="idcarro" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($carros->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdcarro(); ?>" <?= $produto->getIdcarro() == $obj->getIdcarro() ? 'selected' : null; ?>><?= $obj->getModelo(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3"  id="input">
                    <label class="form-label">VÁLVULAS</label>
                    <select name="idvalvulas" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($valvulas->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdvalvulas(); ?>" <?= $produto->getIdvalvulas() == $obj->getIdvalvulas() ? 'selected' : null; ?>><?= $obj->getQuantidade(); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="input-group mb-3"  id="input">
                <div class="mb-3"id="input">
                    <label class="form-label">FABRICAÇÃO</label>
                    <select name="idfabricacao" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($fabricacoes->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdfabricacao(); ?>" <?= $produto->getIdfabricacao() == $obj->getIdfabricacao() ? 'selected' : null; ?>><?= $obj->getAno(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3"id="input" >
                    <label  class="form-label">CATEGORIA</label>
                    <select  name="idcategoria" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($categorias->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdcategoria(); ?>" <?= $produto->getIdcategoria() == $obj->getIdcategoria() ? 'selected' : null; ?>><?= $obj->getCategoria(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3" id="input" >
                    <label  class="form-label">MARCA</label>
                    <select name="idmarca" class="form-control" required>
                        <option disabled>SELECIONE</option>
                        <?php foreach ($marcas->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdmarca(); ?>" <?= $produto->getIdmarca() == $obj->getIdmarca() ? 'selected' : null; ?>><?= $obj->getMarca(); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>        
                <button style="margin-left: 90%;padding: 4px 15px 3px 15px ;border-radius: 50px; margin-bottom: 10px;" class="btn btn-primary" id="salvar">SALVAR</button>
        </form>               
        <?php }
            } else { ?>
            <section class="container-fluid text-dark">
                <div class="row">
                    <div class="col mb-3">
                        <input type="text" id="txtBusca" class="form-control" placeholder="Pesquisar ..." aria-describedby="Help">
                        <div id="Help" class="form-text">Digite o nome do produto...</div>
                    </div>
                    <div class="col mb-3">
                        <div class="float-end">
                            <a class="btn btn-primary" href="../cadastro/produto.php">NOVO CADASTRO</a>
                        </div>
                    </div>
                </div>
            </section>

            <div class="table-responsive-lg">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">CATEGORIA/MARCA</th>
                            <th scope="col">REFERÊNCIA</th>
                            <th scope="col">QUANTIDADE</th>
                            <th scope="col">VALOR DE VENDA</th>
                            <th scope="col">LOCALIZAÇÃO</th>
                            <th scope="col">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($produtos->findAll() as $obj) { ?>
                            <tr>
                                <td><?= $obj->getIdproduto() ?></td>
                                <td><?= $categorias->findOne($obj->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($obj->getIdmarca())->getMarca() ?></td>
                                <td><?= $obj->getReferencia() ?></td>
                                <td><?= $obj->getQuantidade() ?></td>
                                <td><?= $obj->getValorvenda() ?></td>
                                <td><?= $localizacoes->findOne($obj->getIdlocalizacao())->getDepartamento() ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                    <a class="btn btn-primary" href="?id=<?= $obj->getIdproduto() ?>">VISUALIZAR/EDITAR</a>
                        
                                        <button class="btn btn-sm btn-dark" onclick="deletar('<?= $obj->getIdproduto() ?>', '<?= $obj->getReferencia() ?>','<?= $categorias->findOne($obj->getIdcategoria())->getCategoria() . '/' . $marcas->findOne($obj->getIdmarca())->getMarca() ?>')">APAGAR</button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } ?>
                </div>
            </div>
        </div>
    </main>

    <script>
        function deletar(id, referencia, categoria) {
            if (confirm("Deseja realmente excluir o produto de referência " + referencia + " " + categoria + "?")) {
                $.ajax({
                    url: '../apagar/produto.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Produto excluído com sucesso!");
                            window.location.href = './produto.php';
                        } else {
                            alert(res["msg"]);
                        }
                    }
                });
                return false;
            }
        }

        $(document).ready(function() {
            $("#txtBusca").on("keyup", function() {
                const value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>