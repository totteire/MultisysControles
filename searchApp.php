include('connect.php');//connect to your database

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

$qstring = "SELECT TYPE, ID FROM APPAREIL WHERE TYPE LIKE '%".$term."%'";
$result = mysql_query($qstring);//query the database for entries containing the term

while ($row = mysql_fetch_array($result))//loop through the retrieved values
{
		$row['TYPE']=htmlentities(stripslashes($row['TYPE']));
		$row['ID']=(int)$row['ID'];
		$row_set[] = $row;//build an array
}
echo json_encode($row_set);//format the array into json data
