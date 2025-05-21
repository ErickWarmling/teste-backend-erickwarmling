<!DOCTYPE html>
<html>
<head>
    <title>Pessoas</title>
    <link rel="stylesheet" href="../../../public/styles.css">
</head>
<body>
<div class="container">
    <header>
        <nav class="menu_navegacao">
            <a href="#">Pessoas</a>
            <a href="#">Contatos</a>
        </nav>
    </header>

    <section class="lista_pessoas">
        <div class="cabecalho">
            <h1>Pessoas</h1>
            <div class="pesquisa_pessoa">
                <form action="/buscarPessoa" method="GET">
                    <input type="text" name="nome" id="nome" placeholder="Informe o nome da pessoa">
                    <button class="botaoPesquisar" type="submit">Pesquisar</button>
                </form>
                <button class="botaoNovo" onclick="window.location.href='/cadastrarPessoa'">Nova Pessoa</button>
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
                            <td>
                                <button class="botaoAcao">Editar</button>
                                <button class="botaoAcao">Excluir</button>
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