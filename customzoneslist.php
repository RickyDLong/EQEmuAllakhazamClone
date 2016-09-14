<?php
	$Title="Custom Zones List";
	require_once('./includes/config.php');
	require_once($includes_dir.'constants.php');
	require_once($includes_dir.'headers.php');
	require_once($includes_dir.'mysql.php');
	require_once($includes_dir.'functions.php');

	print "<table border=0 width=100%><tr valign=top><td width=100%>";

	$query="SELECT $tbzones.short_name,
		$tbzones.long_name,
		$tbzones.zoneidnumber,
		$tbzones.note
		FROM $tbzones
		WHERE $tbzones.file_name";

	$query.=" ORDER BY $tbzones.file_name ASC";

	$result=mysql_query($query) or message_die('zones.php','MYSQL_QUERY',$query,mysql_error());
	print '<center><table border=0 cellpadding="5" cellspacing="0"><tr>
		<td class="menuh">Name</td>
		<td class="menuh">Short Name</td>
		<td class="menuh">Zone ID</td>
		<td class="menuh">Zone Details</td>
		';
		
	$RowClass = "lr";
	while ($row=mysql_fetch_array($result))
	{
		if (substr_count(strtolower($row["note"]), "disabled") == 0)
		{
			print "<tr class='" .$RowClass. "'>
				<td valign='top'><a href=zone.php?name=".$row["short_name"].">".$row["long_name"]."</a></td>
				<td valign='top'>".$row["short_name"]."</td>
				<td valign='top'>".$row["zoneidnumber"]."</td>
				<td valign='top'>".$row["note"]."</td>
				</tr>";
		}
		if ($RowClass == "lr"){
			$RowClass = "dr";
		}
		else{
			$RowClass = "lr";
		}
	}
	print "</table></center>";

	print "</td><td width=0% nowrap>";

	print "</td></tr></table>";


?>