# API Invoices

Este é um projeto de uma API de sistema de faturas (invoices) desenvolvido em Laravel para fins de estudo.

## Funcionalidades

- **Criação de Faturas**: Permite a geração de novas faturas com detalhes como cliente, itens, valores e impostos.
- **Listagem de Faturas**: Exibe todas as faturas cadastradas no sistema.
- **Atualização de Faturas**: Possibilita a edição de informações de faturas existentes.
- **Exclusão de Faturas**: Permite remover faturas do sistema.

## Requisitos

- PHP >= 8.0
- Composer
- Banco de dados (por exemplo, MySQL)

## Instalação

1. **Clone o repositório**:

   ```bash
   git clone https://github.com/ricardolemaciel/api-invoices.git

2. **Navegue até o diretório do projeto**:

   ```bash
   cd api-invoices

3. **Instale as dependências**:

   ```bash
   composer install

4. **Configure o arquivo .env:**

    - Duplique o arquivo .env.example e renomeie para .env.
    - Atualize as configurações de banco de dados e outras variáveis conforme necessário.
  
5. **Gere a chave da aplicação:**

   ```bash
   php artisan key:generate

6. **Execute as migrações do banco de dados:**

   ```bash
   php artisan migrate

7. **Inicie o servidor de desenvolvimento:**

   ```bash
   php artisan serve
   
