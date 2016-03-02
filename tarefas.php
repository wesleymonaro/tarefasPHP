<?php
include "banco.php";
include "ajudantes.php";
$exibir_tabela = true;

session_start();
    $lista_tarefas = array();  // A variável $lista_tarefas receberá uma array para poder receber vários valores

    if(isset($_POST['nome']) && $_POST['nome'] != ''){

    	$tarefa = array();
    	$tarefa['nome'] = $_POST['nome'];

    	if(isset($_POST['descricao'])){
    		$tarefa['descricao'] = $_POST['descricao'];
    	}else{
    		$tarefa['descricao'] = '';
    	}

    	if (isset($_POST['prazo'])) {
    		$tarefa['prazo'] = traduz_data_para_banco($_POST['prazo']);
    	} else {
    		$tarefa['prazo'] = '';
    	}

    	$tarefa['prioridade'] = $_POST['prioridade'];

    	if (isset($_POST['concluida'])) {
    		$tarefa['concluida'] = 1;
    	} else {
    		$tarefa['concluida'] = 0;
    	}

    	gravar_tarefa($conexao, $tarefa);
    	header('Location: tarefas.php');
		die();
    }  
    $lista_tarefas = listar_tarefas($conexao);  

    $tarefa = array(
    	'id' => 0,
    	'nome' => '',
    	'descricao' => '',
    	'prazo' => '',
    	'prioridade' => 1,
    	'concluida' => ''
    	);

    include "template.php";
    ?>