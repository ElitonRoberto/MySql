<?php
abstract class Crud
{
    protected $tabela;
    abstract function inserir();
    abstract function atualizar($campo, $id);

    public function listar(){
        $sqlSelect = "SELECT * FROM {$this->tabela}";
        return Conexao:: query($sqlSelect);
    }

    public function buscar($campo, $id){
        $selectSql = "SELECT * FROM {$this->tabela} where $campo = $id";
        return Conexao::query($selectSql);
    }

}
?>