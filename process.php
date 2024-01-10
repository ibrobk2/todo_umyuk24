<?php
require_once("server.php");

// Add todo section
if(isset($_GET['add'])){
    // Variable declaration
    $todo = $_GET['todo'];
    $priority = $_GET['priority'];


    // Inserting values to DB
    $sql = "INSERT INTO `todo` (todo, priority) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $todo, $priority);
    $result =  $stmt->execute();

    if($result){
        header("Location: index.php?alert=success&msg=Record Added Successfully...");
    }


}


// Update todo section

if(isset($_GET['update'])){
    $id = $_GET['hidden'];
    $todo = $_GET['todo'];
    $priority = $_GET['priority'];

    $sql = "UPDATE todo SET todo=?, priority=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $todo, $priority, $id);
    $res = $stmt->execute();
    
    if($res){
        header("Location: index.php?alert=success&msg=Record Updated Successfully...");
    }

}

?>
