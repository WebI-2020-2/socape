<?php
    $venda = $_GET["idvenda"];

    require_once '../../controller/ItensVendaController.php';
    $itensvenda = new ItensVendaController();
?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">IDProduto</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Valor de venda</th>
            <th scope="col">Desconto</th>
            <th scope="col">Lucro</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($itensvenda->findAllByIdVenda($venda) as $obj) { ?>
        <tr>
            <td><?= $obj->getIditensvenda(); ?></td>
            <td><?= $obj->getIdproduto(); ?></td>
            <td><?= $obj->getQuantidade(); ?></td>
            <td><?= $obj->getValorvenda(); ?></td>
            <td><?= $obj->getDesconto(); ?></td>
            <td><?= $obj->getLucro(); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>