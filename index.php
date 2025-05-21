<?php
require_once "vendor/autoload.php";

use Controller\ContatoController;
use Doctrine\ORM\Tools\Setup;

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
        if ($metodoHTTP == 'POST') {
            $id = $_GET['idPessoa'];
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];

            $pessoaController->atualizarPessoa($id, $nome, $cpf);
        }
        break;

        case '/deletarPessoa':
            if ($metodoHTTP == 'GET') {
                $id = $_GET['idPessoa'];

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
            if ($metodoHTTP == 'POST') {
                $tipo = $_POST['tipo_contato'];
                $descricao = $_POST['descricao'];
                $pessoaId = $_POST['pessoa'];

                $contatoController->criarContato($tipo, $descricao, $pessoaId);
            }
            break;

        case '/editarContato':
            if ($metodoHTTP == 'POST') {
                $id = $_GET['idContato'];
                $tipo = $_POST['tipo_contato'];
                $descricao = $_POST['descricao'];

                $contatoController->atualizarContato($id, $tipo, $descricao);
            }
            break;

        case '/deletarContato':
            if ($metodoHTTP == 'GET') {
                $id = $_GET['idContato'];

                $contatoController->excluirContato($id);
            }
            break;
}