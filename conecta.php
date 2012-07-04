<?php
$db_connection = new COM("ADODB.Connection");

$db_connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=". realpath("../databases/TramitaMZO.mde") ." ;DefaultDir=". realpath("../databases");
$db_connection->open($db_connstr);

$rs = $db_connection->execute("SELECT * FROM SALIDAS WHERE DESTINO_SALIDA = 'ZZ-1'");



$rs_fld0 = $rs->Fields(0);
$rs_fld1 = $rs->Fields(1);
$rs_fld2 = $rs->Fields(2);
$rs_fld3 = $rs->Fields(3);
$rs_fld4 = $rs->Fields(4);
$rs_fld5 = $rs->Fields(5);

echo '<table border=1>';
while (!$rs->EOF) {
	echo '<tr>';
  print "<td>$rs_fld0->value</td><td> $rs_fld1->value</td>";
  print "<td>$rs_fld2->value</td><td> $rs_fld3->value</td>";
  print "<td>$rs_fld4->value</td><td> $rs_fld5->value</td>";
  echo '</tr>';
  $rs->MoveNext(); /* updates fields! */
}
echo '</table>';
$rs->Close();
$db_connection->Close();
?> 