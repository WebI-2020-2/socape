<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/ProdutosController.php';
$produtos = new ProdutosController();

require_once __DIR__ . '/../../controller/MotorController.php';
$motores = new MotorController();

require_once __DIR__ . '/../../controller/CarrosController.php';
$carros = new CarroController();

require_once __DIR__ . '/../../controller/ValvulasController.php';
$valvulas = new ValvulasController();

require_once __DIR__ . '/../../controller/FabricacaoController.php';
$fabricacoes = new FabricacaoController();

require_once __DIR__ . '/../../controller/LocalizacaoController.php';
$localizacoes = new LocalizacaoController();

require_once __DIR__ . '/../../controller/CategoriaController.php';
$categorias = new CategoriaController();

require_once __DIR__ . '/../../controller/MarcasController.php';
$marcas = new MarcasController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar Produto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body>
    <?php include __DIR__ . "/../includes/header.php"; ?>

    <main class="container-fluid bg-light min-vh-100 text-dark">
        <section class="container py-3">
            <div class="row align-items-center d-flex">
                <div class="col-2 col-md-2 col-sm-2"><a href="../consulta/produto.php" class="btn btn-primary">VOLTAR</a></div>
                <div class="col-8 col-md-8 col-sm-8 text-center">
                    <span class="display-6">CADASTRAR PRODUTO</span>
                </div>
            </div>
        </section>

        <?php
        if ($_POST) {
            $data = $_POST;

            $err = FALSE;

            if (!$data['idmotor']) {
                echo
                '<script>
                        alert("Informe a potência do motor!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['idcarro']) {
                echo
                '<script>
                        alert("Informe o nome do carro!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['idvalvulas']) {
                echo
                '<script>
                        alert("Informe a quantidade de válvulas!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['idfabricacao']) {
                echo
                '<script>
                        alert("Informe o ano de fabricação!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['idcategoria']) {
                echo
                '<script>
                        alert("Informe a categoria do produto!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['idmarca']) {
                echo
                '<script>
                        alert("Informe a marca do produto!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['unidade']) {
                echo
                '<script>
                        alert("Informe a unidade!");
                    </script>';
                $err = TRUE;
            } else if (strlen($data['unidade']) > 2) {
                echo
                '<script>
                        alert("A unidade só pode conter 2 dígitos!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['idlocalizacao']) {
                echo
                '<script>
                        alert("Informe o departamento que o produto será armazenado!");
                    </script>';
                $err = TRUE;
            }
            if (!$data['referencia']) {
                echo
                '<script>
                        alert("Informe a referência do produto!");
                    </script>';
                $err = TRUE;
            }

            if (!$err) {
                try {
                    $produtos->insert(
                        $data['idmotor'],
                        $data['idcarro'],
                        $data['idvalvulas'],
                        $data['idfabricacao'],
                        $data['idcategoria'],
                        $data['idmarca'],
                        $data['unidade'],
                        $data['idlocalizacao'],
                        $data['referencia'],
                    );

                    echo
                    '<script>
                            alert("Produto cadastrado com sucesso!");
                            window.location.href = "../consulta/produto.php";
                        </script>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        }
        ?>

        <section class="container min-vh-100 py-5">
            <section class="container-fluid text-start mb-5">
                <form method="POST" id="form">
                    <div class="row">
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idmotor" class="form-label black-text">MOTOR</label>
                            <select name="idmotor" id="idmotor" class="form-control" required>
                                <option selected disabled value>SELECIONE</option>
                                <?php foreach ($motores->findAll() as $obj) { ?>-
                                <option value="<?= $obj->getIdmotor(); ?>"><?= $obj->getPotencia(); ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idcarro" class="form-label black-text">CARRO</label>
                            <select id="idcarro" name="idcarro" class="form-control" required>
                                <option selected disabled value>SELECIONE</option>
                                <?php foreach ($carros->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdcarro(); ?>"><?= $obj->getModelo(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idvalvulas" class="form-label black-text">VÁLVULA</label>
                            <select id="idvalvulas" name="idvalvulas" class="form-control" required>
                                <option selected disabled value>SELECIONE</option>
                                <?php foreach ($valvulas->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdvalvulas(); ?>"><?= $obj->getQuantidade(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idfabricacao" class="form-label black-text">FABRICAÇÃO</label>
                            <select id="idfabricacao" name="idfabricacao" class="form-control" required>
                                <option selected disabled value>SELECIONE</option>
                                <?php foreach ($fabricacoes->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdfabricacao(); ?>"><?= $obj->getAno(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idlocalizacao" class="form-label black-text">LOCALIZAÇÃO</label>
                            <select id="idlocalizacao" name="idlocalizacao" class="form-control" required>
                                <option selected disabled value>SELECIONE</option>
                                <?php foreach ($localizacoes->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdlocalizacao(); ?>"><?= $obj->getDepartamento(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idcategoria" class="form-label black-text">CATEGORIA</label>
                            <select id="idcategoria" name="idcategoria" class="form-control" required>
                                <option selected disabled value>SELECIONE</option>
                                <?php foreach ($categorias->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdcategoria(); ?>"><?= $obj->getCategoria(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idmarca" class="form-label black-text">MARCA</label>
                            <select id="idmarca" name="idmarca" class="form-control" required>
                                <option selected disabled value>SELECIONE</option>
                                <?php foreach ($marcas->findAll() as $obj) { ?>
                                    <option value="<?= $obj->getIdmarca(); ?>"><?= $obj->getMarca(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="idreferencia" class="form-label black-text">REFERÊNCIA</label>
                            <input type="text" id="idreferencia" name="referencia" oninput="validaInput(this, true)" class="form-control" maxlength="20" placeholder="REFERÊNCIA" autocomplete="off" required>
                        </div>
                        <div class="col-12 col-md-4 col-sm-6 mb-3">
                            <label for="unidade" class="form-label black-text">UNIDADE</label>
                            <input type="text" id="unidade" name="unidade" oninput="validaInput(this, false)" class="form-control" maxlength="2" placeholder="UNIDADE" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row text-end">
                        <div class="col-6 col-md-12 col-sm-6 mb-3">
                            <button type="submit" class="btn btn-primary">CADASTRAR</button>
                        </div>
                    </div>
                </form>
            </section>
        </section>
    </main>

    <script>
        $(document).ready(function() {
            $("#form").on("submit", function() {
                $("button[type=submit]").prop("disabled", true);
                $("button[type=submit]").text("CADASTRANDO...");
            });

            $('#unidade').on('keyup', (ev) => {
                $('#unidade').val($('#unidade').val().toUpperCase());
            });
        });
    </script>
    <script>
        function deletar(id, referencia) {
            if (confirm("Deseja realmente excluir o produto de referencia " + referencia + "?")) {
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="./../../../public/js/validaInput.js"></script>
</body>

</html>