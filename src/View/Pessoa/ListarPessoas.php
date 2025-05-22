<!DOCTYPE html>
<html>
<head>
    <title>Pessoas</title>
    <link rel="stylesheet" href="../../../public/styles.css?v=123">
</head>
<body>
<div class="container">
    <header>
        <nav class="menu_navegacao">
            <a href="/pessoas">Pessoas</a>
            <a href="/contatos">Contatos</a>
        </nav>
    </header>

    <section class="lista_pessoas">
        <div class="cabecalho">
            <h1>Pessoas</h1>
            <div class="pesquisa_pessoa">
                <form action="/buscarPessoa" method="GET">
                    <input class="inputPesquisaNome" type="text" name="nome" id="nome" placeholder="Informe o nome da pessoa">
                    <button class="botaoPadrao" type="submit">Pesquisar</button>
                </form>
                <button class="botaoPadrao" onclick="window.location.href='/cadastrarPessoa'">Nova Pessoa</button>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pessoas)) {
                    foreach ($pessoas as $pessoa): ?>
                        <tr>
                            <td><?php echo $pessoa->getId(); ?></td>
                            <td><?php echo $pessoa->getNome(); ?></td>
                            <td><?php echo $pessoa->getCpf(); ?></td>
                            <td class="opcoes">
                                <button class="botaoPadrao" onclick="window.location.href='/editarPessoa?id=<?= $pessoa->getId() ?>'">Editar</button>
                                <button class="botaoPadrao" onclick="window.location.href='/deletarPessoa?id=<?= $pessoa->getId() ?>'">Excluir</button>
                            </td>
                        </tr>
                    <?php endforeach;
                } ?>
            </tbody>
        </table>
    </section>
</div>
</body>
</html>