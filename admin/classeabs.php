
    <?php

        include '../inc/db_conn.php'; 
        session_start();
        if(!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
        header("Location: index.php");
        exit;
        }
        $user_id = $_SESSION['id'];
        $classe_id = $_GET['id'];
        $select = mysqli_query($conn, "SELECT * FROM `classe` WHERE id = '$classe_id'") or die('query failed');
        if(mysqli_num_rows($select) > 0){
        $classe = mysqli_fetch_assoc($select);
        $classename=$classe['name'];
        $classedept=$classe['dept'];
        }
       

        $select = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select) > 0){
        $admin = mysqli_fetch_assoc($select);
        }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" />

     

    <title>Admin Dashboard</title>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!--profile form-->
        <div class="modal fade " id="profilModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg ">
                                                <div class="modal-content ">
                                                    <div class="modal-header">
                                                        <h3 style=" font-size: 30px; color: green; text-transform: uppercase;">your profile</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="update-profile">

                                                       

                                                        <form action="" method="post" enctype="multipart/form-data">
                                                        
                                                        <div class="flex">
                                                            <div class="inputBox">
                                                                <span>Id :</span>
                                                                <input type="number" value="<?php echo $admin['id']; ?>" class="box" readonly>
                                                                <span>Username :</span>
                                                                <input type="text" name="update_name" value="<?php echo $admin['name']; ?>" class="box" readonly>
                                                                <span>Your email :</span>
                                                                <input type="text" name="update_email" value="<?php echo $admin['email']; ?>" class="box" readonly>
                                                                
                                                            </div>
                                                            <div class="inputBox">
                                                                <span>password :</span>
                                                                <input type="text"  value="<?php echo $admin['password']; ?>" class="box" readonly>
                                                                <span>your image :</span>
                                                                <?php
                                                                    if($admin['image'] == ''){
                                                                    echo '<img src="images/default-avatar.png">';
                                                                    }else{
                                                                    echo '<img src="../uploaded_img/'.$admin['image'].'">';
                                                                    }
                                                                    if(isset($message)){
                                                                    foreach($message as $message){
                                                                        echo '<div class="message">'.$message.'</div>';
                                                                    }
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <a class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#upprofilModal">Update Profile</a>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                            </div>
                                                <style>
                                                        .update-profile{
                                                        background-color: #bcc;
                                                        display: flex;
                                                        }

                                                        .update-profile form{
                                                        margin:10%;
                                                        padding:2%;
                                                        background-color: #fff;
                                                        box-shadow: 0 5px 10px rgba(0,0,0,.1);
                                                        width: 700px;
                                                        text-align: center;
                                                        border-radius: 5px;
                                                        }

                                                        .update-profile form img{
                                                        height: 50%;
                                                        width: 50%;
                                                        border-radius: 10%;
                                                        object-fit: cover;
                                                        margin-top:10px;
                                                        margin-bottom: 5px;
                                                        margin-left: -30px;
                                                        }

                                                        .update-profile form .flex{
                                                        display: flex;
                                                        justify-content: space-between;
                                                        margin-bottom: 20px;
                                                        gap:15px;
                                                        }

                                                        .update-profile form .flex .inputBox{
                                                        width: 49%;
                                                        }

                                                        .update-profile form .flex .inputBox span{
                                                        text-align: left;
                                                        display: block;
                                                        margin-top: 15px;
                                                        font-size: 17px;
                                                        color:#333;
                                                        }

                                                        .update-profile form .flex .inputBox .box{
                                                        width: 100%;
                                                        border-radius: 5px;
                                                        background-color: #bcc;
                                                        padding:12px 14px;
                                                        font-size: 17px;
                                                        color:#333;
                                                        margin-top: 10px;
                                                        }

                                                        @media (max-width:650px){
                                                        .update-profile form .flex{
                                                            flex-wrap: wrap;
                                                            gap:0;
                                                        }
                                                        .update-profile form .flex .inputBox{
                                                            width: 100%;
                                                        }
                                                        }
                                                </style>
                        <!--fin profile form-->
                        <!--UPDATE profile form-->
                                    <div class="modal fade " id="upprofilModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg ">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                    <h3 style=" font-size: 30px; color: green; text-transform: uppercase;">Update profile</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="update-profile">
                                                    <form action="" method="post" enctype="multipart/form-data">
                                                    <div class=" image-container p-5">
                                                    <?php
                                                        if($admin['image'] == ''){
                                                            echo '<img src="images/default-avatar.png">';
                                                        }else{
                                                            echo '<img src="../uploaded_img/'.$admin['image'].'">';
                                                        }
                                                        if(isset($message)){
                                                            foreach($message as $message){
                                                                echo '<div class="message">'.$message.'</div>';
                                                            }
                                                        }
                                                    ?>
                                                    <style>
                                                        .image-container {
                                                        position: relative;
                                                        }

                                                        .icon-overlay {
                                                        position: absolute;
                                                        top: -120px;
                                                        left: 90px;
                                                        width: 100%;
                                                        height: 100%;
                                                        display: flex;
                                                        justify-content: center;
                                                        align-items: center;
                                                        opacity: 0;
                                                        transition: opacity 0.2s ease-in-out;
                                                        }

                                                        .image-container:hover .icon-overlay {
                                                        opacity: 1;
                                                        }

                                                        .fa-file {
                                                        color: #fff;
                                                        font-size: 24px;
                                                        }

                                                    </style>
                                                    <div class="icon-overlay">
                                                    <label for="finput">
                                                        <i class="fa-solid fa-pen-to-square fa-2xl" style="width:350%; color: #05d5ff;"></i>
                                                    </label>
                                                    </div> 
                                                    <input id="finput" style="display:none;" type="file" name="update_image" accept="image/jpg, image/jpeg, image/png">
                                                </div>
                                                    <div class="flex">
                                                        <div class="inputBox">
                                                            <span>name :</span>
                                                            <input type="text" name="update_name" value="<?php echo $admin['name']; ?>" class="box">
                                                            <span>your email :</span>
                                                            <input type="text" name="update_email" value="<?php echo $admin['email']; ?>" class="box">
                                                            <span>conferm email :</span>
                                                            <input type="text" name="update_email" value="<?php echo $admin['email']; ?>" class="box">
                                                        </div>
                                                        <div class="inputBox">
                                                            <input type="hidden" name="old_pass" value="<?php echo $admin['password']; ?>">
                                                            <span>old password :</span>
                                                            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
                                                            <span>new password :</span>
                                                            <input type="password" name="new_pass" placeholder="enter new password" class="box">
                                                            <span>confirm password :</span>
                                                            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
                                                        </div>
                                                    </div>
                                                    <input type="submit" value="update profile" name="upprofile" class="btn btn-success">
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>
                                    </div>  
                                        <?php
                                                if(isset($_POST['upprofile'])){
                                                $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
                                                $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
                                                mysqli_query($conn, "UPDATE `admin` SET name = '$update_name', email = '$update_email' WHERE id = '$user_id'") or die('query failed');
                                                $old_pass = $_POST['old_pass'];
                                                $update_pass = $_POST['update_pass'];
                                                $new_pass = $_POST['new_pass'];
                                                $confirm_pass = $_POST['confirm_pass'];

                                                if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
                                                    if($update_pass != $old_pass){
                                                        $message[] = 'old password not matched!';
                                                    }elseif($new_pass != $confirm_pass){
                                                        $message[] = 'confirm password not matched!';
                                                    }else{
                                                        mysqli_query($conn, "UPDATE `admin` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
                                                        $message[] = 'password updated successfully!';
                                                    }
                                                }

                                                $update_image = $_FILES['update_image']['name'];
                                                $update_image_size = $_FILES['update_image']['size'];
                                                $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
                                                $update_image_folder = '../uploaded_img/'.$update_image;

                                                if(!empty($update_image)){
                                                    if($update_image_size > 2000000){
                                                        $message[] = 'image is too large';
                                                    }else{
                                                        $image_update_query = mysqli_query($conn, "UPDATE `admin` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
                                                        if($image_update_query){
                                                            move_uploaded_file($update_image_tmp_name, $update_image_folder);
                                                        }
                                                        $message[] = 'image updated succssfully!';
                                                    }
                                                }

                                                }

                                        ?>
                        <!--fin UAPDATE profile form-->
                  
      <?php include 'header.php'?>

                    <!-- Page Content -->

            <div class="container-fluid px-4">
                
                 

                    <div class="row my-5">
                   
                   
                              <h3>student of this classe</h3>
                    <table class="table bg-white rounded shadow-sm  table-hover">
                        <thead>
                            <tr>
                            <th scope="col">#<button class="btn btn-sm btn-link" onclick="sortTable(1)"><i class="fas fa-sort"></i></button></th>
                            <th scope="col">ID<button class="btn btn-sm btn-link" onclick="sortTable(2)"><i class="fas fa-sort"></i></button></th>
                            <th scope="col">Name<button class="btn btn-sm btn-link" onclick="sortTable(3)"><i class="fas fa-sort"></i></button></th>
                            <th scope="col">jour<button class="btn btn-sm btn-link" onclick="sortTable(4)"><i class="fas fa-sort"></i></button></th>
                            <th scope="col">heur<button class="btn btn-sm btn-link" onclick="sortTable(5)"><i class="fas fa-sort"></i></button></th>
                            <th scope="col">Classe<button class="btn btn-sm btn-link" onclick="sortTable(6)"><i class="fas fa-sort"></i></button></th>
                            <th scope="col">dept<button class="btn btn-sm btn-link" onclick="sortTable(7)"><i class="fas fa-sort"></i></button></th>
                            <th scope="col">situation<button class="btn btn-sm btn-link" onclick="sortTable(8)"><i class="fas fa-sort"></i></button></th>
                            <th scope="col">add justification<button class="btn btn-sm btn-link" onclick="sortTable(9)"><i class="fas fa-sort"></i></button></th>
                           
                            
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                            $i = 1;
                            $query = "SELECT student.id as id, student.name as name, student.classe, classe.name as classe, classe.dept, dept.name  as dept, absence.nbheur as heur, absence.jour as jour , absence.tabrir as tabrir FROM student
                            JOIN classe ON student.classe=classe.id
                            JOIN dept ON classe.dept=dept.id
                            JOIN absence ON absence.idstudent=student.id
                            where classe.name = $classename and dept.id = $classedept"; 
                            $result = $conn->query($query);
                            while($row = $result->fetch_assoc()):
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class=""><b><?php echo $row['id'] ?></b></td>
                                    <td><b><?php echo ucwords($row['name']) ?></b></td>
                                    <td><?php echo $row['jour']?></td>
                                    <td><?php echo $row['heur']?></td>
                                    <td><?php echo $row['classe']?></td>
                                    <td><?php echo $row['dept']?></td>
                                    <td><?php if ($row['tabrir']=='') {
                                      echo'<span class="badge rounded-pill bg-danger"> not justificated</span>';
                                    }else {
                                        echo '<span class="badge rounded-pill bg-success">justificated</span>';
                                    } ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group me-5">

                                        
                                        <?php 
                                            if ($row['tabrir']=='') {
                                            echo '<a href="addtabrir.php?id='.$row['id'].'" class="btn btn-success btn-flat"><i class="fas fa-add mx-2"></i>
                                        </a>';
                                            }else {
                                                echo '<a href="addtabrir.php?id='. $row['id'].'" class="btn btn-primary btn-flat">
                                                <i class="fas fa-edit mx-2"></i>
                                            </a>';
                                            } 
                                        ?>


                                        </div>
                                    </td>
                                    
                            <?php endwhile;
                            ?>
                        </tbody>
                    </table>
                

                    </div>
                </div>
            </div>
        </div>
    </div>
<h6 class="text-center bg-dark text-white p-3 m-0"> Copyright @ <?php echo date("Y")?>. MEKKAOUI ABD-ESSAMAD | 15/03/2023 | SCHOOL MANAGMENT SYSTEM| ECOL NORMAL SUPERIEUR, MARRAKECH.  All Rights Reserved.</h6>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
    <script>
       function sortTable(colIndex) {
        var table = document.querySelector('.table');
        var tbody = table.querySelector('tbody');
        var rows = Array.from(tbody.querySelectorAll('tr'));
        var sortOrder = table.getAttribute('data-sort-order') || 'asc';

        rows.sort(function(a, b) {
            var aValue = a.querySelector('td:nth-child(' + colIndex + ')').textContent;
            var bValue = b.querySelector('td:nth-child(' + colIndex + ')').textContent;
            return sortOrder === 'asc' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
        });

        tbody.innerHTML = '';
        rows.forEach(function(row) {
            tbody.appendChild(row);
        });

        if (sortOrder === 'asc') {
            table.setAttribute('data-sort-order', 'desc');
        } else {
            table.setAttribute('data-sort-order', 'asc');
        }
        }

    </script>
</body>

</html>