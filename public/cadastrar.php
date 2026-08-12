<?php

include "../infra/conexao.php";

$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$ano = $_POST["ano"];

$sql = "INSERT INTO livros (titulo,autor,ano) VALUES (?,?,?)";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("ssi", $titulo, $autor, $ano);
$stmt->execute();

header("Location: ../index.php");
?>