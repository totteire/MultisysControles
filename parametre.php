<button class="btAjout"><h1> + Paramètre</h1></button>
<table id="tableau" class="tableau tablesorter">
	<thead><tr><th class="topLeft topRight">Libellé</th></tr></thead>
    <tbody>
	<?php
		include('connect.php');
		$req="SELECT * FROM PARAMETRE;";
		$nb=0;
		$result=mysql_query($req) or die(mysql_error());
		while($res=mysql_fetch_array($result))
		{
			echo "<tr>
    			<td id='id' class='info'>".$res['ID']."</td>
				<td id='libelle'>".$res['LIBELLE']."</a></td>
				<td id='modif' class='modifCell'><img class='modif' src='img/modify.png'/><img class='suppr' src='img/delete.png'/></td>
			</tr>";
			$nb++;
		}
	?>
	</tbody>
</table>

<div id="dialogPar" class="dialog">
	<div id="stylized" class="myform">
		<form id="formParametre" class="formulaire">
			<h1>Nouveau paramètre</h1>
			<p></p>
 			<input class='info' type='text' name='id' id='id'/>
 			
			<label>Libellé:</label>
			<input type="text" name="libelle" id="libelle" />
			
			<button class="submit">Enregistrer</button>
		</form>
	</div>
</div>
