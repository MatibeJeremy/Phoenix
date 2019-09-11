<?php
include('dbConn.php');

$query = "SELECT * FROM table_ex";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

$output='
<table class="table table-striped table-bordered">
    <tr>
        <th width="40%">First Name</th>
        <th width="40%">Last Name</th>
        <th width="10%">Edit</th>
        <th width="10%">Delete</th>
    </tr>
';
if($total_row > 0)
{
    foreach($result as $row)
    {
        $output .='
        <tr>
            <td>'.$row["first_name"].'</td>
            <td>'.$row["last_name"].'</td>
            <td>
                <button type="button" class="btn btn-primary edit" id="'.$row["id"].'">Edit</button>
            </td>
            <td>
                <button type="button" name="delete" class="btn btn-danger delete" id="'.$row["id"].'">Delete</button>
            </td>
        </tr>
';
    }
}
else
{
    $output .='
    <tr>
        <td colspan="4" align="center">Data not found</td>
    </tr>
';}

$output .='</table>';

echo $output;

?>