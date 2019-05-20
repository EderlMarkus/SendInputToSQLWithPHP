<?php

class FormHandler
{
    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function addLineToTableInDatabase($table, $user, $data, $databaseconnection)
    {
        $sql = "INSERT INTO " . $table . " (User, data) VALUES ('" . $user . "','" . $data . "') ";
        return $databaseconnection->query($sql);
    }

    public function connectToMySQL($host, $user,$pass,$db){
        $db = new mysqli($host, $user, $pass, $db) or die('Unable to connect');
        return $db;
    }

    public function createNewSQLTable($tablename, $databaseconnection){
        $sql = "CREATE TABLE " .$tablename. " (data varchar(255), User varchar(255), Time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";
        $query = $databaseconnection->query($sql);
        return $tablename;
    }

    public function getTable($table, $databaseconnection){
        $sql = "SELECT * FROM " . $table;
        $result = $databaseconnection->query($sql);
        $returnvalue = "";
        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_array($result)) {
                $returnvalue .= $row["data"] . "<br>" . $row["User"] . "<br><br>";
            }        
        }
        return $returnvalue;
    }


}
