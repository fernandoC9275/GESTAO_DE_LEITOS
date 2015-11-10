<?php
// Conexão
include_once ('../oracle/connec.php');

$queryUnidadeInternacao = "SELECT UI.CD_UNID_INT, UI.DS_UNID_INT FROM UNID_INT UI WHERE UI.SN_ATIVO = 'S' ORDER BY UI.DS_UNID_INT";

?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Gestão de leitos</title>

<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="../../js/html5shiv.min.js"></script>
    <script src="../../js/respond.min.js"></script>
    <![endif]-->



</head>

<body>
	<!--  <div class="container-fluid" style="background-color:#CDCDCD;">
<h1>UI SÃO JOSÉ</h1>
</div>-->

	<div class="container-fluid ">
	<?php
	$sql = oci_parse ( $conexao, $queryUnidadeInternacao );
	oci_execute ( $sql );
	while ( ($row = oci_fetch_array ( $sql, OCI_BOTH )) != false ) {
		$cdUnidadeInternacao = $row ['CD_UNID_INT'];
		
		
		?>
	<div class="col-md-12 box-titulo text-uppercase">
			<h3><?php echo utf8_decode($row['DS_UNID_INT']);?></h3>
			<?php 
			
			$pagina = file_get_contents ("http://cssj-webdev/gestaodeleitos/leitos.php?unidadeInternacao=$cdUnidadeInternacao"); 
			
			?>
			</div>
			
			<?php 
			
			print_r($pagina);
			
			?>
			
			
	
	<?php } ?>
	</div>







	<!-- /container -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="js/jquery.min.js"></script>
	


</body>


</html>