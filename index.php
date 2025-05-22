<?php
require_once "vendor/autoload.php";

use Controller\ContatoController;
use Controller\PessoaController;
use Doctrine\ORM\Tools\Setup;
use Model\Contato;
use Model\Pessoa;

$entityManager = require __DIR__ . "/config/bootstrap.php";

$pessoaController = new \Controller\PessoaController($entityManager);
$contatoController = new \Controller\ContatoController($entityManager);

$rota = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$metodoHTTP = $_SERVER["REQUEST_METHOD"];

switch ($rota) {
    case '/':
        header("Location: /pessoas");
        break;

    case '/pessoas':
        if ($metodoHTTP == 'GET') {
            $pessoaController->listarPessoas();
        }
        break;

    case '/cadastrarPessoa':
        if ($metodoHTTP == 'GET') {
            require __DIR__ . '/src/View/Pessoa/CadastrarPessoa.php';
        }

        if ($metodoHTTP == 'POST') {
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];

            $pessoaController->criarPessoa($nome, $cpf);
            header("Location: /pessoas");
        }
        break;

    case '/editarPessoa':
        if ($metodoHTTP == 'GET') {
            $id =$_GET['id'];

            if ($id) {
                $pessoa = $entityManager->find(\Model\Pessoa::class, $id);
            }

            require __DIR__ . '/src/View/Pessoa/AtualizarPessoa.php';
        }

        if ($metodoHTTP == 'POST') {
            $id = $_GET['id'];
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];

            $pessoaController->atualizarPessoa($id, $nome, $cpf);
        }
        break;

        case '/deletarPessoa':
            if ($metodoHTTP == 'GET') {
                $id = $_GET['id'];

                $pessoaController->excluirPessoa($id);
            }
            break;

        case '/buscarPessoa':
            if ($metodoHTTP == 'GET') {
                $nome = $_GET['nome'];

                $pessoaController->buscarPessoaPorNome($nome);
            }
            break;

        case '/contatos':
            if ($metodoHTTP == 'GET') {
                $contatoController->listarContatos();
            }
            break;

        case '/cadastrarContato':
            if ($metodoHTTP == 'GET') {
                $tipoContato = Contato::getTipoContato();
                $pessoas = $entityManager->getRepository(\Model\Pessoa::class)->findAll();

                require __DIR__ . '/src/View/Contato/CadastrarContato.php';
            }

            if ($metodoHTTP == 'POST') {
                $tipo = $_POST['tipo_contato'];
                $descricao = $_POST['descricao'];
                $pessoaId = $_POST['pessoa'];

                $contatoController->criarContato($tipo, $descricao, $pessoaId);
            }
            break;

        case '/editarContato':
            if ($metodoHTTP == 'GET') {
                $id = $_GET['id'];

                if ($id) {
                    $contato = $entityManager->find(\Model\Contato::class, $id);
                    $tipoContato = \Model\Contato::getTipoContato();
                    $pessoas = $entityManager->getRepository(\Model\Pessoa::class)->findAll();
                }

                require __DIR__ . '/src/View/Contato/AtualizarContato.php';
            }

            if ($metodoHTTP == 'POST') {
                $id = $_GET['id'];
                $tipo = $_POST['tipo_contato'];
                $descricao = $_POST['descricao'];
                $pessoaId = $_POST['pessoa'];

                $contatoController->atualizarContato($id, $tipo, $descricao, $pessoaId);
            }
            break;

        case '/deletarContato':
            if ($metodoHTTP == 'GET') {
                $id = $_GET['id'];

                $contatoController->excluirContato($id);
            }
            break;
}