<?php

namespace Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "pessoa")]
class Pessoa
{

    #[ORM\Id]
    #[ORM\Column(name: "pes_id", type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(name: "pes_nome", type: 'string', nullable: false)]
    private $nome;

    #[ORM\Column(name: "pes_cpf", type: 'string', unique: true, nullable: false)]
    private $cpf;

    #[ORM\OneToMany(targetEntity: Contato::class, mappedBy: "pessoa", cascade: ["persist", "remove"])]
    private Collection $contatos;

    public function __construct() {
        $this->contatos = new ArrayCollection();
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function getCpf(): string {
        return $this->cpf;
    }

    public function setCpf(string $cpf): void {
        $this->cpf = $cpf;
    }

    public function getContatos(): Collection {
        return $this->contatos;
    }

    public function adicionarContato(Contato $contato): void {
        if (!$this->contatos->contains($contato)) {
            $this->contatos->add($contato);
            $contato->setPessoa($this);
        }
    }

    public function removerContato(Contato $contato): void {
        $this->contatos->removeElement($contato);
    }

}