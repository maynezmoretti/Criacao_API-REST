<?php
declare(strict_types=1);

header("Content-Type: application/json");

require "conexao.php";

$metodo = $_SERVER["REQUEST_METHOD"];

// Verifica se o método é POST
if ($metodo == "POST"){
    $json = file_get_contents("php://input");
    $dados = json_decode($json, true);
    $sql = "INSERT INTO chamados (equipamento, setor, descricao, prioridade, status) VALUES (?, ?, ?, ?, ?)";
    $comando = $pdo->prepare($sql);
    $comando->execute([
        $dados["equipamento"],
        $dados["setor"],
        $dados["descricao"],
        $dados["prioridade"],
        $dados["status"]
    ]);

    echo json_encode(["Mensagem" => "Novo chamado cadastrado!"]);
};


// Verifica se o método é GET
if ($metodo == "GET"){
    $sql = "SELECT * FROM chamados ORDER BY id";
    $comando = $pdo->query($sql);
    $chamados = $comando->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($chamados);
};


// Verifica se o método é PUT
if ($metodo == "PUT"){
    $json = file_get_contents("php://input");
    $dados = json_decode($json, true);
    $sql = "UPDATE chamados SET equipamento=?, setor=?, descricao=?, prioridade=?, status=? WHERE id=?";
    $comando = $pdo->prepare($sql);
    $comando->execute([
        $dados["equipamento"],
        $dados["setor"],
        $dados["descricao"],
        $dados["prioridade"],
        $dados["status"],
        $dados["id"]
    ]);

    echo json_encode(["Mensagem" => "Chamado atualizado com sucesso!"]);
};


// Verifica se o método é DELETE
if ($metodo == "DELETE"){
    $json = file_get_contents("php://input");
    $dados = json_decode($json, true);
    $sql = "DELETE FROM chamados WHERE id=?";
    $comando = $pdo->prepare($sql);
    $comando->execute([
        $dados["id"]
    ]);

    echo json_encode(["Mensagem" => "Chamado excluído com sucesso!"]);
};
?>