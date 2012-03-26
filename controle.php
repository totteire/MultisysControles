<table id="tableau" class="tableau tablesorter">
	<thead><tr><th class="topLeft">Numéro</th><th>Lieu</th><th>Client</th><th>Appareil</th><th>Date</th><th>Technicien</th><th>Jugement</th><th>Observation</th><th>Chassis</th><th class="topRight">Série</th></tr></thead>
    <tbody>
	<?php
		include('connect.php');
		$req="SELECT * FROM CONTROLE;";
		$nb=0;
		$result=mysql_query($req) or die(mysql_error());
		while($res=mysql_fetch_array($result))
		{
			echo "<tr>
			    <td id='id' class='info'>".$res['ID']."</td>
				<td id='nom'>".$res['NUM']."</a></td>
				<td id='nom'>".$res['LIEU']."</a></td>
				<td id='ad1'>".$res['ID_AVOIR']."</td>
				<td id='nom'>".$res['ID_CONCERNER']."</a></td>
				<td id='ad2'>".$res['DATE']."</td>
				<td id='adCP'>".$res['TECHNICIEN']."</td>
				<td id='adVille'>".$res['JUGEMENT']."</td>
				<td id='nom'>".$res['OBSERVATION']."</a></td>
				<td id='nom'>".$res['NUM_CHASSIS']."</a></td>
				<td id='nom'>".$res['NUM_SERIE']."</a></td>
				<td id='modif' class='modifCell'><img class='modif' src='img/modify.png'/><img class='suppr' src='img/delete.png'/></td>
			</tr>";
			$nb++;
		}
	?>
	</tbody>
</table>
