<?php
    include('../../conexao.php');
    session_start();
    if(!isset($_SESSION['id']) || $_SESSION['id'] == ''){
        $data = ["ruturn" => "Usuário não logado"];
        echo json_encode($data);
        exit;
    }

    $titulo = $_POST['titulo'];
    $prazo = $_POST['prazo'];
    $atuacao = $_POST['atuacao'];
    $descricao = $_POST['descricao'];

    $titulo = utf8_decode($titulo);
    $atuacao = utf8_decode($atuacao);
    $descricao = utf8_decode($descricao);

    $select = "SELECT usuario.email, cliente.id FROM usuario JOIN cliente ON usuario.idCliente = cliente.id WHERE usuario.id = ".$_SESSION['id'];

    $resultado = mysqli_query($conecta, $select);
    $result = mysqli_fetch_array($resultado);

    $sql = "INSERT INTO trabalhospublicados (titulo, prazo, atuacao, descricao, idCliente) VALUES ('".$titulo."', '".$prazo."', '".$atuacao."', '".$descricao."', '".$result['id']."')";

    if(mysqli_query($conecta, $sql)){
        $data = array("return" => true);
    }else{
        $data = array("return" => mysqli_error($conecta));
    }

    echo json_encode($data);