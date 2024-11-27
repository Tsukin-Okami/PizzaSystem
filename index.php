<?php
    include "db.php";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $cliente_id = $_POST['cliente_id'];
        $sabor_pizza = $_POST['sabor_pizza'];
        $quantidade = $_POST['quantidade_pizza'];
        $observacao = $_POST['observacao'];

        $sql = "INSERT INTO pedidos(cliente_id, sabor_pizza, quantidade_pizza, observacao) VALUES (:cliente_id, :sabor_pizza, :quantidade_pizza, :observacao)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam("cliente_id", $cliente_id);
        $stmt->bindParam("sabor_pizza", $sabor_pizza);
        $stmt->bindParam("quantidade", $quantidade);
        $stmt->bindParam("observacao", $observacao);

        $stmt->execute();

        header("location:pedidos.php");
        exit;
    }

    $sql = "SELECT * FROM clientes";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $clientes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar pedido - Pizzaria</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script>
        function preencheDadosCliente() {
            let clienteId = document.getElementById("cliente_id");
            let telefone = document.getElementById("telefone");
            let endereco = document.getElementById("endereco");

            <?php foreach($clientes as $cliente): ?>
                if (clienteId.value == <?php echo $cliente['id']; ?>) {
                    telefone.value = "<?php echo $cliente['telefone_cliente']; ?>";
                    endereco.value = "<?php echo $cliente['endereco_cliente']; ?>";
                }
            <?php endforeach; ?>
        }
    </script>
</head>
<body>
    <nav class="navbar bg-light navbar-light">
        <div class="navbar-nav">
            <li class="nav-item">
                <a href="index.php" class="nav-link active">Registrar pedido</a>
            </li>
            <li class="nav-item">
                <a href="pedidos.php" class="nav-link">Visualizar pedidos</a>
            </li>
            <li class="nav-item">
                <a href="cadastro.php" class="nav-link">Cadastrar cliente</a>
            </li>
            <li class="nav-item">
                <a href="cadastro_pizza.php" class="nav-link">Cadastrar pizza</a>
            </li>
        </div>
    </nav>
    <div class="container">
        <h1 class="h1">Registrar Pedido</h1>
        <form action="index.php" method="post" class="form">
            <div class="mb-3">
                <label for="cliente_id" class="form-label">Selecione o cliente:</label>
                <select name="cliente_id" id="cliente_id" onchange="preencherDadosCliente()" required class="form-select">
                    <option value="">Escolha o Cliente</option>
                    <?php foreach($clientes as $cliente): ?>
                        <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nome_cliente']; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" name="telefone" id="telefone" disabled class="form-control">
            </div>
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço:</label>
                <input type="text" name="endereco" id="endereco" disabled class="form-control">
            </div>
            <div class="mb-3">
                <label for="sabor_pizza" class="form-label">Sabor da pizza:</label>
                <input type="text" name="sabor_pizza" id="sabor_pizza" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="quantidade_pizza" class="form-label">Quantidade:</label>
                <input type="number" name="quantidade_pizza" id="quantidade_pizza" min="0" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="observacao" class="form-label">Observação:</label>
                <input type="text" name="observacao" id="observacao" class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
</body>
</html>