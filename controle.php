<div id="menuTable" class='target' style="display:none;width:200px;background-color:white;border:1px solid black;padding:5px;">
</div>
<table id="tableCol" class="tableau tablesorter">
	<thead><tr><th class='info'></th><th>Numéro</th><th>Type</th><th>Date</th><th>Client</th><th>APP-Designation</th><th>APP-Marque</th><th>APP-Type</th><th>Num Série</th><th>Num Chassis</th><th></th></tr></thead>
    <tbody style="overflow-y: scroll; overflow-x: hidden; height: 100px;">
	<?php
		include('connect.php');
		$req="SELECT CONTROLE.ID,CONTROLE.NUM,CONTROLE.TYPE_CTRL,CONTROLE.DATE,CONTROLE.NUM_SERIE,CONTROLE.NUM_CHASSIS, CONTROLE.PDF_EDIT, NOM, DESIGNATION,MARQUE,TYPE,TECHNICIEN FROM CONTROLE,CLIENT C, APP_DESI, APP_MARQUE, APP_TYPE WHERE C.ID=CONTROLE.ID_AVOIR AND APP_DESI.ID=CONTROLE.ID_APP_DESI AND APP_MARQUE.ID=CONTROLE.ID_APP_MARQUE AND APP_TYPE.ID=CONTROLE.ID_APP_TYPE ORDER BY CONTROLE.ID DESC;";
		$nb=0;
		$result=mysql_query($req) or die(mysql_error());
		while($res=mysql_fetch_array($result))
		{
		    $res['DATE'] = date("d-m-Y",strtotime($res["DATE"]));
		    if($res['PDF_EDIT']=='0000-00-00') $img = 'img/pdf.png'; else $img = 'img/pdfVert.png';
		    if($res['TECHNICIEN'] == '1' && $res['TYPE_CTRL'] <> 'FI') echo "<tr class='colored'>";
		    else echo "<tr>";
		    echo "  <td id='id' class='info'>".$res['ID']."</td>
			    <td id='TDnum'>".$res['NUM']."</td>
			    <td id='TDtype'>".$res['TYPE_CTRL']."</td>
			    <td id='TDdate'>".$res['DATE']."</td>
			    <td id='TDcli'>".$res['NOM']."</td>
			    <td id='TDappN'>".$res['DESIGNATION']."</td>
			    <td id='TDappD'>".$res['MARQUE']."</td>
			    <td id='TDappT'>".$res['TYPE']."</td>
			    <td id='TDnumS'>".$res['NUM_SERIE']."</td>
			    <td id='TDnumC'>".$res['NUM_CHASSIS']."</td>
			    <td id='modif' class='modifCell'><a href='generatePdf.php?id=".$res['ID']."' onclick='' class='pdfEdit'><img src='$img'/></a></td>
		    </tr>";
		    $nb++;
		}
	?>
	</tbody>
</table>
