<?php

include "../infra/conexao.php";

$id = $_POST["id"];
$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$ano = $_POST["ano"];

$sql = "UPDATE livros SET titulo=?,autor=?,ano=? WHERE id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("ssii", $titulo, $autor, $ano, $id);
$stmt->execute();

header("Location: ../index.php");
