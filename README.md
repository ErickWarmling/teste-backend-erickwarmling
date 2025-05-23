# Sistema de Gerenciamento de Contatos

💻 Repositório destinado ao desenvolvimento de um Sistema de Gerenciamento de Contatos, como parte do processo seletivo para a vaga de Estagiário de Desenvolvimento Back-end na [Magazord](https://www.magazord.com.br/).

## Tecnologias utilizadas

- **Ambiente de Desenvolvimento:** Docker
- **Arquitetura:** MVC (Model-View-Controller)
- **Back-end:** PHP
- **Banco de Dados:** PostgreSQL
- **Front-end:** HTML, CSS e JavaScript
- **Gerenciamento de Dependências:** Composer
- **ORM:** Doctrine

## Instruções de Execução do Sistema

### Configuração do Ambiente Docker

1. Verifique se o Docker e Docker Compose estão instalados
2. Clone o repositório do GitHub:
   ``` bash
   git clone https://github.com/ErickWarmling/teste-backend-erickwarmling.git
   cd teste-backend-erickwarmling/
   ```
3. Inicie os contêiners:
   ``` bash
   docker-compose up -d
   ```
**Observação:** Os comandos 4 e 5 devem ser executados apenas se o Banco de Dados ainda não tiver sido inicializado ou caso tenham sido feitas alterações nas entidades. 

4. Acesse o container PHP:
   ``` bash
   docker exec -it sistema-contatos-php bash
   ```

5. Crie as entidades no Banco de Dados
   <br>
   Execute o comando dentro do contêiner para criar as tabelas conforme as entidades:
   ``` bash
   php bin/doctrine.php orm:schema-tool:create
   ```

### Funcionamento do Sistema

1. Acesse o sistema no navegador com a seguinte URL:
   ``` bash
   http://localhost:8000
   ```
   
2. Navegue pelas funcionalidades do sistema:
   - **Listar Pessoas:** Página inicial do sistema, com um campo de pesquisa e com a lista de pessoas cadastradas.
   - **Cadastrar Pessoa:** Permite adicionar uma nova pessoa.
   - **Editar Pessoa:** Permite alterar os dados de uma pessoa já cadastrada.
   - **Excluir Pessoa:** Remove uma pessoa do sistema.
   - **Listar Contatos:** Exibe uma lista de contatos associados às pessoas.
   - **Cadastrar Contato:** Permite adicionar um novo contato.
   - **Editar Contato:** Permite alterar os dados de um contato.
   - **Excluir Contato:** Remove um contato do sistema.

### Imagens do Sistema
![image](https://github.com/user-attachments/assets/c0da882a-2999-40e9-9666-d83e48e827c2)
![image](https://github.com/user-attachments/assets/22129225-26f5-423e-ad5e-26c645daeffa)
![image](https://github.com/user-attachments/assets/93012979-6718-4d7d-b092-96bac39508de)
![image](https://github.com/user-attachments/assets/0c8bfc00-7161-4058-976b-dbf7f3bdc3d1)


### Considerações Finais

Coloco-me à disposição para esclarecer quaisquer dúvidas em relação ao projeto desenvolvido.

Erick Augusto Warmling
<br>
E-mail: [warmling.erick@gmail.com](mailto:warmling.erick@gmail.com)
