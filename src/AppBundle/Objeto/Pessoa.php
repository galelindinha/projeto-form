<?php

namespace AppBundle\Objeto;

class Pessoa {
  protected $nome;

  public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
}

?>
