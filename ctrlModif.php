<?php 
    include('connect.php');
    $id = $_POST['ID'];
    $reqCtrl = "SELECT * FROM CONTROLE AS C, APPAREIL AS A WHERE C.ID = $id AND C.ID_CONCERNER = A.ID;";
    $ctrl = mysql_query($reqCtrl)or die(mysql_error());
    $ctrl = mysql_fetch_array($ctrl);
?>
<div id="CTRL">
    <form id="ctrlForm" class="formulaire">
    <table>
        <tr class='static menu type'>
            <td><label class="titre">Type: </label></td>
            <td colspan=7>
                <div class="radio">
		            <input type="radio" id="brEssai" name="radioType" <?php if($ctrl['TYPE_CTRL'] == 'essa')echo "checked=true" ?> value="essa" affichClass='essa'/><label for="brEssai">Essai</label>
		            <input type="radio" id="brVerif" name="radioType" <?php if($ctrl['TYPE_CTRL'] == 'veri')echo "checked=true" ?> value="veri" affichClass='veri'/><label for="brVerif">Vérification</label>
		            <input type="radio" id="brEtal" name="radioType" <?php if($ctrl['TYPE_CTRL'] == 'etal')echo "checked=true" ?> value="etal" affichClass='etal'/><label for="brEtal">Etalonnage</label>
                </div>
            </td>
        </tr>
        <tr class='static menu lieu'>
            <td><label class="titre">Lieu:</label></td>
            <td colspan=7>
                <div class="radio">
		            <input type="radio" id="site" value="S" <?php if($ctrl['LIEU'] == 'S')echo "checked=true" ?> name="radioLieu" /><label for="site">Sur site</label>
		            <input type="radio" id="atelier" value="A" <?php if($ctrl['LIEU'] == 'A')echo "checked=true" ?> name="radioLieu" /><label for="atelier">Atelier</label>
	            </div>
            </td>
        </tr>
        <tr class='static'>
            <td><label class="titre">Numéro:</label></td>
            <td colspan=7><input type='text' class="ui-corner-all" value=<?php echo $ctrl['NUM'] ?> name='num' id='num' defaut=<?php include('getCtrlNum.php');?>></td>
        </tr>
	    <tr class='static'>
            <td><label class="titre">Client:</label></td>
            <td colspan=7>
                <select id="cli" class="combobox" name='cli'>
                <?php 
                    $reqCli="SELECT ID, NOM FROM CLIENT ORDER BY NOM;";
                    $resultCli = mysql_query($reqCli)or die(mysql_error());
                    while($res = mysql_fetch_array($resultCli)){
                        if ($res['ID'] == $ctrl['ID_AVOIR'])
                            echo "<option selected='selected' value='".$res['ID']."'>".$res['NOM']."</option>";
                        else
                            echo "<option value='".$res['ID']."'>".$res['NOM']."</option>";
                    }
                ?>
	            </select>
        	</td>
	    </tr>
	    <tr class='static'>
	        <td><label class="titre">Désignation:</label></td>
            <td class='minWidth'><select id="AppDesi" class="combobox">
                <?php 
                    $reqApp="SELECT DISTINCT DESIGNATION FROM APPAREIL ORDER BY DESIGNATION;";
                    $resultApp = mysql_query($reqApp)or die(mysql_error());
                    while($res = mysql_fetch_array($resultApp)){
                        if($res['DESIGNATION'] == $ctrl['DESIGNATION'])
                            echo "<option selected='selected' value='".$res['DESIGNATION']."'>".$res['DESIGNATION']."</option>";
                        else
                            echo "<option value='".$res['DESIGNATION']."'>".$res['DESIGNATION']."</option>";
                    }
                ?>
	            </select>
	        </td>
	        <td><label class="titre">Marque:</label></td>
            <td class='minWidth'><select id="AppMarq" class="combobox">
                <?php
                    $reqApp="SELECT DISTINCT MARQUE FROM APPAREIL ORDER BY MARQUE;";
                    $resultApp = mysql_query($reqApp)or die(mysql_error());
                    while($res = mysql_fetch_array($resultApp)){
                        if($res['MARQUE'] == $ctrl['MARQUE'])
                            echo "<option selected='selected'selected='selected' value='".$res['MARQUE']."'>".$res['MARQUE']."</option>";
                        else
                            echo "<option value='".$res['MARQUE']."'>".$res['MARQUE']."</option>";
                    }
                ?>
	            </select>
	        </td>
	        <td><label class="titre">Type:</label></td>
            <td class='minWidth'><select id="AppType" class="combobox" name='app'>
                <?php
                    $reqApp="SELECT ID, TYPE FROM APPAREIL ORDER BY TYPE;";
                    $resultApp = mysql_query($reqApp)or die(mysql_error());
                    while($res = mysql_fetch_array($resultApp)){
                        if($res['ID'] == $ctrl['ID'])
                            echo "<option selected='selected' value='".$res['ID']."'>".$res['TYPE']."</option>";
                        else
                            echo "<option value='".$res['ID']."'>".$res['TYPE']."</option>";
                    }
                ?>
	            </select>
	        </td>
	    </tr>
	    <tr class='static'>
            <td><label class="titre">Num Série:</label></td>
            <td><input type='text' value=<?php echo $ctrl['NUM_SERIE'] ?> class="ui-corner-all" name='numS' id='numS'/></td>
        </tr>
	    <tr class='static'>
            <td><label class="titre">Num Chassis:</label></td>
            <td><input type='text' value=<?php echo $ctrl['NUM_CHASSIS'] ?> class="ui-corner-all" name='numC' id='numC'/></td>
        </tr>
        <tr class='veri etal'>
            <td><label class="titre">Paramètres:</label></td>
            <td colspan=7><select id="Par" class="combobox" name="Par"></select><a id="ajoutParCtr" href=#><span class='ui-state-default ui-corner-all'><span class='ui-icon ui-icon-plusthick'></span></span></a></td>
        </tr>
        <tr class='veri etal'>
            <td><label class="titre">Moyens de mesure:</label></td>
            <td colspan=7><select id="MM" class="combobox" name="MM"></select><a id="ajoutMMCtr" href=#><span class='ui-state-default ui-corner-all'><span class='ui-icon ui-icon-plusthick'></span></span></a></td>
        </tr>
	    <tr class='static'>
	        <td><label class="titre">Technicien:</label></td>
	        <td colspan=7><select id="technicien" class="combobox" name='tech'></select></td>
            <?php
                $reqTech="SELECT ID, TECH FROM TECHNICIEN;";
                $resultTech = mysql_query($reqTech)or die(mysql_error());
                while($res = mysql_fetch_array($resultTech)){
                if($res['ID'] == $ctrl['TECHNICIEN'])
                    echo "<option selected='selected' value='".$res['ID']."'>".$res['TECHNICIEN']."</option>";
                else
                    echo "<option value='".$res['ID']."'>".$res['TECHNICIEN']."</option>";
                }
            ?>
	    </tr>
	    <tr class='static'>
	        <td><label class="titre">Date:</label></td>
	        <td><input type="text" id="date" class='datepicker ui-corner-all' name="date" size="20" value=<?php echo $ctrl['DATE'] ?>></td>
	    </tr>
	    <tr class='essa veri'>
            <td><label class="titre">Jugement:</label></td>
            <td colspan=7><select class="combobox" id='jugement' name='jugement'>
                <option <?php if($ctrl['JUGEMENT']==1)echo "checked='true' " ?>value="1">Appareil conforme</option>
                <option <?php if($ctrl['JUGEMENT']==1)echo "checked='true' " ?>value="2">Appareil conforme après réparation</option>
                <option <?php if($ctrl['JUGEMENT']==1)echo "checked='true' " ?>value="3">Appareil non conforme</option>
            </select></td>
        </tr>
	    <tr class='static'>
            <td><label class="titre">Observation:</label></td>
            <td colspan=7><textarea type='textarea' value='<?php echo $ctrl['OBSERVATION'] ?>' class="ui-corner-all" name='observation' id='observation'></textarea></td>
        </tr>
        <tr class='static'><td></td><td><button class="submit">Enregistrer</button><button id="CtrlClear">Vider</button></td></tr>
	</table>
	</form>
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
