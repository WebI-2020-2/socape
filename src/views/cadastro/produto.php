<?php
    require_once '../../controller/ProdutosController.php';
    $produto = new ProdutosController();

    require_once '../../controller/MotorController.php';
    $motor = new MotorController();

    require_once '../../controller/CarrosController.php';
    $carro = new CarroController();

    require_once '../../controller/ValvulasController.php';
    $valvula = new ValvulasController();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOCAPE | Cadastrar Produto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./../../../public/css/cadastrar-fornecedor.css" rel="stylesheet">
</head>

<body>
    <img src="./../../../public/imagens/titulo.png" width="100%">
    <nav id="navegador" class="navbar navbar-expand-lg navbar-black bg-black">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastrar</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/cliente-fisico.php">Cliente</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/fornecedor.php">Fornecedor</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/produto.php">Produto</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/carro.php">Carro</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/localizacao.php">Localização</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/valvula.php">Valvula</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/categoria.php">Categoria</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/motor.php">Motor</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/anofabricacao.php">Fabricação</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/cadastro/marca.php">Marca</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: FFFFFF" href="../../views/venda/venda.php">Vender</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: FFFFFF" href="../../views/entrada/entrada.php">Entrada</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: FFFFFF" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consultar</a>
                        <ul style="background-color: #140C0C " class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/consulta/cliente.php">Cliente</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/consulta/fornecedor.php">Fornecedor</a></li>
                            <li><a class="dropdown-item" style="color: FFFFFF" href="../../views/consulta/produto.php">Produto</a></li>

                        </ul>
                    </li>
                    <li id="conta" class="nav-item">
                        <a class="nav-link" style="color: FFFFFF" href="#">Minha conta</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="Container">
        <h1>
            <span id="titulo" class="badge bg-light text-dark">Cadastrar Produto</span>
        </h1>
        <?php
            if($_POST){

                $produto = new ProdutosController();
                $produto->setIdmotor($_POST['idmotor']);
                $produto->setIdcarro($_POST['idcarro']);
                $produto->setIdvalvulas($_POST['idvalvulas']);
                $produto->setIdfabricacao($_POST['idfabricacao']);
                $produto->setIdcategoria($_POST['idfabricacao']);
                $produto->setIdmarca($_POST['idfabricacao']);
                $produto->setIcms($_POST['idfabricacao']);
                $produto->setIpi($_POST['idfabricacao']);
                $produto->setFrete($_POST['idfabricacao']);
                $produto->setValornafabrica($_POST['idfabricacao']);
                $produto->setValordecompra($_POST['idfabricacao']);
                $produto->setLucro($_POST['idfabricacao']);
                $produto->setValorvenda($_POST['idfabricacao']);
                $produto->setDesconto($_POST['idfabricacao']);
                $produto->setQuantidade($_POST['idfabricacao']);
                $produto->setIdlocalizacao($_POST['idfabricacao']);
                $produto->setReferencia($_POST['idfabricacao']);
                $produto->setQuantidade($_POST['idfabricacao']);

                try {
                    $produto->insert($produto->setIdmotor(), $produto->setIdcarro(), $produto->setIdvalvulas(), $produto->setIdfabricacao());
                    echo
                        '<div class="success callout">
                            <h5>Fornecedor cadastrado</h5>
                            <p>Fornecedor cadastrado com sucesso!.</p>
                        </div>';
                } catch (PDOException $err) {
                    echo $err->getMessage();
                }
            }
        ?>
        <form id="dados" action="" method="post">
            
            <div class="mb-3">
                <label for="motor" class="form-label">Motor:</label>
                <select id="motor" name="motor" style="border-radius: 30px 30px 30px 30px" class="form-control">
                        <option selected disabled>Selecione</option>
                        <?php

                            foreach ($motor->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdmotor(); ?>"><?= $obj->getPotencia(); ?></option>
                        <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="carro" class="form-label">Carro:</label>
                <select id="carro" name="carro" style="border-radius: 30px 30px 30px 30px" class="form-control">
                        <option selected disabled>Selecione</option>
                        <?php


                            foreach ($carro->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdcarro(); ?>"><?= $obj->getModelo(); ?></option>
                        <?php } ?>
                </select>            
            </div>

            <div class="mb-3">
                <label for="valvula" class="form-label">Válvula:</label>
                <select id="valvula" name="valvula" style="border-radius: 30px 30px 30px 30px" class="form-control">
                        <option selected disabled>Selecione</option>
                        <?php
                        require_once '../../controller/ValvulasController.php';
                        $valvula = new ValvulasController();

                            foreach ($valvula->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdvalvulas(); ?>"><?= $obj->getQuantidade(); ?></option>
                        <?php } ?>
                </select>                
            </div>

            <div class="mb-3">
                <label for="fabricacao" class="form-label">Fabricação:</label>
                <select id="fabricacao" name="fabricacao" style="border-radius: 30px 30px 30px 30px" class="form-control">
                        <option selected disabled>Selecione</option>
                        <?php
                        require_once '../../controller/FabricacaoController.php';
                        $fabricacao = new FabricacaoController();

                            foreach ($fabricacao->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdfabricacao(); ?>"><?= $obj->getAno(); ?></option>
                        <?php } ?>
                </select>                
            </div>

            <div class="mb-3">
                <label for="localizacao" class="form-label">Localização:</label>
                <select id="localizacao" name="localizacao" style="border-radius: 30px 30px 30px 30px" class="form-control">
                        <option selected disabled>Selecione</option>
                        <?php
                        require_once '../../controller/LocalizacaoController.php';
                        $localizacao = new LocalizacaoController();

                            foreach ($localizacao->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdlocalizacao(); ?>"><?= $obj->getDepartamento(); ?></option>
                        <?php } ?>
                </select>                
            </div>            

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria:</label>
                <select id="categoria" name="categoria" style="border-radius: 30px 30px 30px 30px" class="form-control">
                        <option selected disabled>Selecione</option>
                        <?php
                        require_once '../../controller/CategoriaController.php';
                        $categoria = new CategoriaController();

                            foreach ($categoria->findAll() as $obj) { ?>
                            <option value="<?= $obj->getIdlocalizacao(); ?>"><?= $obj->getCategoria(); ?></option>
                        <?php } ?>
                </select>                
            </div>    

            <div class="mb-3">
                <label for="desconto" class="form-label">Desconto:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="desconto" id= "desconto" class="form-control" placeholder="Desconto">
            </div>    


            <div class="mb-3">
                <label for="lucro" class="form-label">Lucro:</label>
                <input style="border-radius: 30px 30px 30px 30px" type="text" name="lucro" id= "lucro" class="form-control" placeholder="Lucro">
            </div>    
        
            <div id="localizaçãoBotões">
                <input id="botão" type="submit" class="btn btn-light" value="Salvar">
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>