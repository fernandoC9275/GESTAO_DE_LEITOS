<?php
// Conexão
include_once ('../oracle/connec.php');

$UI = $_GET ['unidadeInternacao'];

$query = "SELECT 
L.DS_RESUMO,  
L.CD_UNID_INT,
TP_OCUPACAO,
CASE
  WHEN
    L.TP_OCUPACAO = 'O'
    THEN 'OCUPADO'
    WHEN L.TP_OCUPACAO = 'L'
    THEN 'LIMPEZA'
    WHEN L.TP_OCUPACAO = 'V'
    THEN 'VAGO'
    WHEN L.TP_OCUPACAO = 'M'
    THEN 'MANUTENÇÃO'  
    WHEN L.TP_OCUPACAO = 'R'
    THEN 'RESERVADO'  
    WHEN L.TP_OCUPACAO = 'T'
    THEN 'INTERDITADO'  
    ELSE L.TP_OCUPACAO
 END DS_OCUPACAO
FROM LEITO L 
WHERE L.CD_UNID_INT = $UI
ORDER BY 1,2 ASC 
";

$sql = oci_parse ( $conexao, $query );
oci_execute ( $sql );

while ( ($row = oci_fetch_array ( $sql, OCI_BOTH )) != false ) {
	
	if($row['TP_OCUPACAO']=='O'){
		$cor = 'bg-ocupado';
	}else if($row['TP_OCUPACAO']=='L'){
		$cor = 'bg-limpeza';
	}else if($row['TP_OCUPACAO']=='V'){
		$cor = 'bg-vago';
	}else if($row['TP_OCUPACAO']=='M'){
		$cor = 'bg-manutencao';
	}else if($row['TP_OCUPACAO']=='R'){
		$cor = 'bg-reservado';
	}else if($row['TP_OCUPACAO']=='T'){
		$cor = 'bg-interditado';
	}
	
	?>

<div class="col-md-1 box text-uppercase <?php echo $cor; ?>">
	<p class="texto-box"><?php echo $row['DS_RESUMO'];?> </p>
	<p> <?php  echo $row['DS_OCUPACAO']; ?></p>
</div>

<?php }?>
    
    
    
   