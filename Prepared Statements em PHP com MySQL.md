# Prepared Statements em PHP com MySQL

**Lucas Acacio Schattenberg**

## O que é Prepared Statements e SQL Injection

Declarações preparadas são uma forma segura de executar comandos em SQL, principalmente quando há a inserção de dados por um formulário.

O método de inserção evita SQL Injection, que consiste em utilizar comandos SQL em algum campo do formulário disponível para o usuário.

Imagine o seguinte comando:

```php
$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

$sql = "SELECT * FROM usuario
WHERE usuario = '$usuario' AND senha = '$senha'";

$resultado = $conn->query($sql);
```

Neste código existe uma vulnerabilidade de **SQL Injection**, pois os valores da variável `$_POST` são inseridos diretamente na consulta SQL. A variável `$sql` é uma consulta que representa um comando executado no SQL.

O valor fornecido pelo usuário é concatenado diretamente à consulta SQL, podendo alterar sua estrutura. Caso um usuário malicioso tente colocar um comando SQL como um nome de usuário, em vez de ser tratado apenas como texto, isso pode ocorrer por meio da utilização de caracteres especiais, como `'` e `"`.

Por exemplo:

Caso o usuário malicioso tenha preenchido no formulário o campo usuário como:

```text
';DELETE FROM usuario WHERE NOME LIKE...';
```

A entrada poderá alterar a estrutura da consulta SQL, em uma aplicação vulnerável, possibilitando a execução de uma operação de exclusão de usuários do banco de dados.

## Como se proteger?

Para evitar SQL Injection, utilizamos **Prepared Statements** (declarações preparadas). Assim, os valores fornecidos pelo usuário não são inseridos diretamente na consulta SQL. Em vez disso, utilizamos `?` como um tipo de placeholder, que posteriormente receberão os valores.

Por exemplo:

```php
$sql = "SELECT * FROM usuario WHERE usuario = ? AND senha = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("ss", $usuario, $senha);
$stmt->execute();
$resultado = $stmt->get_result();
```

Aqui, os `?` são os **placeholders**. Eles representam os valores que serão fornecidos posteriormente.

O `prepare()` prepara a consulta SQL para ser executada. Nesse momento, os valores do usuário ainda não foram inseridos na consulta.

O `bind_param()` associa os valores aos `?`.

O `"ss"` significa:

- `s` → `$usuario`
- `s` → `$senha`

Ou seja, os dois valores são tratados como **strings**. Caso haja um valor `int` (inteiro), deve-se utilizar um `i` ao invés de um `s`.

O `execute()` executa a consulta já preparada com os valores fornecidos.

O `get_result()` obtém o resultado retornado pelo `SELECT`.

## Aplicação no código

No código fornecido pelo professor temos o seguinte cenário em `cadastrar.php`:

```php
$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$ano = $_POST["ano"];

$sql = "INSERT INTO livros (titulo,autor,ano) VALUES ('$titulo','$autor','$ano')";

mysqli_query($conexao, $sql);
```

Aqui percebemos uma vulnerabilidade de **SQL Injection** no código, pois a variável `$sql` recebe dados diretamente da variável `$_POST` na consulta SQL.

Para corrigir isso basta utilizar o método **Prepared Statements**, ficando assim:

```php
$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$ano = $_POST["ano"];

$sql = "INSERT INTO livros (titulo,autor,ano) VALUES (?,?,?)";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("ssi", $titulo, $autor, $ano);
$stmt->execute();
```

Assim o método de **Prepared Statements** funciona perfeitamente. Basta utilizar `?` como placeholders na consulta SQL, aumentando a segurança do código, uma vez que o método irá posteriormente vincular os devidos valores das variáveis utilizando `bind_param()` para associar os valores das variáveis `$titulo`, `$autor` e `$ano` aos seus respectivos placeholders (`?`).

Nota-se a falta de um comando que envie os códigos como:

```php
mysqli_query($conexao, $sql);
```

uma vez que:

```php
$stmt->execute();
```

já é responsável por executar a instrução SQL preparada, não sendo necessário utilizar novamente um comando `mysqli`.

## Por que utilizar esse método e sua importância?

O método **Prepared Statements** é muito importante em códigos que utilizam banco de dados, pois ajuda a prevenir uma das principais vulnerabilidades relacionadas ao SQL: o **SQL Injection**.

Dessa forma, aumenta a segurança do código, separando os dados fornecidos pelos usuários das instruções SQL.

Por esse e outros motivos, o uso de **Prepared Statements** é considerado uma boa prática e é indispensável em códigos que utilizam algum banco de dados.

## Link do Fork do repositório com a tentativa de implementação

[GitHub - crud_livraria](https://github.com/Schattenberg-code/crud_livraria)