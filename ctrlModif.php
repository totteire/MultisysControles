<?php 
    include('connect.php');
    $id = $_POST['ID'];
    $reqCtrl = "SELECT * FROM CONTROLE AS C, APP_DESI, APP_MARQUE, APP_TYPE WHERE C.ID = $id AND APP_DESI.ID=C.ID_APP_DESI AND APP_MARQUE.ID=C.ID_APP_MARQUE AND APP_TYPE.ID=C.ID_APP_TYPE;";
    $ctrl = mysql_query($reqCtrl)or die(mysql_error());
    $ctrl = mysql_fetch_array($ctrl);
?>
<div id="CTRL" class="modifCtrl">
    <div id="dialogParCtr" class="dialog">
        <table class="inline">
        <?php
            $resultCheckedPar=mysql_query("SELECT ID_1 FROM VERIFIER WHERE ID = $id;")or die(mysql_error());
            $checkedId = array();
            while($resCheckedId=mysql_fetch_array($resultCheckedPar))
                array_push($checkedId, $resCheckedId['ID_1']);
            $reqPar="SELECT ID,LIBELLE FROM PARAMETRE;";
            $resultPar=mysql_query($reqPar)or die(mysql_error());
            $middleRow = ceil(mysql_num_rows($resultPar) / 2);
            $nb=0;
            $nbParChecked = 0;
            while($Par=mysql_fetch_array($resultPar)){
                $nb++;
                echo "<tr>";
                if (in_array($Par['ID'], $checkedId)){
                    echo "    <td><input type='checkbox' checked='checked' name='para".$Par['ID']."' value='".$Par['ID']."'></td>";
                    $nbParChecked ++;
                }
                else
                    echo "    <td><input type='checkbox' name='para".$Par['ID']."' value='".$Par['ID']."'></td>";
                echo "    <td>".$Par['LIBELLE']."</td>";
                echo "</tr>";
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
            $resultCheckedMM=mysql_query("SELECT ID_1 FROM UTILISER WHERE ID = $id;")or die(mysql_error());
            $checkedId = array();
            while($resCheckedId=mysql_fetch_array($resultCheckedMM))
                array_push($checkedId, $resCheckedId['ID_1']);
            $reqMM="SELECT ID,LIBELLE FROM MOYEN_MESURE;";
            $resultMM=mysql_query($reqMM)or die(mysql_error());
            $middleRow = ceil(mysql_num_rows(mysql_query($reqMM)) / 2);
            $nb=0;
            $nbMMChecked = 0;
            $prevLib='';
            while($MM=mysql_fetch_array($resultMM)){
                if($MM['LIBELLE'] != $prevLib){
                    $nb++;
                    echo "<tr>";
                    if (in_array($MM['ID'], $checkedId)){
                        echo "  <td><input type='checkbox' checked='checked' name='mmes".$MM['ID']."' value='".$MM['ID']."'></td>";
                        $nbMMChecked ++;
                    }
                    else
                        echo "  <td><input type='checkbox' name='mmes".$MM['ID']."' value='".$MM['ID']."'></td>";
                    echo "  <td>".$MM['LIBELLE']."</td>
                          </tr>";
                }
                $prevLib = $MM['LIBELLE'];
                if($nb == $middleRow)echo "</table><table class='inline'>";
            };
        ?>
		</table>
		<button class="submit">Enregistrer</button>
	</div>
    <form id="ctrlForm" class="formulaire">
    <table>
        <tr style="display:none;"><td><input type="text" name="id" value="<?php echo $id;?>"/></td></tr>
        <tr style="display:none;"><td><input type="text" name="pdf_edit" value="<?php echo $ctrl['PDF_EDIT'];?>"/></td></tr>
        <tr class='static menu type'>
            <td><label class="titre">Type: </label></td>
            <td colspan=7>
                <div class="radio" style="display:inline;">
		            <input type="radio" id="brEssai" name="radioType" <?php if($ctrl['TYPE_CTRL'] == 'ACE')echo "checked=true" ?> value="ACE"/><label for="brEssai">ACE</label>
		            <input type="radio" id="brVerif" name="radioType" <?php if($ctrl['TYPE_CTRL'] == 'CV')echo "checked=true" ?> value="CV"/><label for="brVerif">CV</label>
		            <input type="radio" id="brEtal" name="radioType" <?php if($ctrl['TYPE_CTRL'] == 'CE')echo "checked=true" ?> value="CE"/><label for="brEtal">CE</label>
			    <input type="radio" id="brInter" name="radioType" <?php if($ctrl['TYPE_CTRL'] == 'FI')echo "checked=true" ?> value="FI"/><label for="brInter">FI</label>
                </div>
                <h2 style="color:#EB8F00;display:inline;margin-left:150px;">Édition du document</h2>
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
        <tr class='static mandatory'>
            <td><label class="titre">Numéro:</label></td>
            <td><input type='text' class="ui-corner-all" value=<?php echo $ctrl['NUM'] ?> name='num' id='num' defaut=<?php include('getCtrlNum.php');?>></td>
	    <td><label class="titre narrow">Date:</label></td>
	    <td><input type="text" id="date" class='datepicker ui-corner-all' name="date" size="20" value=<?php echo date('d-m-Y',strtotime($ctrl['DATE'])) ?>></td>
        </tr>
	<tr class='static mandatory'>
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
	<tr class='static appareil mandatory'>
	    <td><label class="titre">Désignation:</label></td>
	    <td class='minWidth'><select id="AppDesi" class="combobox noArrow" name='appDesi'>
	    <?php 
		$reqApp="SELECT * FROM APP_DESI ORDER BY DESIGNATION;";
		$resultApp = mysql_query($reqApp)or die(mysql_error());
		while($res = mysql_fetch_array($resultApp)){
		    if($res['DESIGNATION'] == $ctrl['DESIGNATION'])
			echo "<option selected='selected' value='".$res['ID']."'>".$res['DESIGNATION']."</option>";
		    else
			echo "<option value='".$res['ID']."'>".$res['DESIGNATION']."</option>";
		}
	    ?>
		</select>
	    </td>
	    <td><label class="titre  narrow">Marque:</label></td>
	    <td class='minWidth'><select id="AppMarq" class="combobox noArrow" name='appMarque'>
	    <?php
		$reqApp="SELECT * FROM APP_MARQUE ORDER BY MARQUE;";
		$resultApp = mysql_query($reqApp)or die(mysql_error());
		while($res = mysql_fetch_array($resultApp)){
		    if($res['MARQUE'] == $ctrl['MARQUE'])
			echo "<option selected='selected'selected='selected' value='".$res['ID']."'>".$res['MARQUE']."</option>";
		    else
			echo "<option value='".$res['ID']."'>".$res['MARQUE']."</option>";
		}
	    ?>
	    </select>
	    </td>
	    <td><label class="titre  narrow">Type:</label></td>
            <td class='minWidth'><select id="AppType" class="combobox noArrow" name='appType'>
	    <?php
		$reqApp="SELECT * FROM APP_TYPE ORDER BY TYPE;";
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
            <td><input type='text' value='<?php echo $ctrl['NUM_SERIE'];?>' class="ui-corner-all toValidate validated" name='numS' id='numS'/></td>
	    <td rowspan=2><button style='display:none;' class="ValidateNums"><img src='img/icon_ok.png'/></button></td>
        </tr>
	<tr class='static'>
            <td><label class="titre">Num Chassis:</label></td>
            <td><input type='text' value='<?php echo $ctrl['NUM_CHASSIS'];?>' class="ui-corner-all toValidate validated" name='numC' id='numC'/></td>
        </tr>
        <tr class='Par CV CE mandatory'>
            <td><label class="titre">Paramètres:</label></td>
            <td colspan=7><select id="Par" class="combobox" name="Par"><option><?php echo $nbParChecked." selections" ?></option></select><a id="ajoutParCtr" class='editParMM' href=#><span class='ui-state-default ui-corner-all'><span class='ui-icon ui-icon-plusthick'></span></span></a></td>
        </tr>
        <tr class='CV CE mandatory'>
            <td><label class="titre">Moyens de mesure:</label></td>
            <td colspan=7><select id="MM" class="combobox" name="MM"><option><?php echo $nbMMChecked." selections" ?></option></select><a id="ajoutMMCtr" class='editParMM' href=#><span class='ui-state-default ui-corner-all'><span class='ui-icon ui-icon-plusthick'></span></span></a></td>
        </tr>
        <tr class='site CV mandatory'>
	    <td><label class="titre">Température:</label></td>
	    <td colspan=7>
		<input type='text' value='<?php echo $ctrl['TEMPERATURE'];?>' class="ui-corner-all" name='temp' id='temp'/>°C
	    </td>
	</tr>
	<tr class='ACE CE CV mandatory'>
	    <td><label class="titre">Technicien:</label></td>
	    <td colspan=7><select id="technicien" class="combobox" name='tech'>
	    <option></option>
	    <?php
		$reqTech="SELECT ID, TECH FROM TECHNICIEN;";
		$resultTech = mysql_query($reqTech)or die(mysql_error());
		while($res = mysql_fetch_array($resultTech)){
			if($res['ID'] != '1'){
			    if($res['ID'] == $ctrl['TECHNICIEN'])
				echo "<option selected='selected' value='".$res['ID']."'>".$res['TECH']."</option>";
			    else
				echo "<option value='".$res['ID']."'>".$res['TECH']."</option>";
			}
		}	
	    ?>
	    </select>
            </td>
	</tr>
	<tr class='CE CV mandatory'>
            <td><label class="titre">Jugement:</label></td>
            <td colspan=7><select class="combobox" id='jugement' name='jugement'>
                <option <?php if($ctrl['JUGEMENT']==1)echo "checked='true' " ?>value="1">Appareil conforme constructeur</option>
		<option <?php if($ctrl['JUGEMENT']==2)echo "checked='true' " ?>value="2">Appareil conforme utilisateur</option>
                <option <?php if($ctrl['JUGEMENT']==3)echo "checked='true' " ?>value="3">Appareil conforme technicien vérificateur</option>
                <option <?php if($ctrl['JUGEMENT']==4)echo "checked='true' " ?>value="4">Réparation constructeur</option>
		<option <?php if($ctrl['JUGEMENT']==5)echo "checked='true' " ?>value="5">Réparation utilisateur</option>
                <option <?php if($ctrl['JUGEMENT']==6)echo "checked='true' " ?>value="6">Réparation technicien vérificateur</option>
                <option <?php if($ctrl['JUGEMENT']==7)echo "checked='true' " ?>value="7">Non conforme</option>
            </select></td>
        </tr>
	    <tr class='ACE CV'>
            <td><label class="titre">Observation:</label></td>
            <td colspan=7><textarea type='textarea' class="ui-corner-all" name='observation' id='observation'><?php echo $ctrl['OBSERVATION'] ?></textarea></td>
        </tr>
	<tr class='FI mandatory'>
	    <td><label class="titre">Documents:</label></td>
	    <td colspan=7>
		<select id="docsSt" class="combobox" name="docST">
		    <?php
			echo "<option value='".$ctrl['DOCST']."' selected='selected'>".$ctrl['DOCST']."</option>";
			$reqDocSt = "SELECT DISTINCT DOCST FROM CONTROLE WHERE TYPE_CTRL='FI';";
			$res = mysql_query($reqDocSt)or die(mysql_error());
			while($docSt = mysql_fetch_array($res)){
			    if($docSt['DOCST'] <> $ctrl['DOCST'])
				echo "<option value='".$docSt['DOCST']."'>".$docSt['DOCST']."</option>";
			}

		    ?> 
		</select>
	    </td>
	</tr>
	<tr class='FI mandatory'>
	    <td><label class="titre">Numéro certificat ST:</label></td>
	    <td>
		<input type='text' class='ui-corner-all' name='docNum' id='docNum' value='<?php echo $ctrl['DOCNUM'] ?>'/>
	    </td>
	</tr>
        <tr class='static bouttons'><td colspan=7><button class="submit">Enregistrer</button></td></tr>
	</table>
	</form>
</div>
