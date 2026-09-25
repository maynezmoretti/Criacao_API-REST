<?php

$host = "SEU_IP";
$usuario = "SEU_USUARIO";
$senha = "SUA_SENHA";
$banco = "SEU_BANCO";

$pdo = new PDO(
    "pgsql:host=$host;port=5432;dbname=$banco",
    $usuario,
    $senha
);

?>