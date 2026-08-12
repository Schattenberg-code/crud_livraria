# CRUD Livraria

Sistema CRUD para gerenciamento de livros, permitindo cadastrar, listar, editar e excluir livros.

## Objetivo

Esta atividade tem como principal objetivo aplicar o conceito de **Prepared Statements** no desenvolvimento de operações com banco de dados, aumentando a segurança da aplicação e ajudando a prevenir vulnerabilidades de **SQL Injection**.

## Requisitos Funcionais

### RF1 — Cadastrar Livro
O sistema deve permitir o cadastro de livros informando:
- Título
- Autor
- Ano de publicação

### RF2 — Listar Livros
O sistema deve apresentar todos os livros cadastrados no sistema.

### RF3 — Editar Livro
O sistema deve permitir a alteração das informações de livros já cadastrados.

### RF4 — Excluir Livro
O sistema deve permitir a exclusão de livros já cadastrados.

## Requisitos Não Funcionais

### RNF1 — Validação dos Campos
O sistema não deve permitir o cadastro de livros com os campos de título, autor ou ano de publicação vazios.

### RNF2 — Segurança
O sistema deve utilizar **Prepared Statements** nas operações com o banco de dados, aumentando a segurança da aplicação e ajudando a prevenir vulnerabilidades de **SQL Injection**.