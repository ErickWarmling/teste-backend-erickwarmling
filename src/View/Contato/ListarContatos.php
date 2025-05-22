<!DOCTYPE html>
<html>
<head>
    <title>Contatos</title>
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

    <section class="lista-contatos">
        <h1>Contatos</h1>
        <button class="botaoNovoContato" onclick="window.location.href='/cadastrarContato'">Novo Contato</button>
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
                            <button class="botaoAcao" onclick="window.location.href='/editarPessoa?id=<?= $pessoa->getId() ?>'">Editar</button>
                            <button class="botaoAcao" onclick="window.location.href='/deletarPessoa?id=<?= $pessoa->getId() ?>'">Excluir</button>
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