<!DOCTYPE html>
<html>
<head>
    <title>Contatos</title>
    <link rel="stylesheet" href="../../../public/styles.css">
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
        <div class="cabecalho-contatos">
            <h1>Contatos</h1>
            <button class="botaoPadrao" onclick="window.location.href='/cadastrarContato'">Novo Contato</button>
        </div>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Pessoa</th>
                <th>Opções</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($contatos)) {
                foreach ($contatos as $contato): ?>
                    <tr>
                        <td><?php echo $contato->getId(); ?></td>
                        <td><?php echo $contato->getTipo(); ?></td>
                        <td><?php echo $contato->getDescricao(); ?></td>
                        <td><?php echo $contato->getPessoa()->getNome(); ?></td>
                        <td class="opcoes">
                            <button class="botaoPadrao" onclick="window.location.href='/editarContato?id=<?= $contato->getId() ?>'">Editar</button>
                            <button class="botaoPadrao" onclick="window.location.href='/deletarContato?id=<?= $contato->getId() ?>'">Excluir</button>
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