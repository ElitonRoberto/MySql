<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Consultas</title>
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
        <div class="container">
            <?php
            spl_autoload_register(function ($class) {
                require_once "./Classes/{$class}.class.php";
            });

            if (filter_has_var(INPUT_GET, 'id')) {
                $consulta = new Consulta();
                $id = filter_input(INPUT_GET, 'id');
                $editCon = $consulta->buscar('idCon', $id);
            }

            if (filter_has_var(INPUT_GET, 'idDel')) {
                $consulta = new Consulta();
                $id = filter_input(INPUT_GET, 'idDel');
                if ($consulta->deletar('idCon', $id)) {
                    header("location:consultas.php");
                }
            }

            if (filter_has_var(INPUT_POST, 'btnGravar')) {

                $consulta = new Consulta();
                $id = filter_input(INPUT_POST, 'txtId');
                $consulta->setIdCon($id);
                $consulta->setPacienteCon(filter_input(INPUT_POST, 'txtPaciente'));
                $consulta->setMedicoCon(filter_input(INPUT_POST, 'txtMedico'));
                $consulta->setDataCon(filter_input(INPUT_POST, 'txtData'));
                $consulta->setHoraCon(filter_input(INPUT_POST, 'txtHora'));

                if (empty($id)) {
                    $consulta->inserir();
                } else {
                    $consulta->atualizar('idCon', $id);
                }
            }
            ?>

            <form class="row g-3" action="<?php echo
                                            htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="txtId" value="<?php echo isset($editCon->idCon) ? $editCon->idCon : null; ?>">

                <div class="col-6">
                    <label for="txtPaciente" class="form-label">Paciente</label>
                    <input type="text" class="form-control" id="txtPaciente" placeholder="Digite o nome do paciente..." name="txtPaciente" value="<?php echo isset($editCon->pacienteCon) ? $editCon->pacienteCon : NULL; ?>">
                </div>

                <div class="col-6">
                    <label for="txtMedico" class="form-label">Médico</label>
                    <input type="text" class="form-control" id="txtMedico" placeholder="Digite o nome do médico..." name="txtMedico" value="<?php echo isset($editCon->medicoCon) ? $editCon->medicoCon : NULL; ?>">
                </div>

                <div class="col-md-6">
                    <label for="txtData" class="form-label">Data</label>
                    <input type="date" class="form-control" id="txtData" name="txtData" value="<?php echo isset($editCon->dataCon) ? $editCon->dataCon : NULL; ?>">
                </div>

                
                <div class="col-6">
                    <label for="txtHora" class="form-label">Hora</label>
                    <input type="time" class="form-control" id="txtHora" name="txtHora" value="<?php echo isset($editCon->horaCon) ? $editCon->horaCon : NULL; ?>">
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