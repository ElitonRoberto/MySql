<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="css/layout.css">

    <title>Especialidades</title>
</head>

<body>
    <header>
        <nav class="nav"><!--Ta feio esse menu, vou modificar posteriormente-->
            <a class="nav-link" href="#">Clinica</a>
            <a class="nav-link" href="medicos.php">Médicos</a>
            <a class="nav-link" href="especialidades.php">Especialidades</a>
            <a class="nav-link" href="consultas.php">Consultas</a>
            <a class="nav-link" href="pacientes.php">Pacientes</a>
        </nav>
    </header>

    <main>
        <div class="mt-3">
            <div class="container">
            <div class="d-flex flex-row-reverse">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                        class="col-mod-6">
                        <div class="input-group mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="txtPesquisar" placeholder="Pesquisar"
                                    name="txtPesquisar">
                                <label for="pesquisar">Pesquisar</label>
                            </div>
                            <button class="btn btn-outline-secondary" type="submit" id="btnPesquisar"
                                name="btnPesquisar">
                                <span class="material-symbols-outlined">
                                    search
                                </span>
                            </button>
                        </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Ações</th>
                            <th>Especialidades</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        spl_autoload_register(function ($class) {
                            require_once "./Classes/{$class}.class.php";
                        });
                        /*if (filter_has_var(INPUT_GET, "id")) {
                            $id = filter_input(INPUT_GET, "id");
                        }*/
                        $especialidade = new Especialidade();
                        if (filter_has_var(INPUT_POST, 'txtPesquisar')) {
                            $parametro = filter_input(INPUT_POST, 'txtPesquisar');
                            $where = "where(nomeEsp like '%$parametro%')";
                            $dadosBanco = $especialidade->listar($where);
                        } else {
                            $dadosBanco = $especialidade->listar();
                        }

                        //$dadosBanco = $especialidade->listar();
                        while ($row = $dadosBanco->fetch_object()) {
                        ?>
                            <tr>
                                <td>
                                    <a href="especialidadeGer.php?id=<?php echo $row->idEsp ?>" class="btn btn-secondary">
                                        <span class="material-symbols-outlined">
                                            edit_square
                                        </span>
                                    </a>
                                    <a href="especialidadeGer.php?idDel=<?php echo $row->idEsp ?>" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir o registro')">
                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>
                                    </a>
                                </td>

                                <td>
                                    <?php echo $row->nomeEsp; ?>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <div>
                    <a href="especialidadeGer.php" class="btn btn-primary"><span class="material-symbols-outlined">note_add</span>Nova Especialidade</a>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>


</html>