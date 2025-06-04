<?php

namespace Controller;
use Doctrine\ORM\EntityManager;
use Model\Contato;
use Model\Pessoa;

class ContatoController
{
    private $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function listarContatos() {
        try {
            $contatos = $this->entityManager->getRepository(Contato::class)->findAll();

            require __DIR__ . "/../View/Contato/ListarContatos.php";
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao listar contatos: " . $th->getMessage());
        }
    }

    public function criarContato($tipo, $descricao, $pessoaId) {
        try {
            $this->validarContato($tipo, $descricao);

            $contatoExistente = $this->entityManager->getRepository(Contato::class)->findOneBy(['tipo' => $tipo, 'descricao' => $descricao]);

            if ($contatoExistente) {
                throw new \Exception("O contato informado já está cadastrado");
            }

            $pessoa = $this->entityManager->find(Pessoa::class, $pessoaId);

            if(!$pessoa) {
                throw new \Exception("Pessoa não encontrada com o id: " . $pessoaId);
            }

            $contato = new Contato();
            $contato->setTipo($tipo);
            $contato->setDescricao($descricao);
            $contato->setPessoa($pessoa);
            $this->entityManager->persist($contato);
            $this->entityManager->flush();

            $tipoContato = Contato::getTipoContato();
            $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();

            header("Location: /contatos");
            exit;
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao criar contato: " . $th->getMessage());
        }
    }

    public function atualizarContato($id, $tipo, $descricao, $pessoaId) {
        try {
            $this->validarContato($tipo, $descricao);

            $contato = $this->entityManager->find(Contato::class, $id);

            if (!$contato) {
                throw new \Exception("Contato não encontrado com o id: " . $id);
            }

            $contatoExistente = $this->entityManager->getRepository(Contato::class)->findOneBy(['tipo' => $tipo, 'descricao' => $descricao]);

            if ($contatoExistente && $contatoExistente->getId() != $id) {
                throw new \Exception("O contato informado já está cadastrado");
            }

            $pessoa = $this->entityManager->find(Pessoa::class, $pessoaId);

            if (!$pessoa) {
                throw new \Exception("Pessoa não encontrada com o id: " . $pessoaId);
            }

            $contato->setTipo($tipo);
            $contato->setDescricao($descricao);
            $contato->setPessoa($pessoa);
            $this->entityManager->flush();

            $tipoContato = Contato::getTipoContato();

            header("Location: /contatos");
            exit;
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao atualizar contato: " . $th->getMessage());
        }
    }

    public function excluirContato($id) {
        try {
            $contato = $this->entityManager->find(Contato::class, $id);

            if (!$contato) {
                throw new \Exception("Contato não encontrado com o id: " . $id);
            }

            $this->entityManager->remove($contato);
            $this->entityManager->flush();

            header('location: /contatos');
            exit;
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao excluir contato: " . $th->getMessage());
        }
    }

    public function validarContato($tipo, $descricao) {
        if ($tipo == "E-mail" && !filter_var($descricao, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('O e-mail é inválido');
        }

        if ($tipo == 'Telefone' && !preg_match('/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/', $descricao)) {
            throw new \Exception('O telefone é inválido');
        }
    }
}