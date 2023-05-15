<?php

class Medico extends Crud
{
    protected $tabela = 'Medico';
    private $idMed;
    private $especialidadeMed;
    private $nomeMed;
    private $crmMed;
    private $emailMed;
    private $celularMed;



    /**
     * @return mixed
     */
    public function getIdMed()
    {
        return $this->idMed;
    }

    /**
     * @param mixed $idMed 
     * @return self
     */
    public function setIdMed($idMed): self
    {
        $this->idMed = $idMed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEspecialidadeMed()
    {
        return $this->especialidadeMed;
    }

    /**
     * @param mixed $especialidadeMed 
     * @return self
     */
    public function setEspecialidadeMed($especialidadeMed): self
    {
        $this->especialidadeMed = $especialidadeMed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomeMed()
    {
        return $this->nomeMed;
    }

    /**
     * @param mixed $nomeMed 
     * @return self
     */
    public function setNomeMed($nomeMed): self
    {
        $this->nomeMed = $nomeMed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCrmMed()
    {
        return $this->crmMed;
    }

    /**
     * @param mixed $crmMed 
     * @return self
     */
    public function setCrmMed($crmMed): self
    {
        $this->crmMed = $crmMed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmailMed()
    {
        return $this->emailMed;
    }

    /**
     * @param mixed $emailMed 
     * @return self
     */
    public function setEmailMed($emailMed): self
    {
        $this->emailMed = $emailMed;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCelularMed()
    {
        return $this->celularMed;
    }

    /**
     * @param mixed $celularMed 
     * @return self
     */
    public function setCelularMed($celularMed): self
    {
        $this->celularMed = $celularMed;
        return $this;
    }

    public function inserir()
    {
        $especialidade = $this->getEspecialidadeMed();
        $nome = $this->getNomeMed();
        $crm = $this->getCrmMed();
        $email = $this->getEmailMed();
        $celular = $this->getCelularMed();

        $sqlInserir = "INSERT INTO $this->tabela (especialidadeMed, nomeMed, crmMed, emailMed, celularMed) VALUES ('$especialidade', '$nome', '$crm', '$email', '$celular')";
        if (Conexao::query($sqlInserir)) {
            header('location: medicos.php');
        }
    }

    /**
     *
     * @param mixed $campo
     * @param mixed $id
     * @return mixed
     */
    public function atualizar($campo, $id) //arrumar
    {
        $especialidade = $this->getEspecialidadeMed();
        $nome = $this->getNomeMed();
        $crm = $this->getCrmMed();
        $email = $this->getEmailMed();
        $celular = $this->getCelularMed();


        $sqlAtualizar = "UPDATE $this->tabela SET especialidadeMed='$especialidade', nomeMed='$nome',
        crmMed = '$crm', emailMed = '$email', celularMed = '$celular' WHERE $campo = {$id}";
        if (Conexao::query($sqlAtualizar)) {
            header('location: medicos.php');
        }
    }
}
