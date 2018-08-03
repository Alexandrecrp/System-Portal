<?php
session_start();

//Incluir a conexao com BD
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "logsystem";

//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

//Receber os dados do formulário
//$arquivo = $_FILES['arquivo'];
//var_dump($arquivo);
$arquivo_tmp = $_FILES['arquivo']['tmp_name'];

//ler todo o arquivo para um array
$dados = file($arquivo_tmp);
//var_dump($dados);


/*INICIO DA MAGICA*/
require_once("enviarEmail.php");
$tem_cotacao = false;
$tem_fornecedor = false;
$tem_produto = false;
$cotacao_ja_enviada = false;
$erro_msg = "Arquivo inválido! ";
$erro = false;
$lista_sql_insert = "";

foreach($dados as $key => $linha){
	$linha = trim($linha);
	$valor = explode('|', $linha);
	$tipo = $valor[0];
	$id = $valor[1];

	if ($tipo == "C") {
		if($key > 0 || $tem_cotacao) {
			$erro = true;
			$erro_msg .= "Arquivo com mais de um cliente.";
		} else if (count($valor)<8) {
			$erro = true;
			$erro_msg .= "Cliente com colunas insuficientes.";
		} else {
			$sql_cotacao = "SELECT count(id) FROM clientes WHERE id = '".$id."';";
	
			$resultado_cotacao = mysqli_query($conn, $result_produto);
			if ($resultado_cotacao && $resultado_cotacao >0 ) {
				$erro = true;
				$erro_msg .= "Cliente já cadastrado.";
			} else {
				$tem_cotacao = true;
				$lista_sql_insert .= "INSERT INTO clientes (id, cliente_campo1, cliente_campo2, cliente_campo3, cliente_campo4, cliente_campo5, cliente_campo6) VALUES ('".$valor[1]."', '".$valor[2]."', '".$valor[3]."', '".$valor[4]."', '".$valor[5]."', '".$valor[6]."', '".$valor[7]."');";
			}
		}
	} else if ($tipo == "F") {
		if($key == 0) {
			$erro = true;
			$erro_msg .= "Cotação deve ser primeiro item.";
		} else if (count($valor)<13) {
			$erro = true;
			$erro_msg .= "Fornecedor com colunas insuficientes.";
		} else {
			if(!$tem_fornecedor) $tem_fornecedor = true;
			$lista_sql_insert .= "INSERT INTO fornecedores (id, fornecedor_campo1, fornecedor_campo2, fornecedor_campo3, fornecedor_campo4, fornecedor_campo5, fornecedor_campo6, fornecedor_campo7, fornecedor_campo8, fornecedor_campo9, fornecedor_campo10, fornecedor_campo11, fornecedor_campo12) VALUES ('".$valor[1]."', '".$valor[2]."', '".$valor[3]."', '".$valor[4]."', '".$valor[5]."', '".$valor[6]."', '".$valor[7]."', '".$valor[8]."', '".$valor[9]."', '".$valor[10]."', '".$valor[11]."', '".$valor[12]."');";
			$mensagem = "Você esta recebendo este e-mail, por que foi solicitado uma cotação nova através do site NOME_SITE, clique no link abaixo para visualizar. <br /><a href='http://localhost/painel.php'>Acessar Site</a>";
			enviarEmail($_POST['txtEmail'], "Prezado", "Solicitação de cotação", $mensagem);
		}
	} else if ($tipo == "P") {
		if($key == 0 || !$tem_cotacao) {
			$erro = true;
			$erro_msg .= "Cotação deve ser primeiro item.";
		} else if (count($valor)<8) {
			$erro = true;
			$erro_msg .= "Produto com colunas insuficientes.";
		} else if(!$tem_fornecedor) {
			$erro = true;
			$erro_msg .= "Produto deve vir após cotação e fornecedores.";
		} else {
			if(!$tem_produto) $tem_produto = true;
			$lista_sql_insert .= "INSERT INTO produtos (id, produto_campo1, produto_campo2, produto_campo3, produto_campo4, produto_campo5, produto_campo6) VALUES ('".$valor[1]."', '".$valor[2]."', '".$valor[3]."', '".$valor[4]."', '".$valor[5]."', '".$valor[6]."', '".$valor[7]."');";
		}
	} else {
		$erro = true;
	}
	
	
}

if(!$erro) {
	
	$lista_sql = mysqli_query($conn, $lista_sql_insert);
	$_SESSION['msg'] = "<p style='color: green;'>Carregado os dados com sucesso!</p>";
} else {
	$_SESSION['msg'] = $erro;
}
header("Location: painel.php");
?>
