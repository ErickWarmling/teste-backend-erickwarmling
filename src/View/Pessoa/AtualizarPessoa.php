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
        <form action="/editarPessoa" method="POST">
            <label for="id">ID:</label>
            <br>
            <input type="text" name="idPessoa" id="idPessoa">
            <br>
            <label for="nome">Nome:</label>
            <br>
            <input type="text" name="nome" id="nome">
            <br>
            <label for="cpf">CPF:</label>
            <br>
            <input type="text" name="cpf" id="cpf">
            <br>
            <button class="botaoSalvar" type="submit">Salvar</button>
        </form>
        <a href="/pessoas">Voltar</a>
    </section>
</div>
</body>
</html>


