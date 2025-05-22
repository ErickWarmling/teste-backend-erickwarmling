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
            $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();

            require __DIR__ . './../View/Pessoa/ListarPessoas.php';
        } catch (\Throwable $th) {
            echo("Erro ao listar pessoas: " . $th->getMessage());
        }
    }

    public function criarPessoa($nome, $cpf) {
        try {
            $pessoaExistente = $this->entityManager->getRepository(Pessoa::class)->findOneBy(['cpf' => $cpf]);

            if ($pessoaExistente) {
                echo "Já existe pessoa cadastrada com este CPF";
                return;
            }

            $pessoa = new Pessoa();
            $pessoa->setNome($nome);
            $pessoa->setCpf($cpf);
            $this->entityManager->persist($pessoa);
            $this->entityManager->flush();

            header("Location: /pessoas");
            exit;

        } catch (\Throwable $th) {
            echo "Erro ao criar pessoa: " . $th->getMessage();
        }
    }

    public function atualizarPessoa($id, $nome, $cpf) {
        try {
            $pessoa = $this->entityManager->find(Pessoa::class, $id);

            if (!$pessoa) {
                echo("Pessoa não encontrada com o id: " . $id);
                return;
            }

            $pessoa->setNome($nome);
            $pessoa->setCpf($cpf);
            $this->entityManager->flush();

            header("Location: /pessoas");
            exit;
        } catch (\Throwable $th) {
            echo "Erro ao atualizar pessoa: " . $th->getMessage();
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

            header('location: /pessoas');
        } catch (\Throwable $th) {
            echo "Erro ao excluir pessoa: " . $th->getMessage();
        }
     }

     public function buscarPessoaPorNome($nomePessoa) {
        try {
            $sql = "SELECT pessoa FROM Model\Pessoa pessoa WHERE pessoa.nome LIKE :nomePessoa";
            $query = $this->entityManager->createQuery($sql);
            $query->setParameter('nomePessoa', '%' . $nomePessoa . '%');
            $pessoas = $query->getResult();

            require __DIR__ . './../View/Pessoa/ListarPessoas.php';
        } catch (\Throwable $th) {
            echo "Erro ao buscar pessoa: " . $th->getMessage();
        }
     }
}