<?php
include('dbConn.php');

if(isset($_POST["action"])){
    if($_POST["action"] == "insert"){
        $query = "INSERT INTO table_ex(first_name,last_name) VALUES('".$_POST["first_name"]."','".$_POST["last_name"]."')";
        $statement = $connect -> prepare($query); //security measure to prevent injections
        $statement -> execute();
        echo '<p> Data Inserted </p>';
    }
    if ($_POST["action"] == 'fetch_single')
    {
        $query = "SELECT * FROM table_ex WHERE id = '".$_POST["id"]."'";
        $statement = $connect -> prepare($query);
        $statement-> execute();
        $result = $statement -> fetchAll();
        foreach ($result as $row)
        {
            $output['id'] = $row['id'];
            $output['first_name'] = $row['first_name'];
            $output['last_name'] = $row['last_name'];

        }
        echo json_encode($output);
    }
    if ($_POST["action"] == "update"){
        $query = "UPDATE table_ex SET first_name = '".$_POST["first_name"]."', last_name = '".$_POST["last_name"]."' WHERE id = '".$_POST["hidden_id"]."'";
        $statement = $connect -> prepare($query);
        $statement->execute();
        echo '<p> Data Updated</p>';
    }
    if ($_POST["action"] == "delete"){
        $query = "DELETE FROM table_ex WHERE id = '".$_POST["id"]."'";
        $statement = $connect -> prepare($query);
        $statement->execute();
        $data = array('message'=>'Data Deleted');
        echo json_encode($data);
    }
}
?>