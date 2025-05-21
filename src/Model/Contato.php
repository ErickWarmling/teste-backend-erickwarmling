<?php

namespace Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "contato")]
class Contato
{
    #[ORM\Id]
    #[ORM\Column(name: "contato_id", type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(name: "contato_tipo", type: 'string', nullable: false)]
    private $tipo;

    #[ORM\Column(name: "contato_descricao", type: 'string', nullable: false)]
    private $descricao;

    #[ORM\ManyToOne(targetEntity: Pessoa::class, inversedBy: "contatos")]
    #[ORM\JoinColumn(name: "pes_id", referencedColumnName: "pes_id", nullable: false)]
    private $pessoa;

    public function getId(): int {
        return $this->id;
    }

    public function getTipo(): string {
        return $this->tipo;
    }

    public static function getTipoContato() {
        return ["E-mail", "Telefone"];
    }

    public function setTipo(string $tipo): void {
        $tipoContato = self::getTipoContato();
        if(!in_array($tipo, $tipoContato)) {
            throw new \InvalidArgumentException("Informe um tipo de contato válido: E-mail ou Telefone");
        }
        $this->tipo = $tipo;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void {
        $this->descricao = $descricao;
    }

    public function getPessoa(): Pessoa {
        return $this->pessoa;
    }

    public function setPessoa($pessoa): void {
        $this->pessoa = $pessoa;
    }
}