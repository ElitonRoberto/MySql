<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Especialidade</title>
</head>

<body>
    <header>
        <nav class="nav"><!--Ta feio esse menu, vou modificar posteriormente-->
            <a class="nav-link" href="#">Clinica</a>
            <a class="nav-link" href="#">Médicos</a>
            <a class="nav-link" href="especialidades.php">Especialidades</a>
            <a class="nav-link" href="#">Consultas</a>
            <a class="nav-link" href="pacientes.php">Pacientes</a>
        </nav>
    </header>

    <main>
        <div class="container">
            <?php
            spl_autoload_register(function ($class) {
                require_once "./Classes/{$class}.class.php";
            });

            if (filter_has_var(INPUT_GET, 'id')) {
                $especialidade = new Especialidade();
                $id = filter_input(INPUT_GET, 'id');
                $editEsp = $especialidade->buscar('idEsp', $id);
            }

            if (filter_has_var(INPUT_GET, 'idDel')) {
                $especialidade = new Especialidade();
                $id = filter_input(INPUT_GET, 'idDel');
                if ($especialidade->deletar('idEsp', $id)) {
                    header("location:especialidades.php");
                }
            }

            if (filter_has_var(INPUT_POST, 'btnGravar')) {
                $especialidade = new Especialidade();
                $id = filter_input(INPUT_POST, 'txtId');
                $especialidade->setIdEsp($id);
                $especialidade->setNomeEsp(filter_input(INPUT_POST, 'txtNome'));

                if (empty($id)) {
                    $especialidade->inserir();
                } else {
                    $especialidade->atualizar('idEsp', $id);
                }
            }
            ?>

            <form class="row g-3" action="<?php echo
                                            htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="txtId" value="<?php echo isset($editEsp->idEsp) ? $editEsp->idEsp : null; ?>">


                <div class="col-12">
                    <label for="txtNome" class="form-label">Nome da Especialidade</label>
                    <input type="text" class="form-control" id="txtNome" placeholder="Digite o nome..." name="txtNome">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary" name="btnGravar">Gravar</button>
                </div>

            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>


</html>