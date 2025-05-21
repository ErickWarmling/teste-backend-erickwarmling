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
        <form action="/editarContato" method="POST">
            <label for="id">ID:</label>
            <br>
            <input type="text" name="idContato" id="idContato" readonly>
            <br>
            <label for="nome">Tipo:</label>
            <br>
            <select id="tipo_contato" name="tipo_contato" required>
                    <option></option>
            </select>
            <br>
            <label>Descrição:</label>
            <br>
            <input type="text" name="descricao" id="descricao">
            <br>
            <label for="cpf">Pessoa:</label>
            <br>
            <select id="pessoa" name="pessoa" required>
            </select>
            <br>
            <button class="botaoSalvar" type="submit">Salvar</button>
        </form>
        <a href="#">Voltar</a>
    </section>
</div>
</body>
</html>