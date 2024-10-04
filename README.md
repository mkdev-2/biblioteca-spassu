# Biblioteca

## Índice

1. [Sobre o Projeto](#sobre-o-projeto)
2. [Pré-requisitos](#pré-requisitos)
3. [Instruções para Implantação](#instruções-para-implantação)
    - [Implantação Local](#implantação-local)
    - [Implantação via Docker](#implantação-via-docker)
4. [Estrutura do Banco de Dados](#estrutura-do-banco-de-dados)
5. [Como Executar Testes Unitários](#como-executar-testes-unitários)
6. [Resumo das Funcionalidades](#resumo-das-funcionalidades)
7. [Relatórios](#relatórios)
8. [Configurações de Arquivos .env](#configurações-de-arquivos-env)
9. [Mensuração de Cobertura de Testes](#mensuração-de-cobertura-de-testes)

---

## Sobre o Projeto

Este é um sistema proposto pela Spassu para gerenciamento de livros, autores e assuntos, com funcionalidades de cadastro, edição e associação de dados. A aplicação utiliza o framework Laravel para a lógica de backend e MySQL para persistência de dados.

---

## Pré-requisitos

Certifique-se de ter os seguintes softwares instalados no seu ambiente de desenvolvimento:

### Para Implantação Local
- **PHP 8.2** - Compatível com o framework Laravel utilizado.
- **Node.js e NPM** - Para instalar as dependências frontend.
- **Composer** - Para gerenciar as dependências do PHP.
- **MySQL** - Para o banco de dados.

### Para Implantação via Docker
- **Docker** - Para containerização e execução dos serviços.
- **Docker Compose** - Para orquestração dos containers da aplicação e banco de dados.

---

## Instruções para Implantação

### Implantação Local

1. **Clonando o Repositório**
    ```bash
    git clone https://github.com/seu_perfil/biblioteca-spassu.git
    cd biblioteca-spassu
    ```

2. **Instalação de Dependências**

    - **Dependências PHP** com Composer:
        ```bash
        composer install
        ```

    - **Dependências Node.js** com NPM:
        ```bash
        npm install
        ```

3. **Configuração do Arquivo `.env`**

    - Copie o arquivo `.env.example` para `.env`:
        ```bash
        cp .env.example .env
        ```

    - Configure as variáveis de ambiente para conectar ao banco de dados principal `biblioteca`.

    - Crie um arquivo `.env.testing` para o banco de testes:
        ```bash
        cp .env.example .env.testing
        ```
    - Configure as variáveis de ambiente para conectar ao banco de dados de testes `teste_biblioteca`.

4. **Criar e Configurar o Banco de Dados**

    - **Criar os Bancos de Dados**: Execute o comando para criar os bancos `biblioteca` e `teste_biblioteca`:
        ```bash
        php artisan db:create
        ```

    - **Rodar as Migrações**:
        - Para o banco de dados da aplicação (`biblioteca`):
            ```bash
            php artisan migrate
            ```
        - Para o banco de dados de testes (`teste_biblioteca`):
            ```bash
            php artisan migrate --env=testing
            ```

    - **(Opcional)**: Popular os bancos de dados com seeders.
        ```bash
        php artisan db:seed
        ```

5. **Compilação dos Recursos Frontend**
    ```bash
    npm run build
    ```

6. **Iniciar a Aplicação**
    ```bash
    php artisan serve
    ```
    Acesse a aplicação em `http://localhost:8000`.

### Implantação via Docker

1. **Pré-requisitos**

   Certifique-se de ter o Docker e o Docker Compose instalados em seu ambiente.

2. **Construindo e Iniciando os Containers**

    - Construa e inicie os containers com o comando:
        ```bash
        docker-compose up --build
        ```

    Este comando irá criar e configurar todos os serviços, incluindo a aplicação e o banco de dados.

3. **Criação de Arquivos `.env`**
    - Durante a inicialização do container, os arquivos `.env` e `.env.testing` serão gerados automaticamente a partir do `.env.example`.

4. **Configuração do Banco de Dados**

    - O Docker irá configurar o banco de dados com as variáveis de ambiente definidas (veja a seção sobre [Configurações de Arquivos .env](#configurações-de-arquivos-env)).

---

## Estrutura do Banco de Dados

### Tabela `assuntos`
- **Colunas**:
  - `CodAs`: Chave primária.
  - `Descricao`: String (até 20 caracteres).
  - `created_at` e `updated_at`: Timestamps.
  - `deleted_at`: Soft delete.

### Tabela `autores`
- **Colunas**:
  - `CodAu`: Chave primária.
  - `Nome`: String (até 40 caracteres).
  - `created_at` e `updated_at`: Timestamps.
  - `deleted_at`: Soft delete.

### Tabela `livros`
- **Colunas**:
  - `CodLi`: Chave primária.
  - `Titulo`: String (até 40 caracteres).
  - `Editora`: String (até 40 caracteres).
  - `Edicao`: Número inteiro.
  - `created_at` e `updated_at`: Timestamps.

### Tabelas de Relacionamento
#### Tabela `livro_assunto`
- Relaciona `livros` e `assuntos`.
- Chave estrangeira `Livro_CodLi` para `livros`.
- Chave estrangeira `Assunto_CodAs` para `assuntos`.

#### Tabela `livro_autor`
- Relaciona `livros` e `autores`.
- Chave estrangeira `Livro_CodLi` para `livros`.
- Chave estrangeira `Autor_CodAu` para `autores`.

---

## Relatórios

A aplicação permite a geração de vários tipos de relatórios para visualizar e analisar os dados cadastrados, como:

- Livros por Autor
- Livros por Assunto
- Livros por Editora
- Livros por Ano de Publicação
- Livros Mais Recentes
- Valor Total de Livros por Autor
- Livros por Faixa de Preço
- Livros com Múltiplos Autores
- Autores com Mais Publicações
- Assuntos com Mais Livros Associados

Os relatórios podem ser exportados para `.xlsx`, permitindo análise em ferramentas como Microsoft Excel ou Google Sheets.

---

## Configurações de Arquivos .env

A aplicação utiliza dois arquivos `.env` para configuração:

1. **.env**: Usado para o ambiente de produção/desenvolvimento.
2. **.env.testing**: Usado para o ambiente de testes.

### Valores Padrão para Docker

Durante a implantação via Docker, o sistema utiliza os seguintes valores padrão:

- **DB_CONNECTION**: `mysql`
- **DB_HOST**: `mysql` (nome do serviço Docker)
- **DB_PORT**: `3306`
- **DB_DATABASE**: `biblioteca`
- **DB_USERNAME**: `root`
- **DB_PASSWORD**: `password` (ou vazio, dependendo da configuração)

Esses valores podem ser modificados de acordo com as necessidades do seu ambiente.

---

## Como Executar Testes Unitários

1. **Executar todos os testes**:
    ```bash
    php artisan test
    ```

2. **Cobertura de Testes**: Certifique-se de cobrir todas as classes e métodos críticos da aplicação, especialmente funcionalidades como criação, edição e exclusão de livros, autores e assuntos.

---

## Mensuração de Cobertura de Testes

Para medir a cobertura dos testes, a aplicação utiliza o PHPUnit integrado ao Laravel.

### Executando Testes com Cobertura

1. **Rodando os testes e gerando o relatório de cobertura**:

    ```bash
    php artisan test --coverage-html build/coverage
    ```

    O comando acima irá rodar todos os testes e gerar um relatório de cobertura em HTML na pasta `build/coverage`.

2. **Acessando o Relatório de Cobertura**
   
   Após a execução, abra o arquivo `index.html` na pasta `build/coverage` em seu navegador para visualizar o relatório detalhado da cobertura de código.
