<?php

include "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome_cliente = $_POST['nome_cliente'];
    $telefone_cliente = $_POST['telefone_cliente'];
    $endereco_cliente = $_POST['endereco_cliente'];

    $sql = "INSERT INTO clientes(nome, telefone, endereco) VALUES (:nome, :telefone, :endereco)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam("nome",$nome_cliente);
    $stmt->bindParam("telefone",$telefone_cliente);
    $stmt->bindParam("endereco",$endereco_cliente);
    
    $stmt->execute();

    header("location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar cliente - Pizzaria</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-light navbar-light justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="index.php" class="nav-link">Registrar pedido</a>
            </li>
            <li class="nav-item">
                <a href="pedidos.php" class="nav-link">Visualizar pedidos</a>
            </li>
            <li class="nav-item">
                <a href="cadastro.php" class="nav-link active">Cadastrar cliente</a>
            </li>
            <li class="nav-item">
                <a href="cadastro_pizza.php" class="nav-link">Cadastrar pizza</a>
            </li>
        </ul>
    </nav>
    <div class="container mt-5">
        <h1 class="h1">Registrar Cliente</h1>
        <form action="cadastro.php" method="post" class="was-validated">
            <div class="mb-3 mt-3">
                <label for="nome_cliente" class="form-label">Nome:</label>
                <input type="text" name="nome_cliente" id="nome_cliente" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="telefone_cliente" class="form-label">Telefone:</label>
                <input type="tel" name="telefone_cliente" id="telefone_cliente" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="endereco_cliente" class="form-label">Endereço:</label>
                <input type="text" name="endereco_cliente" id="endereco_cliente" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar cliente</button>
        </form>
    </div>
</body>
</html>