<?php
include "../infra/conexao.php";
$id = $_GET["id"];

$sql = "DELETE FROM livros WHERE id=?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt-> execute();

header("Location: ../index.php");
?>