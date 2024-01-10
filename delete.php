<?php
include("server.php");


if(isset($_GET['del'])){
    $id = $_GET['del'];

    $sql = "DELETE FROM todo WHERE id=?";
    $st = $conn->prepare($sql);
    $st->bind_param('i', $id);
    $res = $st->execute();

    if($res){
        header("Location: index.php?alert=danger&msg=Record Deleted Successfully...");
    }
}

?>