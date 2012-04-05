<table id="tableau" class="tableau tablesorter">
	<thead><tr><th class='info'></th><th class="topLeft">Numéro</th><th>Date</th><th>Client</th><th>Designation</th><th>Marque</th><th>Type</th><th>Lieu</th><th class="topRight">PDF Edité</th></tr></thead>
    <tbody>
	<?php
		include('connect.php');
		$req="SELECT CONTROLE.ID,CONTROLE.NUM,CONTROLE.DATE,LIEU,PDF_EDIT, NOM, DESIGNATION,MARQUE,TYPE FROM CONTROLE,CLIENT C,APPAREIL A WHERE C.ID=CONTROLE.ID_AVOIR AND A.ID=CONTROLE.ID_CONCERNER;";
		$nb=0;
		$result=mysql_query($req) or die(mysql_error());
		while($res=mysql_fetch_array($result))
		{
		    $res['DATE'] = date("d-m-Y",strtotime($res["DATE"]));
		    if($res['PDF_EDIT']=='0000-00-00') $res['PDF_EDIT'] = 'NON';
			echo "<tr>
			    <td id='id' class='info'>".$res['ID']."</td>
				<td id='num'>".$res['NUM']."</td>
				<td id='date'>".$res['DATE']."</td>
				<td id='cli'>".$res['NOM']."</td>
				<td id='appN'>".$res['DESIGNATION']."</td>
				<td id='appD'>".$res['MARQUE']."</td>
				<td id='appT'>".$res['TYPE']."</td>
				<td id='lieu'>".$res['LIEU']."</td>
				<td id='pdfEdit'>".$res['PDF_EDIT']."</a></td>
				<td id='modif' class='modifCell'><img class='modif' src='img/modify.png'/><img class='suppr' src='img/delete.png'/></td>
			</tr>";
			$nb++;
		}
	?>
	</tbody>
</table>
