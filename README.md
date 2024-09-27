
# Biblioteca

## Índice

1. [Sobre o Projeto](#sobre-o-projeto)
2. [Pré-requisitos](#pré-requisitos)
3. [Instruções para Implantação](#instruções-para-implantação)
4. [Estrutura do Banco de Dados](#estrutura-do-banco-de-dados)
5. [Como Executar Testes Unitários](#como-executar-testes-unitários)
6. [Resumo das Funcionalidades](#resumo-das-funcionalidades)
7. [Relatórios](#relatórios)
8. [Exemplo de Testes](#exemplo-de-testes)

---

## Sobre o Projeto

Este é um sistema proposto pela Spassu para gerenciamento de livros, autores e assuntos, com funcionalidades de cadastro, edição e associação de dados. A aplicação utiliza o framework Laravel para a lógica de backend e MySQL para persistência de dados.

## Pré-requisitos

Certifique-se de ter os seguintes softwares instalados no seu ambiente de desenvolvimento:

- **PHP 8.2** (compatível com o framework Laravel utilizado).
- **Node.js e NPM** (para instalar as dependências frontend).
- **Composer** (para gerenciar as dependências do PHP).
- **MySQL** (para o banco de dados).

## Instruções para Implantação

### 1. Clonando o Repositório
```bash
git clone https://github.com/seu_perfil/biblioteca-spassu.git
cd biblioteca-spassu
```

### 2. Instalação de Dependências

- **Instalar dependências PHP** com Composer:
    ```bash
    composer install
    ```

- **Instalar dependências Node.js** com NPM:
    ```bash
    npm install
    ```

### 3. Configuração do Arquivo `.env`

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

### 4. Criar e Configurar o Banco de Dados

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

### 5. Compilação dos Recursos Frontend
```bash
npm run dev
```

### 6. Iniciar a Aplicação
Abra o terminal e digite:
```bash
php artisan serve
```
Acesse a aplicação em `http://localhost:8000`.

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

## Como Executar Testes Unitários

1. **Executar todos os testes**:
    ```bash
    php artisan test
    ```

2. **Cobertura de Testes**: Certifique-se de cobrir todas as classes e métodos críticos da aplicação, especialmente funcionalidades como criação, edição e exclusão de livros, autores e assuntos.

---

## Relatórios

A aplicação permite a geração de 4 tipos de relatórios para visualizar e analisar os dados cadastrados, como:
- Listagem de livros.
- Relatório de autores associados a livros.
- Relatório de assuntos categorizados.
- Relatório detalhado com filtros específicos.

Os relatórios podem ser exportados para `.xlsx`, permitindo análise em ferramentas como Microsoft Excel ou Google Sheets.

---

## Exemplo de Testes

Os testes são organizados nas pastas `Unit` e `Feature`. Abaixo está um exemplo de um teste localizado em `tests/RelatorioViewTest.php`:

```php
<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelatorioViewTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_loads_the_relatorio_view()
    {
        // Simula o acesso à rota que carrega a view de relatório
        $response = $this->get('/relatorio');

        // Verifica se a view foi carregada com sucesso (status 200)
        $response->assertStatus(200);
        $response->assertViewIs('relatorio.index');
    }
}
```

### Como Rodar o Teste Específico
Você pode rodar um teste específico usando o comando:
```bash
php artisan test --filter=RelatorioViewTest
```

Esse teste verifica se a rota `/relatorio` carrega a view correta (`relatorio.index`) e se responde com status 200.
