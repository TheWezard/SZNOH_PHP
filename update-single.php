<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/iframe.js"></script>
  </head>
<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */
 $connectionInfo = array("UID" => "ServerAdmin@sznoh", "pwd" => "WCYwcy123", "Database" => "SZNOH_DB", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
 $serverName = "tcp:sznoh.database.windows.net,1433";
 $conn = sqlsrv_connect($serverName, $connectionInfo);


require_once('functions.php');

 if (isset($_POST['ID'])) {

   $rowToUpdate = $_POST['ID'];
   $tsql= "UPDATE Platnosci_SZNOH SET IDPlatnosci = ?, Zaplacono = ?, Zaliczka = ?, CalaKwota = ?  WHERE IDPlatnosci = ?";
   $params = array($_POST['ID'], $_POST['Zap'], $_POST['Zal'], $_POST['Cal'], $rowToUpdate);

   $getResults= sqlsrv_query($conn, $tsql, $params);
   $rowsAffected = sqlsrv_rows_affected($getResults);
   echo "Zmodyfikowano wpis";
   sqlsrv_free_stmt($getResults);
 }


$row=find_row_by_id($_GET['id'], $conn);
?>
<div class="input-group mb-3">
<form method="post">
  IDPlatnosci:<br>
  <input type="text" name="ID" value="<?php echo $row[0]; ?>"><br>
  Zaplacono:<br>
  <input type="text" name="Zap" value="<?php echo $row[1]; ?>"><br>
  Zaliczka:<br>
  <input type="text" name="Zal" value="<?php echo $row[2]; ?>"><br>
  CalaKwota:<br>
  <input type="text" name="Cal" value="<?php echo $row[3]; ?>"><br><br>
  <input type="submit" value="Wprowadź">
  <form action="/Table.php">
    <input type="submit" value="Wróć" />
  </form>
</form>
</div>
<a class="btn btn-dark" href="/Table.php">Wróć</a>
</html>
