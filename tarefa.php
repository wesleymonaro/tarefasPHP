<?php
include "banco.php";
include "ajudantes.php";
$tem_erros = false;
$erros_validacao = array();
if (isset($_POST['id'])) {
// upload dos anexos
	// upload dos anexos
	$tarefa_id = $_POST['tarefa_id'];
	if (! isset($_FILES['anexo'])) {
		$tem_erros = true;
		$erros_validacao['anexo'] =
		'Você deve selecionar um arquivo para anexar';
	} else {
		if (tratar_anexo($_FILES['anexo'])) {
			$anexo = array();
			$anexo['tarefa_id'] = $tarefa_id;
			$anexo['nome'] = $_FILES['anexo']['name'];
			$anexo['arquivo'] = $_FILES['anexo']['name'];
			gravar_anexo($conexao, $anexo);
		} else {
			$tem_erros = true;
			$erros_validacao['anexo'] =
			'Envie apenas anexos nos formatos zip ou pdf';
		}
	}
}


$tarefa = buscar_tarefa($conexao, $_GET['id']);
$anexos = buscar_anexos($conexao, $_GET['id']);
include "template_tarefa.php";