<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Paciente</title>
</head>

<body>
    <header>
        <nav class="nav">
            <a class="nav-link active" aria-current="page" href="#">Active</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link" href="#">Link</a>
            <a class="nav-link disabled">Disabled</a>
        </nav>
    </header>

    <main>
        <div class="container">
            <?php
            spl_autoload_register(function ($class) {
                require_once "./Classes/{$class}.class.php";
            });
            $cac = new Paciente();
            if (filter_has_var(INPUT_GET, 'id')) {
                $id = filter_input(INPUT_GET, 'id');
                $paciente = new Paciente();
                $editPac = $paciente->buscar('idPac', $id);
            }

            if (filter_has_var(INPUT_POST, 'btnGravar')) {
                $nomeArq = filter_input(INPUT_POST, 'nomeAntigo');
                if (isset($_FILES['filFoto'])) {
                    $ext = strtolower(pathinfo($_FILES['filFoto']['name'], PATHINFO_EXTENSION));

                    if (empty($nomeArq)) {
                        $nomeArq = md5(date("Y.m.d-H.i.s")) . $ext;
                    }

                    $local = "imagesPac/"; //pasta que sera salvo
                    move_uploaded_file($_FILES['filFoto']['tmp_name'], $local . $nomeArq);

                }


                $paciente = new Paciente();
                $id = filter_input(INPUT_POST, 'txtId');
                $paciente->setIdPac($id);
                $paciente->setNomePac(filter_input(INPUT_POST, 'txtNome'));
                $paciente->setEnderecoPac(filter_input(INPUT_POST, 'txtEndereco'));
                $paciente->setBairroPac(filter_input(INPUT_POST, 'txtBairro'));
                $paciente->setCidadePac(filter_input(INPUT_POST, 'txtCidade'));
                $paciente->setEstadoPac(filter_input(INPUT_POST, 'sltEstado'));
                $paciente->setCepPac(filter_input(INPUT_POST, 'txtCep'));
                $paciente->setNascimentoPac(filter_input(INPUT_POST, 'txtNascimento'));
                $paciente->setEmailPac(filter_input(INPUT_POST, 'txtEmail'));
                $paciente->setFotoPac($nomeArq);
                if (empty($id)) {
                    $paciente->inserir();
                } else {
                    $paciente->atualizar('idPac', $id);
                }

            }
            ?>

            <form class="row g-3" action="<?php echo
                htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="txtId"
                    value="<?php echo isset($editPac->idPac) ? $editPac->idPac : null; ?>">

                <input type="hidden" name="nomeAntigo"
                    value="<?php echo isset($editPac->fotoPac) ? $editPac->fotoPac : null; ?>">


                <div class="col-12">
                    <label for="txtNome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="txtNome" placeholder="Digite seu nome..." name="txtNome"
                        value="<?php echo isset($editPac->nomePac) ? $editPac->nomePac : NULL; ?>">
                </div>
                <div class="col-12">
                    <label for="txtEndereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="txtEndereco" placeholder="Digite seu endereço..."
                        name="txtEndereco"
                        value="<?php echo isset($editPac->enderecoPac) ? $editPac->enderecoPac : NULL; ?>">
                </div>

                <div class="col-12">
                    <label for="txtBairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="txtBairro" placeholder="Digite seu bairro..."
                        name="txtBairro" value="<?php echo isset($editPac->bairroPac) ? $editPac->bairroPac : NULL; ?>">
                </div>
                <div class="col-md-6">
                    <label for="txtCidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="txtCidade" placeholder="Digite sua cidade..."
                        name="txtCidade" value="<?php echo isset($editPac->cidadePac) ? $editPac->cidadePac : NULL; ?>">
                </div>
                <div class="col-md-4">
                    <label for="sltEstado" class="form-label">Estado</label>
                    <?php $estadoSelec = isset($editPac->estadoPac) ? $editPac->estadoPac : null; ?>
                    <select id="sltEstado" class="form-select" name="sltEstado">
                        <option value="" selected hidden>Escolha...</option>
                        <option value="AC" <?php
                        if ($estadoSelec == "AC") {
                            echo 'selected';
                        }
                        ?>>Acre</option>

                        <option value="AL" <?php
                        if ($estadoSelec == "AL") {
                            echo 'selected';
                        }
                        ?>>Alagoas</option>

                        <option value="AP" <?php
                        if ($estadoSelec == "AP") {
                            echo 'selected';
                        }
                        ?>>Amapá</option>

                        <option value="AM" <?php
                        if ($estadoSelec == "AM") {
                            echo 'selected';
                        }
                        ?>>Amazonas</option>

                        <option value="BA" <?php
                        if ($estadoSelec == "BA") {
                            echo 'selected';
                        }
                        ?>>Bahia</option>

                        <option value="CE" <?php
                        if ($estadoSelec == "CE") {
                            echo 'selected';
                        }
                        ?>>Ceará</option>

                        <option value="DF" <?php
                        if ($estadoSelec == "DF") {
                            echo 'selected';
                        }
                        ?>>Distrito Federal
                        </option>

                        <option value="ES" <?php
                        if ($estadoSelec == "ES") {
                            echo 'selected';
                        }
                        ?>>Espírito Santo</option>

                        <option value="GO" <?php
                        if ($estadoSelec == "GO") {
                            echo 'selected';
                        }
                        ?>>Goiás</option>

                        <option value="MA" <?php
                        if ($estadoSelec == "MA") {
                            echo 'selected';
                        }
                        ?>>Maranhão</option>

                        <option value="MT" <?php
                        if ($estadoSelec == "MT") {
                            echo 'selected';
                        }
                        ?>>Mato Grosso</option>

                        <option value="MS" <?php
                        if ($estadoSelec == "MS") {
                            echo 'selected';
                        }
                        ?>>Mato Grosso do Sul
                        </option>

                        <option value="MG" <?php
                        if ($estadoSelec == "MG") {
                            echo 'selected';
                        }
                        ?>>Minas Gerais</option>

                        <option value="PA" <?php
                        if ($estadoSelec == "PA") {
                            echo 'selected';
                        }
                        ?>>Pará</option>

                        <option value="PB" <?php
                        if ($estadoSelec == "PB") {
                            echo 'selected';
                        }
                        ?>>Paraíba</option>

                        <option value="PR" <?php
                        if ($estadoSelec == "PR") {
                            echo 'selected';
                        }
                        ?>>Paraná</option>

                        <option value="PE" <?php
                        if ($estadoSelec == "PE") {
                            echo 'selected';
                        }
                        ?>>Pernambuco</option>

                        <option value="PI" <?php
                        if ($estadoSelec == "PI") {
                            echo 'selected';
                        }
                        ?>>Piauí</option>

                        <option value="RJ" <?php
                        if ($estadoSelec == "RJ") {
                            echo 'selected';
                        }
                        ?>>Rio de Janeiro</option>

                        <option value="RN" <?php
                        if ($estadoSelec == "RN") {
                            echo 'selected';
                        }
                        ?>>Rio Grande do Norte
                        </option>

                        <option value="RS" <?php
                        if ($estadoSelec == "RS") {
                            echo 'selected';
                        }
                        ?>>Rio Grande do Sul
                        </option>

                        <option value="RO" <?php
                        if ($estadoSelec == "RO") {
                            echo 'selected';
                        }
                        ?>>Rondônia</option>

                        <option value="RR" <?php
                        if ($estadoSelec == "RR") {
                            echo 'selected';
                        }
                        ?>>Roraima</option>

                        <option value="SC" <?php
                        if ($estadoSelec == "SC") {
                            echo 'selected';
                        }
                        ?>>Santa Catarina</option>

                        <option value="SP" <?php
                        if ($estadoSelec == "SP") {
                            echo 'selected';
                        }
                        ?>>São Paulo</option>

                        <option value="SE" <?php
                        if ($estadoSelec == "SE") {
                            echo 'selected';
                        }
                        ?>>Sergipe</option>

                        <option value="TO" <?php
                        if ($estadoSelec == "TO") {
                            echo 'selected';
                        }
                        ?>>Tocantins</option>

                    </select>
                </div>

                <div class="col-md-2">
                    <label for="txtCep" class="form-label">Cep</label>
                    <input type="text" class="form-control" id="txtCep" name="txtCep"
                        value="<?php echo isset($editPac->cepPac) ? $editPac->cepPac : NULL; ?>">
                </div>
                <div class="col-12">
                    <label for="txtEmail" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="txtEmail" placeholder="Digite seu email..."
                        name="txtEmail" value="<?php echo isset($editPac->emailPac) ? $editPac->emailPac : NULL; ?>">
                </div>

                <div class="col-md-6">
                    <label for="txtNascimento" class="form-label">Nascimento</label>
                    <input type="date" class="form-control" id="txtNascimento" name="txtNascimento"
                        value="<?php echo isset($editPac->nascimentoPac) ? $editPac->nascimentoPac : NULL; ?>">
                </div>
                <div class="col-md-6">
                    <label for="txtCelular" class="form-label">Celular</label>
                    <input type="text" class="form-control" id="txtCelular" name="txtCelular"
                        value="<?php echo isset($editPac->celularPac) ? $editPac->celularPac : NULL; ?>">
                </div>

                <div class="col-12">
                    <label for="filFoto" class="form-label">Adicione sua Foto</label>
                    <input class="form-control" type="file" id="filFoto" name="filFoto"
                        value="<?php echo isset($editPac->fotoPac) ? $editPac->fotoPac : NULL; ?>">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" name="btnGravar">Gravar</button>
                </div>

            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>


</html>