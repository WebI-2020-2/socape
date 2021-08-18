<img class="img-fluid w-100" src="./../../../public/imagens/titulo.png">
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-1">
    <div class="container-fluid d-flex">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navegacao">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navegacao">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../../../index.php">INÍCIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../views/venda/venda.php">VENDER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../views/entrada/entrada.php">DAR ENTRADA</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">CONSULTAR</a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="../../views/consulta/cliente.php">CLIENTE</a></li>
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
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">MINHA CONTA</a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li>
                            <h6 class="dropdown-header">Olá <?= $_SESSION['nome']; ?></h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../../views/usuario/perfil.php">PERFIL</a></li>
                        <li><a class="dropdown-item" href="../../views/usuario/logout.php">SAIR</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>