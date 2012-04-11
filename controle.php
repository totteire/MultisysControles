<table id="tableau" class="tableau tablesorter">
	<thead><tr><th class='info'></th><th class="topLeft">Numéro</th><th>Type</th><th>Date</th><th>Client</th><th>APP-Designation</th><th>APP-Marque</th><th>APP-Type</th><th>Lieu</th><th class="topRight">PDF Edité</th></tr></thead>
    <tbody>
	<?php
		include('connect.php');
		$req="SELECT CONTROLE.ID,CONTROLE.NUM,CONTROLE.TYPE_CTRL,CONTROLE.DATE,LIEU,PDF_EDIT, NOM, DESIGNATION,MARQUE,TYPE FROM CONTROLE,CLIENT C,APPAREIL A WHERE C.ID=CONTROLE.ID_AVOIR AND A.ID=CONTROLE.ID_CONCERNER;";
		$nb=0;
		$result=mysql_query($req) or die(mysql_error());
		while($res=mysql_fetch_array($result))
		{
		    $res['DATE'] = date("d-m-Y",strtotime($res["DATE"]));
		    if($res['PDF_EDIT']=='0000-00-00') $res['PDF_EDIT'] = 'NON';
			echo "<tr>
			    <td id='id' class='info'>".$res['ID']."</td>
				<td id='TDnum'>".$res['NUM']."</td>
				<td id='TDtype'>".$res['TYPE_CTRL']."</td>
				<td id='TDdate'>".$res['DATE']."</td>
				<td id='TDcli'>".$res['NOM']."</td>
				<td id='TDappN'>".$res['DESIGNATION']."</td>
				<td id='TDappD'>".$res['MARQUE']."</td>
				<td id='TDappT'>".$res['TYPE']."</td>
				<td id='TDlieu'>".$res['LIEU']."</td>
				<td id='TDpdfEdit'>".$res['PDF_EDIT']."</td>
				<td id='modif' class='modifCell'><img class='modifCtrl' src='img/modify.png'/><img class='suppr' src='img/delete.png'/></td>
			</tr>";
			$nb++;
		}
	?>
	</tbody>
</table>
