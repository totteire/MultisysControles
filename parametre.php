
<button class="btAjout"><h1> +&nbsp; &nbsp; Paramètre</h1></button>
<table id="tableau" class="tableau tablesorter">
	<thead><tr><th class='info'></th><th class="topLeft">Libellé</th><th>Traduction</th><th class="topRight">Moyen de mesure</th></tr></thead>
    <tbody>
	<?php
		include('connect.php');
		$req="SELECT * FROM PARAMETRE ORDER BY LIBELLE;";
		$result=mysql_query($req) or die(mysql_error());
		
		while($res=mysql_fetch_array($result))
		{
		    $paraId=$res['ID'];
			$req2="SELECT MOYEN_MESURE.LIBELLE, MOYEN_MESURE.ID FROM MOYEN_MESURE, AVOIRPARDEFAUT, PARAMETRE WHERE MOYEN_MESURE.ID = AVOIRPARDEFAUT.ID AND AVOIRPARDEFAUT.ID_1 = PARAMETRE.ID AND PARAMETRE.ID = $paraId;";
		    $result2=mysql_query($req2)or die(mysql_error());
			echo "<tr>
    			<td id='id' class='info'>".$res['ID']."</td>
				<td id='libelle'>".$res['LIBELLE']."</td>
				<td id='label'>".$res['LABEL']."</td>
				<td id='MoyenMes'><select>";
		    echo "<option>".mysql_num_rows($result2)." selections</option>";
		    while($MM=mysql_fetch_array($result2)){
		        echo "<option value='".$MM['ID']."'>".$MM['LIBELLE']."</option>";
		    }
			echo "</select><a class='parModifMM' href=#><span class='ui-state-default ui-corner-all'><span class='ui-icon ui-icon-plusthick'></span></span></a></td>
			</tr>";
		}
	?>
	</tbody>
</table>

<div id="dialogParMM" class="dialog">
    <table class="inline">
    <button class="submit">Enregistrer</button>  
    <?php 
        $req3="SELECT * FROM MOYEN_MESURE ORDER BY LIBELLE;";
        $req4="SELECT LIBELLE FROM MOYEN_MESURE;";
        
        $result3=mysql_query($req3)or die(mysql_error());
        $middleRow = ceil(mysql_num_rows(mysql_query($req4)) / 2);
        $nb=0;
        $prevLib='';
        while($MM=mysql_fetch_array($result3)){
	    $nb++;
	    echo "<tr>
		    <td><input type='checkbox' name='".$MM['ID']."' value='".$MM['ID']."'></td>
		    <td>".$MM['LIBELLE']."</td>
		</tr>";
            $prevLib = $MM['LIBELLE'];
            if($nb == $middleRow)echo "</table><table class='inline'>";
        };
    ?>
    </table>
    <button class="submit">Enregistrer</button>
</div>

<div id="dialogPar" class="dialog">
	<div id="stylized" class="myform">
		<form id="formParametre" class="formulaire">
			<h1>Nouveau paramètre</h1>
			<p></p>
 			<input class='info' type='text' name='id' id='id'/>
 			
			<label>Libellé:</label>
			<input type="text" name="libelle" id="libelle" />

			<label>Traduction:</label>
			<input type="text" name="label" id="label" />
			
			<button class="submit">Enregistrer</button>
		</form>
	</div>
</div>
