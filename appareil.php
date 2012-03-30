<button class="btAjout"><h1> + Appareil</h1></button>
<table id="tableau" class="tableau tablesorter">
	<thead><tr><th class='info'></th><th class="topLeft">Désignation</th><th>Marque</th><th class="topRight">Type</th></tr></thead>
    <tbody>
	<?php
		include('connect.php');
		$req="SELECT * FROM APPAREIL;";
		$nb=0;
		$result=mysql_query($req) or die(mysql_error());
		while($res=mysql_fetch_array($result))
		{
			echo "<tr>
    			<td id='id' class='info'>".$res['ID']."</td>
				<td id='desig'>".$res['DESIGNATION']."</a></td>
				<td id='marque'>".$res['MARQUE']."</td>
				<td id='type'>".$res["TYPE"]."</td>
				<td id='modif' class='modifCell'><img class='modif' src='img/modify.png'/><img class='suppr' src='img/delete.png'/></td>
			</tr>";
			$nb++;
		}
	?>
	</tbody>
</table>

<div id="dialogApp" class="dialog">
	<div id="stylized" class="myform">
		<form id="formAppareil" class="formulaire">
			<h1>Nouvel appareil</h1>
			<p></p>
 			<input class='info' type='text' name='id' id='id'/>
 			
			<label>Désignation:</label>
			<input type="text" name="desig" id="desig" />
			
			<label>Marque:</label>
			<input type="text" name="marque" id="marque" />
			
			<label>Type:</label>
			<input type="text" name="type" id="type" />
			
			<button class="submit">Enregistrer</button>
		</form>
	</div>
</div>
