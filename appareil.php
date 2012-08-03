<div class="tabs subtabs">
    <ul>
        <li><a href="#tabAppDesi">DÉSIGNATION</a></li>
        <li><a href="#tabAppMarq">MARQUE</a></li>
    	<li><a href="#tabAppType">TYPE</a></li>
	</ul>
    <div id="tabAppDesi" page='appareil.php' dialogId='#dialogAppDesi' ajout='appareil/ajoutAppDesi.php' suppr='appareil/supprAppDesi.php' modif='appareil/modifAppDesi.php' needReload='false'>
        
        <button class="btAjout"><h1> +&nbsp; &nbsp; DÉSIGNATION</h1></button>
        <table id="tableau" class="tableau tablesorter">
	        <thead><tr><th class='info'></th><th class='topLeftRight'>Désignation</th></tr></thead>
            <tbody>
	        <?php
		        include('connect.php');
		        $req="SELECT * FROM APP_DESI ORDER BY DESIGNATION;";
		        $nb=0;
		        $result=mysql_query($req) or die(mysql_error());
		        while($res=mysql_fetch_array($result))
		        {
			        echo "<tr>
            			<td id='id' class='info'>".$res['ID']."</td>
				<td id='desig'>".$res['DESIGNATION']."</a></td>
			        </tr>";
			        $nb++;
		        }
            ?>
	        </tbody>
        </table>
        <div id="dialogAppDesi" class="dialog">
	        <div id="stylized" class="myform">
		        <form id="formAppareil" class="formulaire">
			        <h1>Nouvel appareil</h1>
			        <p></p>
         			<input class='info' type='text' name='id' id='id'/>
         			
			        <label>Désignation:</label>
			        <input type="text" name="desig" id="desig" />
			        
			        <button class="submit">Enregistrer</button>
		        </form>
	        </div>
        </div>
        
    </div>
	<div id="tabAppMarq" page='appareil.php' dialogId='#dialogAppMarq' ajout='appareil/ajoutAppMarq.php' suppr='appareil/supprAppMarq.php' modif='appareil/modifAppMarq.php' needReload='false'>
    	<button class="btAjout"><h1> +&nbsp; &nbsp; MARQUE</h1></button>
        <table id="tableau" class="tableau tablesorter">
	        <thead><tr><th class='info'></th><th class='topLeftRight'>Marque</th></tr></thead>
            <tbody>
	        <?php
		        include('connect.php');
	            $req="SELECT * FROM APP_MARQUE ORDER BY MARQUE;";
		        $nb=0;
		        $result=mysql_query($req) or die(mysql_error());
		        while($res=mysql_fetch_array($result))
		        {
			        echo "<tr>
            			<td id='id' class='info'>".$res['ID']."</td>
				<td id='marque'>".$res['MARQUE']."</td>
			        </tr>";
			        $nb++;
		        }
	        ?>
	        </tbody>
        </table>
        <div id="dialogAppMarq" class="dialog">
	        <div id="stylized" class="myform">
		        <form id="formAppareil" class="formulaire">
			        <h1>Nouvel appareil</h1>
			        <p></p>
         			<input class='info' type='text' name='id' id='id'/>
         			
			        <label>Marque:</label>
			        <input type="text" name="marque" id="marque" />
			
			        <button class="submit">Enregistrer</button>
		        </form>
	        </div>
        </div>
	</div>
	<div id="tabAppType" page='appareil.php' dialogId='#dialogAppType' ajout='appareil/ajoutAppType.php' suppr='appareil/supprAppType.php' modif='appareil/modifAppType.php' needReload='false'>
    	<button class="btAjout"><h1> +&nbsp; &nbsp; TYPE</h1></button>
        <table id="tableau" class="tableau tablesorter">
	        <thead><tr><th class='info'></th><th class='topLeftRight'>Type</th></tr></thead>
            <tbody>
	        <?php
		        include('connect.php');
		        $req="SELECT * FROM APP_TYPE ORDER BY TYPE;";
		        $nb=0;
		        $result=mysql_query($req) or die(mysql_error());
		        while($res=mysql_fetch_array($result))
		        {
			        echo "<tr>
            			<td id='id' class='info'>".$res['ID']."</td>
				<td id='type'>".$res["TYPE"]."</td>
			        </tr>";
			        $nb++;
		        }
	        ?>
	        </tbody>
        </table>
        <div id="dialogAppType" class="dialog">
	        <div id="stylized" class="myform">
		        <form id="formAppareil" class="formulaire">
			        <h1>Nouvel appareil</h1>
			        <p></p>
         			<input class='info' type='text' name='id' id='id'/>
			
			        <label>Type:</label>
			        <input type="text" name="type" id="type" />
			
			        <button class="submit">Enregistrer</button>
		        </form>
	        </div>
        </div>
	</div>
</div>
