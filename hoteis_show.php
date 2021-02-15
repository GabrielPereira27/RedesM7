<?php 
	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		
		if (!isset($_GET['hotel']) || !is_numeric($_GET['hotel'])) {
			echo '<script>alert("Erro ao abrir ator");</script>';
			echo 'Aguarde um momento. A reencaminhar página';
			header("refresh:5; url=index.php");
			exit();
		}
		$idHotel = $_GET['hotel'];
		$con = new mysqli("localhost", "root", "", "hoteis");

		if ($con->connect_errno != 0) 
		{
		echo "Ocorreu um erro no acesso à base de dados ".$con->connect_error;
		exit;
		}
		else{
			$sql = 'select * from hoteis where id = ?';
			$stm = $con->prepare($sql);
			if ($stm != false) {
				$stm -> bind_param('i', $idHotel);
				$stm -> execute();
				$res = $stm->get_result();
				$hotel = $res->fetch_assoc();
				$stm -> close();
			}
			else{
				echo '<br>';
				echo ($con->error);
				echo '<br>';
				echo "Aguarde um momento. A reencaminhar página";
				echo '<br>';
				header("refresh:5; url=index.php");
				exit();
			}
		}
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Detalhes</title>
	</head>
	<body>	
		<h1>Detalhes do hotel:</h1>
		<?php 
			if (isset($hotel)) 
			{
				echo "<h2>Nome Hotel:</h2>";
				echo utf8_encode($hotel['hotel']);
				echo '<br>';
				 ?> 
				 <img width="900" height="500" src="hot1.jpg">
				 <?php
			}
			else{
					echo '<h2>Parece que o hotel selecionado não existe. <br> Confirme sua seleção. </h2>';
				}
		?>
	</body>
	</html>