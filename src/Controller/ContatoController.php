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
            $pessoa = $this->entityManager->find(Pessoa::class, $pessoaId);

            if(!$pessoa) {
                throw new \Exception("Pessoa não encontrada com o id: " . $pessoaId);
                return;
            }

            $contato = new Contato();
            $contato->setTipo($tipo);
            $contato->setDescricao($descricao);
            $contato->setPessoa($pessoa);
            $this->entityManager->persist($contato);
            $this->entityManager->flush();

            $tipoContato = Contato::getTipoContato();
            $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();

            require __DIR__ . '/../View/Contato/CadastrarContato.php';
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao criar contato: " . $th->getMessage());
        }
    }

    public function atualizarContato($id, $tipo, $descricao) {
        try {
            $contato = $this->entityManager->find(Contato::class, $id);

            if (!$contato) {
                throw new \Exception("Contato não encontrado com o id: " . $id);
                return;
            }

            $contato->setTipo($tipo);
            $contato->setDescricao($descricao);
            $this->entityManager->flush();

            $tipoContato = Contato::getTipoContato();

            require __DIR__ . '/../View/Contato/AtualizarContato.php';
        } catch (\Throwable $th) {
            throw new \Exception("Erro ao atualizar contato: " . $th->getMessage());
        }
    }

    public function excluirContato($id) {
        try {
            $contato = $this->entityManager->find(Contato::class, $id);

            if (!$contato) {
                throw new \Exception("Contato não encontrado com o id: " . $id);
                return;
            }

            $this->entityManager->remove($contato);
            $this->entityManager->flush();

        } catch (\Throwable $th) {
            throw new \Exception("Erro ao excluir contato: " . $th->getMessage());
        }
    }
}