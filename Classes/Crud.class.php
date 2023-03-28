<?php
abstract class Crud
{
    protected $tabela;
    abstract function inserir();
    abstract function atualizar($campo, $id);

}
?>