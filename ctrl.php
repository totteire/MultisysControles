<?php 
    include('connect.php');
?>
<div id="CTRL">
    <table style="width: 600px;margin: auto;">
        <tr class='static menu type'>
            <td><label class="titre">Type: </label></td>
            <td>
                <div class="radio">
		            <input type="radio" id="brEssai" name="radio1" affichClass='essa'/><label for="brEssai">Essai</label>
		            <input type="radio" id="brVerif" name="radio1" affichClass='veri'/><label for="brVerif">Vérification</label>
		            <input type="radio" id="brEtal" name="radio1" affichClass='etal'/><label for="brEtal">Etalonnage</label>
                </div>
            </td>
        </tr>
        <tr class='static menu lieu'>
            <td><label class="titre">Lieu:</label></td>
            <td>	
                <div class="radio">
		            <input type="radio" id="site" name="radio2" /><label for="site">Sur site</label>
		            <input type="radio" id="atelier" name="radio2" /><label for="atelier">Atelier</label>
	            </div>
            </td>
        </tr>
        <tr class='static'>
            <td><label class="titre">Numéro:</label></td>
            <td><input type='text' class="ui-corner-all" name='num' id='num' defaut=<?php include('getCtrlNum.php');?>></td>
        </tr>
	    <tr class='static'>
            <td><label class="titre">Client:</label></td>
            <td>
                <select id="cli" class="combobox" name='cli'>
                <option value=""></option>
                <?php 
                    $reqCli="SELECT ID, NOM FROM CLIENT;";
                    $resultCli = mysql_query($reqCli)or die(mysql_error());
                    while($res = mysql_fetch_array($resultCli)){
                        echo "<option value='".$res['ID']."'>".$res['NOM']."</option>";
                    }
                ?>
	            </select>	
        	</td>
	    </tr>
	    <tr class='static'>
	        <td><label class="titre">Appareil:</label></td>
            <td><select id="App" class="combobox" name='App'>
                <option value=""></option>
                <?php 
                    $reqApp="SELECT ID, DESIGNATION FROM APPAREIL;";
                    $resultApp = mysql_query($reqApp)or die(mysql_error());
                    while($res = mysql_fetch_array($resultApp)){
                        echo "<option value='".$res['ID']."'>".$res['DESIGNATION']."</option>";
                    }
                ?>
	            </select>
	        </td>
	    </tr>
	    <tr class='static'>
            <td><label class="titre">Num Série:</label></td>
            <td><input type='text' class="ui-corner-all" name='numS' id='numS'/></td>
        </tr>
	    <tr class='static'>
            <td><label class="titre">Num Chassis:</label></td>
            <td><input type='text' class="ui-corner-all" name='numC' id='numC'/></td>
        </tr>
        <tr class='veri etal'>
            <td><label class="titre">Paramètres:</label></td>
            <td><select id="Par" class="combobox" name="Par"></select><a id="ajoutParCtr" href=#><span class='ui-state-default ui-corner-all'><span class='ui-icon ui-icon-plusthick'></span></span></a></td>
        </tr>
        <tr class='veri etal'>
            <td><label class="titre">Moyens de mesure:</label></td>
            <td><select id="MM" class="combobox" name="Par"></select><a id="ajoutMMCtr" href=#><span class='ui-state-default ui-corner-all'><span class='ui-icon ui-icon-plusthick'></span></span></a></td>
        </tr>
	    <tr class='static'>
	        <td><label class="titre">Technicien:</label></td>
	        <td><select id="cli" class="combobox" name='cli'><option></option><option>Claude</option></select></td>
	    </tr>
	    <tr class='static'>
	        <td><label class="titre">Date:</label></td>
	        <td><input type="text" id="date" class='datepicker ui-corner-all' name="date" size="20" value=<?php echo date('d-m-Y') ?>></td>
	    </tr>
	    <tr class='essa veri'>
            <td><label class="titre">Jugement:</label></td>
            <td><input type='text' class="ui-corner-all" name='numS' id='numS'/></td>
        </tr>
	    <tr class='static'>
            <td><label class="titre">Observation:</label></td>
            <td><textarea type='textarea' class="ui-corner-all" name='numS' id='numS'></textarea></td>
        </tr>
        <tr class='static'><td></td><td><button class="submit">Enregistrer</button></td></tr>
        </table>

    </div>
    <div id="dialogParCtr" class="dialog">
        <table class="inline">
        <?php 
            $req3="SELECT ID, LIBELLE FROM PARAMETRE;";
            $result3=mysql_query($req3)or die(mysql_error());
            $middleRow = ceil(mysql_num_rows(mysql_query($req3)) / 2);
            $nb=0;
            $prevLib='';
            while($Par=mysql_fetch_array($result3)){
                if($Par['LIBELLE'] != $prevLib){
                    $nb++;
                    echo "<tr>
                            <td><input type='checkbox' name='".$Par['ID']."' value='".$Par['ID']."'></td>
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
        <table class="inline">
        <?php 
            $req4="SELECT ID, LIBELLE FROM MOYEN_MESURE;";
            $result4=mysql_query($req4)or die(mysql_error());
            $middleRow = ceil(mysql_num_rows(mysql_query($req4)) / 2);
            $nb=0;
            $prevLib='';
            while($MM=mysql_fetch_array($result4)){
                if($MM['LIBELLE'] != $prevLib){
                    $nb++;
                    echo "<tr>
                            <td><input type='checkbox' name='".$MM['ID']."' value='".$MM['ID']."'></td>
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
