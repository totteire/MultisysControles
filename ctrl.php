<?php
    include('connect.php');
?>
<div id="CTRL" class="ajoutCtrl">

    <form id="ctrlForm" class="formulaire">
    <table>
        <tr class='static menu type'>
            <td style="width:150px;"><label class="titre">Type: </label></td>
            <td style="width:240px">
                <div class="radio" style="display:inline;">
		            <input type="radio" id="brEssai" name="radioType" value="ACE"/><label for="brEssai">ACE</label>
		            <input type="radio" id="brVerif" name="radioType" value="CV"/><label for="brVerif">CV</label>
		            <input type="radio" id="brEtal" name="radioType" value="CE"/><label for="brEtal">CE</label>
                    <input type="radio" id="brInter" name="radioType" value="FI"/><label for="brInter">FI</label>
                </div>
            </td>
            <td>
                <img id="CtrlClear" class="button" src="img/clear.png" />
                <h2 style="color:#EB8F00;display:inline;margin-left:70px;">Nouveau Document</h2>
            </td>
        </tr>
        <tr class='static menu lieu'>
            <td><label class="titre">Lieu:</label></td>
            <td colspan=7>
                <div class="radio">
		            <input type="radio" id="site" value="S" name="radioLieu" /><label for="site">Sur site</label>
		            <input type="radio" id="atelier" value="A" name="radioLieu" /><label for="atelier">Atelier</label>
	            </div>
            </td>
        </tr>
        <tr class='static mandatory'>
            <td><label class="titre">Date:</label></td>
            <td><input type="text" id="date" class='datepicker ui-corner-all' name="date" size="20" value=<?php echo date('d-m-Y') ?>></td>
        </tr>
        <tr class='static mandatory'>
            <td><label class="titre">Numéro:</label></td>
            <td><input type='text' class="ui-corner-all" name='num' id='num' defaut=<?php include('getCtrlNum.php');?>></td>
        </tr>
        <tr class='static mandatory'>
            <td><label class="titre">Client:</label></td>
            <td colspan=7>
                <select id="cli" class="combobox" name='cli'>
                <option value=""></option>
                <?php 
                    $reqCli="SELECT ID, NOM FROM CLIENT ORDER BY NOM;";
                    $resultCli = mysql_query($reqCli)or die(mysql_error());
                    while($res = mysql_fetch_array($resultCli)){
                        echo "<option value='".$res['ID']."'>".$res['NOM']."</option>";
                    }
                ?>
	            </select>	
        	</td>
	</tr>
	<tr class='static autoInsert mandatory'>
	    <td><label class="titre">Désignation:</label></td>
            <td class='minWidth'><select id="AppDesi" name="appDesi" class="combobox noArrow">
                <option value=""></option>
                <?php 
                    $reqApp="SELECT * FROM APP_DESI ORDER BY DESIGNATION;";
                    $resultApp = mysql_query($reqApp)or die(mysql_error());
                    while($res = mysql_fetch_array($resultApp)){
                        echo "<option value='".$res['ID']."'>".$res['DESIGNATION']."</option>";
                    }
                ?>
		</select>
	    </td>
    </tr>
	<tr class='static autoInsert mandatory'>
	    <td><label class="titre">Marque:</label></td>
            <td class='minWidth'><select id="AppMarq" name="appMarque" class="combobox noArrow">
                <option value=""></option>
                <?php 
                    $reqApp="SELECT * FROM APP_MARQUE ORDER BY MARQUE;";
                    $resultApp = mysql_query($reqApp)or die(mysql_error());
                    while($res = mysql_fetch_array($resultApp)){
                        echo "<option value='".$res['ID']."'>".$res['MARQUE']."</option>";
                    }
                ?>
		</select>
	    </td>
    </tr>
	<tr class='static autoInsert mandatory'>
	    <td><label class="titre">Type:</label></td>
            <td class='minWidth'><select id="AppType" class="combobox noArrow" name='appType'>
                <option value=""></option>
                <?php 
                    $reqApp="SELECT * FROM APP_TYPE ORDER BY TYPE;";
                    $resultApp = mysql_query($reqApp)or die(mysql_error());
                    while($res = mysql_fetch_array($resultApp)){
                        echo "<option value='".$res['ID']."'>".$res['TYPE']."</option>";
                    }
                ?>
		</select>
	    </td>
	</tr>
	<tr class='static'>
        <td><label class="titre">Num Série:</label></td>
        <td><input type='text' class="ui-corner-all validated" name='numS' id='numS'/></td>
        <td rowspan=2><button style='display:none;' class="ValidateNums"><img src='img/icon_ok.png'/></button></td>
    </tr>
	<tr class='static'>
        <td><label class="titre">Num Chassis:</label></td>
        <td><input type='text' class="ui-corner-all validated" name='numC' id='numC'/></td>
    </tr>
    <tr class='CV CE mandatory'>
        <td><label class="titre">Moyens de mesure:</label></td>
        <td colspan=7><select id="MM" class="combobox" name="MM"></select><a id="ajoutMMCtr" class='editParMM' href=#><span class='ui-state-default ui-corner-all'><span class='ui-icon ui-icon-plusthick'></span></span></a></td>
    </tr>
    <tr class='Par CV mandatory'>
        <td><label class="titre">Paramètres:</label></td>
        <td colspan=7><select id="Par" class="combobox" name="Par"></select><a id="ajoutParCtr" class='editParMM' href=#><span class='ui-state-default ui-corner-all'><span class='ui-icon ui-icon-plusthick'></span></span></a></td>
    </tr>
    <tr class='site mandatory'>
	    <td><label class="titre">Température:</label></td>
	    <td colspan=7>
		<input type='text' class="ui-corner-all" name='temp' id='temp'/>°C
	    </td>
	</tr>
	<tr class='ACE CV CE mandatory'>
	    <td><label class="titre">Technicien:</label></td>
	    <td colspan=7>
		<select id="technicien" class="combobox" name='tech'>
		    <option></option>
		<?php 
		    $reqTech="SELECT ID, TECH FROM TECHNICIEN ORDER BY TECH;";
		    $resultTech = mysql_query($reqTech)or die(mysql_error());
		    while($res = mysql_fetch_array($resultTech)){
		    if($res['ID'] != '1')	
			    echo "<option value='".$res['ID']."'>".$res['TECH']."</option>";
		    }
		?>
		</select>
	    </td>
	</tr>
	<tr class='ACE CV mandatory'>
            <td><label class="titre">Jugement:</label></td>
            <td colspan=7><select class="combobox" id='jugement' name='jugement'>
                <option></option>
                <option value="1">Conforme constructeur</option>
		<option value="2">Conforme utilisateur</option>
                <option value="3">Conforme technicien vérificateur</option>
                <option value="4">Réparation constructeur</option>
		<option value="5">Réparation utilisateur</option>
                <option value="6">Réparation technicien vérificateur</option>
                <option value="7">Non conforme</option>
            </select></td>
        </tr>
	<tr class='ACE CV'>
            <td><label class="titre">Observation:</label></td>
            <td colspan=7><textarea type='textarea' class="ui-corner-all" name='observation' id='observation'></textarea></td>
        </tr>
	<tr class='FI mandatory autoInsert'>
	    <td><label class="titre">Documents:</label></td>
	    <td colspan=7>
		<select id="docsSt" class="combobox" name="docST">
		    <option></option>
		    <?php
			$reqDocSt = "SELECT DISTINCT DOCST FROM CONTROLE WHERE TYPE_CTRL='FI';";
			$res = mysql_query($reqDocSt)or die(mysql_error());
			while($docSt = mysql_fetch_array($res)){
			    echo "<option value='".$docSt['DOCST']."'>".$docSt['DOCST']."</option>";
			}

		    ?> 
		</select>
	    </td>
	</tr>
	<tr class='FI mandatory'>
	    <td><label class="titre">Numéro certificat ST:</label></td>
	    <td>
		<input type='text' class='ui-corner-all' name='docNum' id='docNum' />
	    </td>
	</tr>
        <tr class='static bouttons'><td colspan=7><button class="submit">Enregistrer</button></td></tr>
	</table>
	</form>
    <div id="dialogParCtr" class="dialog">
        <table class="inline">
        <?php 
            $req3="SELECT ID, LIBELLE FROM PARAMETRE ORDER BY LIBELLE;";
            $result3=mysql_query($req3)or die(mysql_error());
            $middleRow = ceil(mysql_num_rows(mysql_query($req3)) / 2);
            $nb=0;
            $prevLib='';
            while($Par=mysql_fetch_array($result3)){
                if($Par['LIBELLE'] != $prevLib){
                    $nb++;
                    echo "<tr>
                            <td><input type='checkbox' name='para".$Par['ID']."' value='".$Par['ID']."'></td>
                            <td>".$Par['LIBELLE']."</td>
                        </tr>";
                }
                $prevLib = $Par['LIBELLE'];
                if($nb == $middleRow)echo "</table><table class='inline'>";
            };
        ?>
        </table>
        <button class="submit">Enregistrer</button>
    </div>
    <div id="dialogMMCtr" class="dialog">
	<button class="submit">Enregistrer</button>
        <table class="inline">
	    <?php
		$req4="SELECT ID, LIBELLE, NOM_VERIF FROM MOYEN_MESURE ORDER BY ORDRE, LIBELLE;";
		$result4=mysql_query($req4)or die(mysql_error());
		$middleRow = ceil(mysql_num_rows(mysql_query($req4)) / 2);
		$nb=0;
		$prevLib='';
		while($MM=mysql_fetch_array($result4)){
		    if($MM['LIBELLE'] != $prevLib){
			$nb++;
			echo "<tr>
				<td><input type='checkbox' name='mmes".$MM['ID']."' value='".$MM['ID']."'></td>
				<td>".$MM['LIBELLE']."</td>
			    </tr>";
		    }
		    $prevLib = $MM['LIBELLE'];
		    if($nb == $middleRow)echo "</table><table class='inline'>";
		};
	    ?>	
	</table>
	<button class="submit">Enregistrer</button>
    </div>
</div>
