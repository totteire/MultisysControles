<button class="btAjout"><h1> +&nbsp; &nbsp; Technicien</button>
<H2>Techniciens:</H2>
<table id="tableau" class="tableau tablesorter">
	<thead><tr><th class=info></th><th class="topLeftRight">Nom</th></tr></thead>
    <tbody>
	<?php
		include('connect.php');
		$req="SELECT * FROM TECHNICIEN ORDER BY TECH;";
		$nb=0;
		$result=mysql_query($req) or die(mysql_error());
		while($res=mysql_fetch_array($result))
		{
			echo "<tr>
			    <td id='id' class='info'>".$res['ID']."</td>
				<td id='nom'>".$res['TECH']."</a></td>
				<td id='modif' class='modifCell'><img class='modif' src='img/modify.png'/><img class='suppr' src='img/delete.png'/></td>
			</tr>";
			$nb++;
		}
	?>
	</tbody>
</table>

<div id="dialogOpt" class="dialog">
	<div id="stylized" class="myform">
		<form id="formClient" class="formulaire">
			<h1>Nouveau Client</h1>
			<p></p>
            <input class='info' type='text' name='id' id='id'/>
			<label>Nom:</label>
			<input type="text" name="nom" id="nom" />
			
			<button class="submit">Enregistrer</button>

		</form>
	</div>
</div>

