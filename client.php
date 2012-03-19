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
		    $ad=explode('$',$res["ADRESSE"]);
			if (!isset($ad[1]))$ad[1]='';
			echo "<tr>
			    <td id='id' class='info'>".$res['ID']."</td>
				<td id='nom'>".$res['NOM']."</a></td>
				<td id='ad1'>".$ad[0]."</td>
				<td id='ad2' class='info'>".$ad[1]."</td>
				<td id='adCP'>".$res["AD_CP"]."</td>
				<td id='adVille'>".$res["AD_VILLE"]."</td>
				<td id='modif' class='modifCell'><img class='modif' src='img/modify.png'/><img class='suppr' src='img/delete.png'/></td>
			</tr>";
			$nb++;
		}
	?>
	</tbody>
</table>

<div id="dialogCli" class="dialog">
	<div id="stylized" class="myform">
		<form id="formClient" class="formulaire">
			<h1>Nouveau Client</h1>
			<p></p>
            <input class='info' type='text' name='id' id='id'/>
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
			
			<button class="submit">Enregistrer</button>

		</form>
	</div>
</div>

