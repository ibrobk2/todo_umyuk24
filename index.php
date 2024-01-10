<!doctype html>
<html lang="en">
    <head>
        <title>Todo App</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />


        <style>

          
            .rw td{
                background-color: azure;
            }

            tr:nth-of-type(even){
                background-color: white;
            }
        </style>
    </head>

    <body>
        <?php
            if(isset($_GET['alert'])): ?>
            <div class="alert alert-<?php echo $_GET['alert']; ?>"><b><?= $_GET['msg']; ?></b></div>
            <?php endif; ?>
        <header>
            <!-- place navbar here -->
            <h2 class="text-center text-success">Todo App</h2>
        </header>
        <main>
            <div class="input">
                <form action="process.php" method="get" class="w-50 m-auto">
                    <?php
                    include("server.php");

                    $todo = "";
                    $priority = "";
                    $update = false;

                    if(isset($_GET['edit'])){
                        $id = $_GET['edit'];
                        $update = true;

                        $sql = "SELECT * FROM todo WHERE id=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('i', $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();

                        $todo = $row['todo'];
                        $priority = $row['priority'];

                    }

                    ?>
                    <div class="form-group">
                        <label for="todo">Todo</label>
                        <input type="hidden"  class="form-control" name="hidden" value="<?=$id; ?>">
                        <input type="text" placeholder="Enter a todo" class="form-control" name="todo" value="<?=$todo; ?>">
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <select name="priority" id="" class="form-select">
                            <?php
                                if($priority!=""):
                            ?>
                            <option value="<?=$priority; ?>"><?=$priority; ?></option>
                            <!-- <option value="select">Select</option> -->
                            <option value="Urgent">Urgent</option>
                            <option value="Not-Urgent">Not-Urgent</option>
                            <?php else: ?>
                            <option value="select">Select</option>
                            <option value="Urgent">Urgent</option>
                            <option value="Not-Urgent">Not-Urgent</option>
                            <?php endif; ?>
                        </select>
                        <?php
                            if($update==true):
                        ?>
                        <button type="submit" class="btn btn-success form-control mt-3" name="update">Update</button>
                        <?php else: ?>
                        <button type="submit" class="btn btn-success form-control mt-3" name="add">Add</button>
                        <?php endif; ?>
                    </div>
                </form>
                <hr>
                <hr>

                <div class="table-responsive-md"  >
                    <h2 class="text-center text-success">List of Todo(s)</h2>
                    <table  class="table"  >
                        <thead>
                            <tr class="bg-success text-center" >
                                <th scope="col" style="background-color: skyblue;">SNO.</th>
                                <th scope="col" style="background-color: skyblue;">Todo</th>
                                <th scope="col" style="background-color: skyblue;">Priority</th>
                                <th scope="col" style="background-color: skyblue;" colspan="2" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include("server.php");
                            $sn = 1;

                            $sql = "SELECT * FROM todo";
                            $query = $conn->query($sql);
                            while($row = $query->fetch_assoc()){ ?>
                            <tr class="text-center">
                                <td scope="row"><?= $sn++; ?></td>
                                <td><?= $row['todo']; ?></td>
                                <td><?= $row['priority']; ?></td>
                                <td><a href="index.php?edit=<?=$row['id']; ?>" class="btn btn-primary">Edit</a></td>
                                <td><a href="delete.php?del=<?=$row['id']; ?>" class="btn btn-danger">Delete</a></td>
                            </tr>
                            <?php }; ?>

                           
                           
                        </tbody>
                    </table>
                </div>
                
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
