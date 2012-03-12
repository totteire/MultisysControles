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
			echo "<tr>
				<td id='nom'>".$res['NOM']."</a></td>
				<td id='adresse'>".$res['ADRESSE']."</td>
				<td id='adCP'>".$res["AD_CP"]."</td>
				<td id='adVille'>".$res["AD_VILLE"]."</td>
			</tr>";
			$nb++;
		}
		// déconnexion
		mysql_close($connex);
	?>
	</tbody>
</table>
<span><button class="btAjout"><h1> + Client</button></span>

<div id="dialogClient">
	<div id="stylized" class="myform">
		<form id="form" name="form" method="post" action="index.html">
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
			
<!--			<label>Téléphone standard:</label>-->
<!--			<input type="text" name="standTelCli" id="standTelCli" />-->

<!--			<label>Téléphone direct:</label>-->
<!--			<input type="text" name="directTelCli" id="directTelCli" />-->

			
			<button type="submit">Enregistrer</button>
<!--			<div class="spacer"></div>-->

		</form>
	</div>
</div>

