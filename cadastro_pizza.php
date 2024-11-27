<?php

include "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sabor_pizza = $_POST['sabor_pizza'];

    $sql = "INSERT INTO pizzas(sabor_pizza) VALUES (:sabor_pizza)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam("sabor_pizza",$sabor_pizza);
    $stmt->execute();

    header("location:cadastro_pizza.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar pizza - Pizzaria</title>
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
                <a href="cadastro.php" class="nav-link">Cadastrar cliente</a>
            </li>
            <li class="nav-item">
                <a href="cadastro_pizza.php" class="nav-link active">Cadastrar pizza</a>
            </li>
        </ul>
    </nav>
    <div class="container mt-5">
        <h1 class="h1">Registrar Pizza</h1>
        <form action="cadastro_pizza.php" method="post" class="was-validated">
            <div class="mb-3 mt-3">
                <label for="sabor_pizza" class="form-label">Sabor da Pizza:</label>
                <input type="text" name="sabor_pizza" id="sabor_pizza" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar Pizza</button>
        </form>
    </div>
</body>
</html>