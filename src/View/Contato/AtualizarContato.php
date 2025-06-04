<!DOCTYPE html>
<html>
<head>
    <title>Editar Contato</title>
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
        <h1>Editar Contato</h1>
        <form id="form_contato" action="/editarContato?id=<?= $contato->getId() ?>" method="POST">
            <label for="id">ID:</label>
            <br>
            <input type="text" name="idContato" id="idContato" value="<?= $contato->getId() ?>" readonly>
            <br>
            <label for="tipo">Tipo:</label>
            <br>
            <select id="tipo_contato" name="tipo_contato" value="<?= $contato->getTipo() ?>" required>
                <?php
                if (!empty($tipoContato)){
                    foreach ($tipoContato as $tipo): ?>
                        <option value="<?= $tipo ?>" <?= ($tipo === $contato->getTipo()) ? 'selected' : '' ?>>
                            <?= $tipo ?>
                        </option>
                    <?php endforeach;} ?>
            </select>
            <br>
            <label>Descrição:</label>
            <br>
            <input type="text" name="descricao" id="descricao" value="<?= $contato->getDescricao() ?>" required>
            <br>
            <label for="pessoa">Pessoa:</label>
            <br>
            <select id="pessoa" name="pessoa">
                <?php
                if (!empty($pessoas)) {
                    foreach ($pessoas as $pessoa): ?>
                        <option value="<?= $pessoa->getId() ?>"
                            <?= $pessoa->getId() === $contato->getPessoa()->getId() ? 'selected' : '' ?>>
                            <?= $pessoa->getNome() ?>
                        </option>
                    <?php endforeach;} ?>
            </select>
            <br>
            <button class="botaoSalvar" type="submit">Salvar</button>
        </form>
        <a href="/contatos">Voltar</a>
    </section>
</div>
</body>
<script>
    document.getElementById('form_contato').addEventListener('submit', function (event) {
        const tipoContato = document.getElementById('tipo_contato').value;
        const descricao = document.getElementById('descricao').value.trim();

        if (tipoContato === 'Telefone') {
            const telefoneRegex = /^\(\d{2}\)\s9\d{4}-\d{4}$/;

            if (!telefoneRegex.test(descricao)) {
                alert("Informe um telefone válido, seguindo o padrão: (XX) XXXXX-XXXX");
                event.preventDefault();
                return;
            }
        }
    })
</script>
</html>