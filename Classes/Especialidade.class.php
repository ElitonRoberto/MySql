<?php
class Especialidade extends Crud
{
    protected $tabela = 'Especialidade';
    private $idEsp;
    private $nomeEsp;

    /**
     * @return mixed
     */
    public function getIdEsp()
    {
        return $this->idEsp;
    }

    /**
     * @param mixed $idEsp
     * @return self
     */
    public function setIdEsp($idEsp): self
    {
        $this->idEsp = $idEsp;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomeEsp()
    {
        return $this->nomeEsp;
    }

    /**
     * @param mixed $nomeEsp 
     * @return self
     */
    public function setNomeEsp($nomeEsp): self
    {
        $this->nomeEsp = $nomeEsp;
        return $this;
    }

    /**
     * @return mixed
     */

    public function inserir()
    {
        $nome = $this->getNomeEsp();

        $sqlInserir = "INSERT INTO $this->tabela (nomeEsp) VALUES ('$nome')";
        if (Conexao::query($sqlInserir)) {
            header('location: especialidades.php');
        }
    }

    /**
     *
     * @param mixed $campo
     * @param mixed $id
     * @return mixed
     */
    public function atualizar($campo, $id)
    {
        $nome = $this->getNomeEsp();

        $sqlAtualizar = "UPDATE $this->tabela SET nomeEsp='$nome' WHERE $campo = {$id}";
        if (Conexao::query($sqlAtualizar)) {
            header('location: especialidades.php');
        }
    }
}
