<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $idError = null;
        $nameError = null;
         
        // keep track post values
        $id = $_POST['id'];
        $name = $_POST['name'];
         
        // validate input
        $valid = true;
        if (empty($id)) {
            $idError = 'Id is empty';
            $valid = false;
        }

        if (empty($name)) {
            $nameError = 'Name is empty';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE player SET score = score + 1 WHERE id = ? AND name = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id, $name));
            Database::disconnect();
            header("Location: index.php");
        }
    }

?>



