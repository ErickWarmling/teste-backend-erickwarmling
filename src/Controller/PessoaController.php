<?php

namespace Controller;
use Doctrine\ORM\EntityManager;
use Model\Pessoa;

class PessoaController
{
    private $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function listarPessoas() {
        try {
            return $this->entityManager->getRepository(Pessoa::class)->findAll();
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao listar pessoas: " . $th->getMessage());
        }

    }

    public function criarPessoa($nome, $cpf) {
        try {
            $pessoa = new Pessoa();
            $pessoa->setNome($nome);
            $pessoa->setCpf($cpf);
            $this->entityManager->persist($pessoa);
            $this->entityManager->flush();
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao criar pessoa: " . $th->getMessage());
        }

    }

    public function atualizarPessoa($id, $nome, $cpf) {
        try {
            $pessoa = $this->entityManager->find(Pessoa::class, $id);

            if (!$pessoa) {
                throw new \Exception("Pessoa não encontrada com o id: " . $id);
                return;
            }

            $pessoa->setNome($nome);
            $pessoa->setCpf($cpf);
            $this->entityManager->flush();
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao atualizar pessoa: " . $th->getMessage());
        }
    }

     public function excluirPessoa($id) {
        try {
            $pessoa = $this->entityManager->find(Pessoa::class, $id);

            if (!$pessoa) {
                echo "Pessoa não encontrada com id: " . $id;
                return;
            }

            $this->entityManager->remove($pessoa);
            $this->entityManager->flush();
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao excluir pessoa: " . $th->getMessage());
        }
     }

     public function buscarPessoaPorNome($nomePessoa) {
        try {
            $sql = "SELECT pessoa FROM Model\Pessoa pessoa WHERE pessoa.nome LIKE :nomePessoa";
            $query = $this->entityManager->createQuery($sql);
            $query->setParameter('nomePessoa', '%' . $nomePessoa . '%');
            return $query->getResult();
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao buscar pessoa: " . $th->getMessage());
        }
     }
}