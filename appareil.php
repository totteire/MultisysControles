<button class="btAjout"><h1> + Client</button>
<table id="tableau" class="tableau tablesorter">
	<thead><tr><th class="topLeft">Nom</th><th>Adresse</th><th>CP</th><th class="topRight">Ville</th></tr></thead>
    <tbody>
	<?php
		include('connect.php');
		$req="SELECT * FROM CLIENT;";
		$nb=0;
		$result=mysql_query($req) or die(mysql_error());
		while($res=mysql_fetch_array($result))
		{
		    $res['ADRESSE'] = str_replace('$',', ',$res['ADRESSE']);
			echo "<tr>
				<td id='nom'>".$res['NOM']."</a></td>
				<td id='adresse'>".$res['ADRESSE']."</td>
				<td id='adCP'>".$res["AD_CP"]."</td>
				<td id='adVille'>".$res["AD_VILLE"]."</td>
				<td id='modif' class='modifCell'><img class='modif' src='img/modify.png'/><img class='suppr' src='img/delete.png'/></td>
			</tr>";
			$nb++;
		}
		// déconnexion
		mysql_close($connex);
	?>
	</tbody>
</table>

<div id="dialogApp" class="dialog">
	<div id="stylized" class="myform">
		<form id="formClient" class="formulaire">
			<h1>Nouveau Client</h1>
			<p>Inserez un nouveau client</p>

 
			<label>Nom:</label>
			<input type="text" name="nom" id="nom" />

			<label>Adresse:</label>
			<input type="text" name="ad1" id="ad1" />
			<label></label>
			<input type="text" name="ad2" id="ad2" />

			<label>Ville:</label>

			<input type="text" name="adVille" id="adVille" />
			
			<label>Code Postal:</label>
			<input type="text" name="adCP" id="adCP"/>
			
			<button id="ajoutCli.php" class="submit">Enregistrer</button>


		</form>
	</div>
</div>

