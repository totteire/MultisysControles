<button class="btAjout"><h1> +&nbsp; &nbsp; Technicien</button>

<table><tr><td>
    <H2>Techniciens:</H2>
    <table id="tableau" class="tableau tablesorter">
        <thead><tr><th class=info></th><th class="topLeft">Nom</th><th class='topRight'>Signature</th></tr></thead>
        <tbody>
        <?php
            include('connect.php');
            $req="SELECT * FROM TECHNICIEN ORDER BY TECH;";
            $nb=0;
            $result=mysql_query($req) or die(mysql_error());
            while($res=mysql_fetch_array($result))
            {
                if($res['ID'] != '1'){
                    echo "<tr>
                        <td id='id' class='info'>".$res['ID']."</td>
                        <td id='nom'>".$res['TECH']."</td>
                        <td id='signature'><img src=".$res['SIGNATURE']." width='80px' height='36px'\>".$res['SIGNATURE']."</td>
                    </tr>";
                    $nb++;
                }
            }
        ?>
        </tbody>
    </table>
    </td><td style="padding-left: 15px;">
        <h2>Nombre de résultats dans LISTE</h2>
        <select id="nbRes">
            <option value="0">300 derniers constats</option>
            <option value="1">6 derniers mois</option>
            <option value="2">Année courante</option>
            <option value="3">Tous les résultats</option>
        </select>
    </td></tr>
    </table>
<button id='sync' style='position:fixed;top:35%;right:2%;'><h3>Synchronisation</h3></button>

<div id="dialogOpt" class="dialog">
	<div id="stylized" class="myform">
		<form id="formClient" class="formulaire">
			<h1>Nouveau Client</h1>
			<p></p>
			<input class='info' type='text' name='id' id='id'/>
			<label>Nom:</label>
			<input type="text" name="nom" id="nom" />
			<label>Signature:</label>
			<input type="text" name="signature" id="signature" />
			<button class="submit">Enregistrer</button>

		</form>
	</div>
</div>
