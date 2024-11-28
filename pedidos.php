<?php

include "db.php";
include "taghtml.php";

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    
    $sql = "DELETE FROM pedidos WHERE id=:id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam("id",$id);

    $stmt->execute();

    header("location:pedidos.php");
    exit;
}

if (isset($_GET['atualizar_status'])) {
    $id = $_GET['atualizar_status'];

    $sql = "UPDATE pedidos SET status = CASE
    WHEN status='A fazer' THEN 'Em preparaçao'
    WHEN status='Em preparaao' THEN 'Pronto'
    WHEN status='Pronto' THEN 'A fazer'
    END WHERE id=:id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();

    header("location:pedidos.php");
}

$sql = "SELECT pedidos.*, clientes.nome, clientes.telefone, clientes.endereco FROM pedidos JOIN clientes ON pedidos.cliente_id=clientes.id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$pedidos = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos - Pizzaria</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="index.php" class="nav-link">Registrar pedido</a>
            </li>
            <li class="nav-item">
                <a href="pedidos.php" class="nav-link active">Visualizar pedidos</a>
            </li>
            <li class="nav-item">
                <a href="cadastro.php" class="nav-link">Cadastrar cliente</a>
            </li>
            <li class="nav-item">
                <a href="cadastro_pizza.php" class="nav-link">Cadastrar pizza</a>
            </li>
        </ul>
    </nav>
    <div class="container mt-5">
        <h1 class="h1 mb-3">Pedidos</h1>
        <div class="container">
            <div class="container">
                <h2>Pedidos a Fazer</h2>
                <?php 
                    foreach($pedidos as $pedido) {
                        if ($pedido['status'] == "A fazer") {
                            $pedidosvalue = [
                                $pedido['nome_cliente'],
                                $pedido['telefone_cliente'],
                                $pedido['endereco_cliente'],
                                $pedido['sabor_pizza'],
                                $pedido['quantidade_pizza'],
                                $pedido['observacao'],
                                $pedido['status']
                            ];

                            $pedidosnome = [
                                "Cliente:",
                                "Telefone:",
                                "Endereço:",
                                "Sabor da Pizza:",
                                "Quantidade:",
                                "Observação:",
                                "Status:"
                            ];

                            $detalhes = "";

                            foreach ($pedidosvalue as $key => $pvalue) {
                                $title = new tagHtml;
                                $title->setTag("strong");
                                $title->setValue($pedidosnome[$key]);

                                $joint = $title->mount() . $pvalue;

                                $paragraf = new tagHtml;
                                $paragraf->setTag("p");
                                $paragraf->setValue($joint);
                                $detalhes .= $paragraf->mount();
                            }

                            $atualizar = new tagHtml;
                            $atualizar->setTag("a");
                            $atualizar->setValue("Alterar status");
                            $atualizar->addAtribute("href","?atualizar_status={$pedido['id']}");
                            $detalhes .= $atualizar->mount();

                            $excluir = new tagHtml;
                            $excluir->setTag("a");
                            $excluir->setValue("Excluir pedido");
                            $excluir->addAtribute("href","?excluir={$pedido['id']}");
                            $detalhes .= $excluir->mount();

                            $conjunto = new tagHtml;
                            $conjunto->setTag("div");
                            $conjunto->addAtribute("class","pedido");
                            $conjunto->setValue($detalhes);
                        }
                    }
                ?>
            </div>
            <div class="container">
                <h2>Pedidos Prontos</h2>
                <?php foreach($pedidos as $pedido): ?>
                    <?php if($pedido['status'] == "Pronto"): ?>
                        <div class="pedido">
                            <p>
                                <strong>Cliente:</strong>
                                <?php echo $pedido['nome_cliente']; ?>
                            </p>
                            <p>
                                <strong>Telefone:</strong>
                                <?php echo $pedido['telefone_cliente']; ?>
                            </p>
                            <p>
                                <strong>Endereço:</strong>
                                <?php echo $pedido['endereco_cliente']; ?>
                            </p>
                            <p>
                                <strong>Sabor da Pizza:</strong>
                                <?php echo $pedido['sabor_pizza']; ?>
                            </p>
                            <p>
                                <strong>Quantidade:</strong>
                                <?php echo $pedido['quantidade_pizza']; ?>
                            </p>
                            <p>
                                <strong>Observação:</strong>
                                <?php echo $pedido['observacao']; ?>
                            </p>
                            <p>
                                <strong>Status:</strong>
                                <?php echo $pedido['status']; ?>
                            </p>
                            <a href="?atualizar_status=<?php echo $pedido['id'] ?>">Alterar status</a>
                            <a href="?excluir=<?php echo $pedido['id'] ?>">Excluir pedido</a>
                        </div>    
                    <?php endif; ?>    
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>