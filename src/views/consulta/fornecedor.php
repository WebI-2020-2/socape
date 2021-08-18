<?php
require_once __DIR__ . '/../../controller/SessaoController.php';
Sessao::verificaLogado();

require_once __DIR__ . '/../../controller/FornecedoresController.php';
$fornecedores = new FornecedoresController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Consultar fornecedor</title>

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
                    <h1 class="display-6">CONSULTAR FORNECEDOR</h1>
                </div>
            </div>
        </section>

        <div class="py-5 bg-light vh-100">
            <?php
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 1) echo '<script>alert("Informe o fornecedor!");</script>';
            }
            ?>
            <div class="py-5 bg-light vh-100">
                <?php if (isset($_GET["id"])) {
                    if ($fornecedores->findOne($_GET["id"])) {
                        $fornecedor = $fornecedores->findOne($_GET["id"]);
                        if ($_POST) {
                            $data = $_POST;
                
                            $err = FALSE;
            
                            if (!$data['nome']) {
                                echo
                                    '<script>
                                        alert("Informe o nome do Fornecedor!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$data['endereco']) {
                                echo
                                    '<script>
                                        alert("Informe o endereço!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$data['telefone']) {
                                echo
                                    '<script>
                                        alert("Informe o telefone!");
                                    </script>';
                                $err = TRUE;
                            }
                            if (!$data['cnpj']) {
                                echo
                                    '<script>
                                        alert("Informe o CNPJ");
                                    </script>';
                                $err = TRUE;
                            }
                
                            if (!$err) {
                                try {
                                    $fornecedores->update(
                                        $fornecedor->getIdfornecedor(),
                                        $data['nome'],
                                        $data['endereco'],
                                        $data['telefone'],
                                        $data['cnpj']
                                    );
                                    
                                    echo
                                    '<script>
                                        alert("Fornecedor atualizado com sucesso!");
                                        window.location.href = "../consulta/fornecedor.php";
                                    </script>';
                                
                                } catch (PDOException $e) {
                                    echo $e->getMessage();
                                }
                            }
                        }
            ?>
                    <section class="d-flex justify-content-left align-items-left text-light">
                        <div class="row">
                            <div class="col">
                                <a href="./cliente.php" class="btn btn-primary">VOLTAR</a>
                            </div>
                            <div class="col">
                                <button class="btn btn-danger" onclick="deletar('<?= $fornecedor->getIdfornecedor(); ?>', '<?= $fornecedor->getNome() ?>')">APAGAR</button>
                            </div>
                        </div>
                        
                        <img id="imagemFornecedor" src="./../../../public/imagens/caminhão.png" align="right">
                        <form id="form" style="margin-left: 25%" action="" method="post">
                            <div class="mb-3">
                                <label class="form-label">NOME</label>
                                <input style="width: 130%" type="text" name="nome" class="form-control" placeholder="NOME" value="<?= $fornecedor->getNome(); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ENDEREÇO</label>
                                <input style="width: 130%" type="text" name="endereco" class="form-control" placeholder="ENDEREÇO" value="<?= $fornecedor->getEndereco(); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">TELEFONE</label>
                                <input style="width: 130%" type="number" name="telefone" class="form-control" placeholder="TELEFONE" value="<?= $fornecedor->getTelefone(); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">CNPJ</label>
                                <input style="width: 130%" type="number" name="cnpj" class="form-control" placeholder="CNPJ" value="<?= $fornecedor->getCnpj(); ?>" required>
                            </div>

                            <button style="margin-left: 90%;padding: 4px 15px 3px 15px !important;border-radius: 50px !important;" class="btn btn-primary" id="salvar">SALVAR</button>
                        </form>
                    </section>
                <?php }
            } else { ?>
            <section class="container-fluid text-dark">
                <div class="row">
                    <div class="col mb-3">
                        <input type="text" id="txtBusca" class="form-control" placeholder="Pesquisar ..." aria-describedby="Help">
                        <div id="Help" class="form-text">Digite o fornecedor...</div>
                    </div>
                    <div class="col mb-3">
                        <div class="float-end">
                            <a class="btn btn-primary" href="../cadastro/fornecedor.php">NOVO CADASTRO</a>
                        </div>
                    </div>
                </div>
            </section>

            <div class="table-responsive-lg">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NOME</th>
                            <th scope="col">ENDEREÇO</th>
                            <th scope="col">TELEFONE</th>
                            <th scope="col">CNPJ</th>
                            <th scope="col">AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fornecedores->findAll() as $obj) { ?>
                            <tr>
                                <td><?= $obj->getIdfornecedor(); ?></td>
                                <td><?= $obj->getNome(); ?></td>
                                <td><?= $obj->getEndereco(); ?></td>
                                <td><?= $obj->getTelefone(); ?></td>
                                <td><?= $obj->getCnpj(); ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-primary" href="?id=<?= $obj->getIdfornecedor(); ?>">VISUALIZAR</a>
                                        <a class="btn btn-danger" href="?id=<?= $obj->getIdfornecedor(); ?>">EDITAR</a>
                                        <button class="btn btn-sm btn-dark" onclick="deletar('<?= $obj->getIdfornecedor(); ?>', '<?= $obj->getNome(); ?>')">APAGAR</button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } ?>
            </div>
        </div>
    </main>

    <script>
        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir " + nome + "?")) {
                $.ajax({
                    url: '../apagar/fornecedor.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Fornecedor excluído com sucesso!");
                            window.location.href = './fornecedor.php';
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