<button class="btAjout"><h1> +&nbsp; &nbsp; Moyen de Mesure</h1></button>
<table id="tableau" class="tableau tablesorter">
	<thead><tr><th class='info'></th><th class="topLeft">Libellé</th><th>Vérification</th><th class="topRight">Numéro & Date</th></tr></thead>
    <tbody>
	<?php
		include('connect.php');
		$req="SELECT * FROM MOYEN_MESURE ORDER BY LIBELLE;";
		$nb=0;
		$result=mysql_query($req) or die(mysql_error());
		while($res=mysql_fetch_array($result))
		{
			echo "<tr>
    			<td id='id' class='info'>".$res['ID']."</td>
				<td id='libelle'>".$res['LIBELLE']."</a></td>
				<td id='nomVerif'>".$res['NOM_VERIF']."</td>
				<td id='numDateVerif'>".$res["NUM_DATE_VERIF"]."</td>
				<td id='modif' class='modifCell'><img class='modif' src='img/modify.png'/><img class='suppr' src='img/delete.png'/></td>
			</tr>";
			$nb++;
		}
	?>
	</tbody>
</table>

<div id="dialogMes" class="dialog">
	<div id="stylized" class="myform">
		<form id="formMoyenMesure" class="formulaire">
			<h1>Nouveau moyen de mesure</h1>
			<p></p>
 			<input class='info' type='text' name='id' id='id'/>
 			
			<label>Libellé:</label>
			<input type="text" name="libelle" id="libelle" />
			
			<label>Vérification:</label>
			<input type="text" name="nomVerif" id="nomVerif" />
			
			<label>Numéro & Date:</label>
			<input type="text" name="numDateVerif" id="numDateVerif" />
			
			<button class="submit">Enregistrer</button>
		</form>
	</div>
</div>
