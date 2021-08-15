<?php
require_once __DIR__ . '/../../controller/EntradasController.php';
$entradas = new EntradasController();

require_once __DIR__ . '/../../controller/FornecedoresController.php';
$fornecedores = new FornecedoresController();
?>
<!doctype html>
<html class="no-js" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SOCAPE | Entrada</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/estilos.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <img src="./../../../public/imagens/titulo.png">
    <nav class="navbar navbar-expand-lg navbar-black bg-black">
        <div class="collapse navbar-collapse">
            <ul style="width:100%;" class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../../../index.php">INÍCIO</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">CADASTRAR</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../views/cadastro/cliente-fisico.php">CLIENTE</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/fornecedor.php">FORNECEDOR</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/produto.php">PRODUTO</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/carro.php">CARRO</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/localizacao.php">LOCALIZAÇÃO</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/valvula.php">VÁLVULA</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/categoria.php">CATEGORIA</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/motor.php">MOTOR</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/anofabricacao.php">FABRICAÇÃO</a></li>
                        <li><a class="dropdown-item" href="../../views/cadastro/marca.php">MARCA</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../views/venda/venda.php">VENDER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../views/entrada/entrada.php">DAR ENTRADA</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">CONSULTAR</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../views/consulta/fornecedor.php">FORNECEDOR</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/produto.php">PRODUTO</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/carro.php">CARRO</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/localizacao.php">LOCALIZAÇÃO</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/valvula.php">VÁLVULA</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/categoria.php">CATEGORIA</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/motor.php">MOTOR</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/anofabricacao.php">FABRICAÇÃO</a></li>
                        <li><a class="dropdown-item" href="../../views/consulta/marca.php">MARCA</a></li>
                    </ul>
                </li>
                <li style="margin-left: 52%" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: #FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">MINHA CONTA</a>
                    <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" style="color: #FFFFFF" href="../../views/usuario/perfil.php">PERFIL</a></li>
                        <li><a class="dropdown-item" style="color: #FFFFFF" href="../../../logout.php">SAIR</a></li> 
                        
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div id="container">
        <h1>
            <span class="badge bg-light text-dark">ENTRADAS</span>
        </h1>

        <?php
        if (isset($_GET['msg'])) if ($_GET['msg'] == 1) echo "<h1>INFORME O FORNECEDOR!</h1>";
        ?>

        <style>
            #realizarEntrada{
                margin-left: 40%;
                margin-top: 20px;
            }
        </style>
        <form id="realizarEntrada" method="POST" action="./realizarEntrada.php">
        
            <div class="mb-3">
                <label class="form-label">FORNECEDOR</label>
                <input style="width: 130%;" id="barraPesquisa" class="form-control" type="text" placeholder="FORNECEDOR">
                <input id="idfornecedor" type="hidden" name="idfornecedor" required>
            </div>

            <input style="margin-left: 67%"  type="button" class="btn btn-primary" value="DAR ENTRADA">
        </form>

        <table style="margin-top: 1%" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>FORNECEDOR</th>
                    <th>VALOR TOTAL</th>
                    <th>DATA</th>
                    <th width="20%">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($entradas->findAll() as $obj) { ?>
                    <tr>
                        <td><?= $obj->getIdentrada() ?></td>
                        <td><?= $fornecedores->findOne($obj->getIdfornecedor())->getNome(); ?></td>
                        <td><?= $obj->getValortotalnota() ?></td>
                        <td><?= $obj->getDatacompra() ?></td>
                        <td>
                            <div class="button-group clear">
                                <button class="btn btn-sm btn-danger" onclick="deletar('<?= $obj->getIdentrada() ?>', '<?= $fornecedores->findOne($obj->getIdfornecedor())->getNome(); ?>')">APAGAR</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $.getJSON('./retornaFornecedor.php', function(data) {
                var fornecedor = [];

                $(data).each(function(key, value) {
                    fornecedor.push({
                        label: value.nome,
                        value: value.idfornecedor
                    });
                });

                $('#barraPesquisa').autocomplete({
                    source: fornecedor,
                    minLength: 3,
                    select: (event, ui) => {
                        $("#barraPesquisa").val(ui.item.label);
                        $("#idfornecedor").val(ui.item.value);

                        return false;
                    }
                });
            });

            $("#realizarEntrada").on("click", "input[type=button]", function(e) {
                e.preventDefault();

                if ($("#idfornecedor").val() == "") {
                    alert("Informe o fornecedor!");

                    return false;
                } else {
                    $("#realizarEntrada").submit();
                    $("#realizarEntrada input[type=button]").prop("disabled", true);
                    $("#realizarEntrada input[type=button]").val("VENDENDO...");
                }
            });
        });

        function deletar(id, nome) {
            if (confirm("Deseja realmente excluir a entrada do fornecedor " + nome + "?")) {
                $.ajax({
                    url: '../apagar/entrada.php',
                    type: "POST",
                    data: {
                        id
                    },
                    success: (res) => {
                        if (res["status"]) {
                            alert("Entrada excluída com sucesso!");
                            window.location.href = './entrada.php';
                        } else {
                            alert(res["msg"]);
                        }
                    }
                });
                return false;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>