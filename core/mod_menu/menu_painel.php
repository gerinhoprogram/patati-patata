<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/menu.css" rel="stylesheet" type="text/css" />
<script>
jQuery(document).ready(function()
{
	jQuery(".sub").hide();
 	jQuery("div.menus").click(function(){
		jQuery(this).toggleClass("active").next().slideToggle("slow");
		return false;
	});
});
</script>
</head>
<?php
function RetirarAcentos($frase) {
    $frase = str_replace(array("à","á","â","ã","ä","è","é","ê","ë","ì","í","î","ï","ò","ó","ô","õ","ö","ù","ú","û","ü","À","Á","Â","Ã","Ä","È","É","Ê","Ë","Ì","Í","Î","Ò","Ó","Ô","Õ","Ö","Ù","Ú","Û","Ü","ç","Ç","ñ","Ñ"),
                         array("a","a","a","a","a","e","e","e","e","i","i","i","i","o","o","o","o","o","u","u","u","u","A","A","A","A","A","E","E","E","E","I","I","I","O","O","O","O","O","U","U","U","U","c","C","n","N"), $frase);
 
    return $frase;                           
}
$sql = "SELECT usu_foto FROM admin_usuarios WHERE usu_id = :id ";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id',$_SESSION['usuario_id']);
$stmt->execute();
$foto = $stmt->fetch(PDO::FETCH_OBJ)->usu_foto;
if($foto == '')
{
	$foto = '../imagens/perfil.png';
}
?>
<body>
<div id='janela' class='janela' style='display:none;'> </div>
<div id='janelaAcao' class='janelaAcao' style='display:none;'> </div>
<div class="containermenu bodytext">
    <div class="textomenu"> 
    	<div id="logo">
	        <img src="../imagens/logo.png" border="0" />	
        </div>
    	<div id='usuario'>
        	<a href='meu_perfil.php?pagina=meu_perfil<?php echo $autenticacao;?>'>
        	<img src='../admin/imagem.php?arquivo=<?php echo $foto;?>&largura=80&altura=80&marca=mini' border='0' title='Meu Perfil' />
            </a>
            <div class='info'>
          		<span class='nome'><?php echo $n;?></span><br /><span class='setor'><?php echo $_SESSION['setor_nome'];?></span>
           	</div>
        </div>
    	<div class="menu"><a href="admin.php?<?php echo $autenticacao;?>" class="top_link" target="_parent"><img src="../imagens/icon-home.png" border="0" valign='top' /> &nbsp;&nbsp; Dashboard</a></div> 
        <?php
			$sql = "SELECT * FROM admin_setores_permissoes
					LEFT JOIN admin_submodulos ON admin_submodulos.sub_id = admin_setores_permissoes.sep_submodulo
					INNER JOIN admin_modulos ON admin_modulos.mod_id = admin_setores_permissoes.sep_modulo 
					INNER JOIN ( admin_setores 
						INNER JOIN admin_usuarios 
						ON admin_usuarios.usu_setor = admin_setores.set_id )
					ON admin_setores.set_id = admin_setores_permissoes.sep_setor
					WHERE sep_setor = :setor
					GROUP BY mod_id  
					ORDER BY mod_ordem ASC
					";
			$stmt = $PDO->prepare($sql);
			$stmt->bindParam(':setor',$_SESSION['setor']);
			$stmt->execute();
			$rows = $stmt->rowCount();
			if($rows > 0)
			{
				while($row = $stmt->fetch())
				{
					$a = strtolower(str_replace("/","",RetirarAcentos($row['mod_nome'])));
					$b = explode("_",$pagina);
					echo "	<div class='menus' id='".$a."'><a href='#' target='_parent'><img src='".$row['mod_img']."' border='0' valign='top' /> &nbsp;&nbsp; ".$row['mod_nome']."</a></div>
							<div class='sub'>
							<div class='block'>";
							$sql_sub = "SELECT * FROM admin_setores_permissoes
										INNER JOIN ( admin_submodulos 
											INNER JOIN admin_modulos 
											ON admin_modulos.mod_id = admin_submodulos.sub_modulo )
										ON admin_submodulos.sub_id = admin_setores_permissoes.sep_submodulo
										INNER JOIN ( admin_setores 
											INNER JOIN admin_usuarios 
											ON admin_usuarios.usu_setor = admin_setores.set_id )
										ON admin_setores.set_id = admin_setores_permissoes.sep_setor
										WHERE sep_setor = :setor AND mod_id = :modulo
										GROUP BY sub_id  
										ORDER BY sub_ordem, sub_id ASC
										";
							$stmt_sub = $PDO->prepare($sql_sub);
							$stmt_sub->bindParam(':setor',$_SESSION['setor']);
							$stmt_sub->bindParam(':modulo',$row['mod_id']);
							$stmt_sub->execute();
							$rows_sub = $stmt_sub->rowCount();
							if($rows_sub > 0)
							{
								while($row_sub = $stmt_sub->fetch())
								{
									echo "
									<a href='".$row_sub['sub_link'].".php?pagina=".$row_sub['sub_link']."$autenticacao' target='_parent'>&raquo; "; if($row['mod_nome'] == "Relatórios" && $row_sub['sub_nome'] == "Contas a Pagar" && $_SESSION['setor'] == 3){ echo "Contas a Receber";}else{echo  $row_sub['sub_nome'];} echo "</a>
									<br>
									";
								}
							}
							echo "
							</div>
							</div>    
					";
					$pos = strpos(strtolower($a), $b[0]);
					$pos2 = strpos(strtolower($a), $b[1]);
					$pos3 = strpos(strtolower($a), $b[2]);
					//if($pos === false && $pos2 === false && $pos3 === false)
					if($pos === false)
					{
						
					}
					else
					{
						?>
      					<script>
						jQuery(document).ready(function()
						{
							jQuery("div#<?php echo $a;?>").toggleClass("active").next().slideToggle("slow");
						});
						</script>
						<?php
					}
				}
			}
             ?>
        <div class="menu">   
            	<a onclick="
                	abreMask(
                    'Deseja realmente sair do sistema?<br><br>'+
                    '<input value=\' Sim \' type=\'button\' onclick=javascript:window.location.href=\'logout.php?pagina=logout\';>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+
                    '<input value=\' Não \' type=\'button\' class=\'close_janela\'>');
                " class="top_link" target="_parent"><img src='../imagens/icon-sair.png' border='0' valign='top'> &nbsp;&nbsp; Sair</a>
   		</div> 
    </div>    
</div>


