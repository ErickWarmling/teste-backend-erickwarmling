<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Contato</title>
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

    <section class="cadastro">
        <h1>Cadastrar Contato</h1>
        <form action="/cadastrarContato" method="POST">
            <label for="tipo">Tipo:</label>
            <br>
            <select id="tipo_contato" name="tipo_contato" required>
                <?php
                if (!empty($tipoContato)){
                foreach ($tipoContato as $tipo): ?>
                    <option value=<?= $tipo ?>><?= $tipo ?></option>
                <?php endforeach; } ?>
            </select>
            <br>
            <label>Descrição:</label>
            <br>
            <input type="text" name="descricao" id="descricao" placeholder="Informe o e-mail ou telefone" required>
            <br>
            <label for="pessoa">Pessoa:</label>
            <br>
            <select id="pessoa" name="pessoa" required>
                <?php
                if (!empty($pessoas)) {
                    foreach ($pessoas as $pessoa): ?>
                        <option value=<?= $pessoa->getId() ?>><?= $pessoa->getNome() ?></option>
                    <?php endforeach;
                } ?>
            </select>
            <br>
            <button class="botaoSalvar" type="submit">Salvar</button>
        </form>
        <a href="/contatos">Voltar</a>
    </section>
</div>
</body>
</html>

