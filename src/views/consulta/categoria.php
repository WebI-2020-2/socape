<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/CategoriaController.php';
$categorias = new CategoriaController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar categoria</title>

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
                    <h1 class="display-6">CONSULTAR CATEGORIA</h1>
                </div>
            </div>
        </section>

        <div class="py-5 bg-light vh-100">
            <?php
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 1) echo '<script>alert("Informe a categoria!");</script>';
            }
            ?>

            <section class="container-fluid text-dark">
                <div class="row">
                    <div class="col mb-3">
                        <input type="text" id="txtBusca" class="form-control" placeholder="Pesquisar ..."  aria-describedby="Help">
                        <div id="Help" class="form-text">Digite a categoria...</div>
                    </div>
                    <div class="col mb-3">
                        <div class="float-end">
                            <a class="btn btn-primary" href="../cadastro/categoria.php">NOVO CADASTRO</a>
                        </div>
                    </div>
                </div>
            </section>

            <div class="table-responsive-lg">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">CATEGORIA</th>
                            <th scope="col">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias->findAll() as $obj) { ?>
                            <tr>
                                <td><?= $obj->getIdcategoria() ?></td>
                                <td><?= $obj->getCategoria() ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-danger" href="./editarCategoria.php?id=<?= $obj->getIdcategoria() ?>">EDITAR</a>
                                        <button class="btn btn-sm btn-dark" onclick="deletar('<?= $obj->getIdcategoria() ?>', '<?= $obj->getCategoria() ?>')">APAGAR</button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    
    <script>
        function deletar(id, categoria) {
            if (confirm("Deseja realmente excluir a categoria " + categoria + "?")) {
                $.ajax({
                    url: '../apagar/categoria.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Categoria excluída com sucesso!");
                            window.location.href = './categoria.php';
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