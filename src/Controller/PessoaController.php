<?php

namespace Controller;

use Doctrine\ORM\EntityManager;
use Model\Pessoa;

class PessoaController
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function listarPessoas()
    {
        try {
            $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();

            require __DIR__ . './../View/Pessoa/ListarPessoas.php';
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao listar pessoas: " . $th->getMessage());
        }
    }

    public function criarPessoa($nome, $cpf)
    {
        try {
            if (!$this->validarCPF($cpf)) {
                throw new \Exception('CPF inválido. Verifique o formato e os dígitos');
            }

            $pessoaExistente = $this->entityManager->getRepository(Pessoa::class)->findOneBy(['cpf' => $cpf]);

            if ($pessoaExistente) {
                throw new \Exception("Já existe pessoa cadastrada com este CPF");
            }

            $pessoa = new Pessoa();
            $pessoa->setNome($nome);
            $pessoa->setCpf($cpf);
            $this->entityManager->persist($pessoa);
            $this->entityManager->flush();

            header("Location: /pessoas");
            exit;

        } catch (\Throwable $th) {
            throw new \Exception("Erro ao criar pessoa: " . $th->getMessage());
        }
    }

    public function atualizarPessoa($id, $nome, $cpf)
    {
        try {
            if (!$this->validarCPF($cpf)) {
                throw new \Exception('CPF inválido. Verifique o formato e os dígitos');
            }

            $pessoa = $this->entityManager->find(Pessoa::class, $id);

            if (!$pessoa) {
                throw new \Exception("Pessoa não encontrada com o id: " . $id);
            }

            $pessoaExistente = $this->entityManager->getRepository(Pessoa::class)->findOneBy(['cpf' => $cpf]);
            if ($pessoaExistente && $pessoaExistente->getId() != $id) {
                throw new \Exception('Já existe outra pessoa cadastrada com este CPF');
            }

            $pessoa->setNome($nome);
            $pessoa->setCpf($cpf);
            $this->entityManager->flush();

            header("Location: /pessoas");
            exit;
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao atualizar pessoa: " . $th->getMessage());
        }
    }

    public function excluirPessoa($id)
    {
        try {
            $pessoa = $this->entityManager->find(Pessoa::class, $id);

            if (!$pessoa) {
                throw new \Exception("Pessoa não encontrada com id: " . $id);
            }

            $this->entityManager->remove($pessoa);
            $this->entityManager->flush();

            header('location: /pessoas');
            exit;
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao excluir pessoa: " . $th->getMessage());
        }
    }

    public function buscarPessoaPorNome($nomePessoa)
    {
        try {
            $sql = "SELECT pessoa FROM Model\Pessoa pessoa WHERE pessoa.nome LIKE :nomePessoa";
            $query = $this->entityManager->createQuery($sql);
            $query->setParameter('nomePessoa', '%' . $nomePessoa . '%');
            $pessoas = $query->getResult();

            require __DIR__ . './../View/Pessoa/ListarPessoas.php';
        } catch (\Throwable $th) {
            throw new("Erro ao buscar pessoa: " . $th->getMessage());
        }
    }

    public function validarCpf($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        $somaPrimeiroDigito = 0;
        for ($i = 0; $i < 9; $i++) {
            $somaPrimeiroDigito += intval($cpf[$i] * (10 - $i));
        }

        $resto = ($somaPrimeiroDigito * 10) % 11;
        if ($resto == 10 || $resto == 11) {
            $resto = 0;
        }

        if ($resto != intval($cpf[9])) {
            return false;
        }

        $somaSegundoDigito = 0;
        for ($i = 0; $i < 10; $i++) {
            $somaSegundoDigito += intval($cpf[$i] * (11 - $i));
        }

        $resto = ($somaSegundoDigito * 10) % 11;
        if ($resto == 10 || $resto == 11) {
            $resto = 0;
        }

        if ($resto != intval($cpf[10])) {
            return false;
        }

        return true;
    }
}