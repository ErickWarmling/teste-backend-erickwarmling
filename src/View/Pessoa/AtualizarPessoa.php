<!DOCTYPE html>
<html>
<head>
    <title>Editar Pessoa</title>
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
        <h1>Editar Pessoa</h1>
        <form id="form_pessoa" action="/editarPessoa?id=<?= $pessoa->getId() ?>" method="POST">
            <label for="id">ID:</label>
            <br>
            <input type="text" name="idPessoa" id="idPessoa" value="<?= $pessoa->getId() ?>" readonly>
            <br>
            <label for="nome">Nome:</label>
            <br>
            <input type="text" name="nome" id="nome" value="<?= $pessoa->getNome() ?>" required>
            <br>
            <label for="cpf">CPF:</label>
            <br>
            <input type="text" name="cpf" id="cpf" maxlength="14" value="<?= $pessoa->getCpf() ?>" required>
            <br>
            <button class="botaoSalvar" type="submit">Salvar</button>
        </form>
        <a href="/pessoas">Voltar</a>
    </section>
</div>
</body>
<script>
    document.getElementById('form_pessoa').addEventListener('submit', function (event) {
        const cpf = document.getElementById('cpf').value.trim();

        const cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;

        if (!cpfRegex.test(cpf)) {
            alert("Informe um CPF válido, seguindo o padrão: 000.000.000-00");
            event.preventDefault();
            return;
        }
    })
</script>
</html>