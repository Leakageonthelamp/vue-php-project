<?php
    $conn = new mysqli("qn66usrj1lwdk1cc.cbetxkdyhwsb.us-east-1.rds.amazonaws.com","f2sl5l30lko64e1v","ry7d2ikhxetx8ymw","wdsbf71fus33zgsp");
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }

    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    if($action == 'read'){
        $sql = $conn->query("SELECT * FROM users");
        $users = array();
        while($row = $sql->fetch_assoc()){
            array_push($users, $row);
        }
        $result['users'] = $users;
    }

    if($action == 'create'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $courses= $_POST['courses'];
        $score = $_POST['score'];
        $sql = $conn->query("INSERT INTO users (name,email,phone,courses,score) 
            VALUES('$name','$email','$phone','$courses','$score')");
        
        if($sql){
            $result['message'] = "User added successfully!";
        }
        else{
        $reset['error'] = true;
        $reset['message'] = "Failed to add user!";
        }
    }

    if($action == 'update'){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $sql = $conn->query("UPDATE users SET name='$name',email='$email',phone='$phone' WHERE id='$id'");
        
        if($sql){
            $result['message'] = "User updated successfully!";
        }
        else{
        $reset['error'] = true;
        $reset['message'] = "Failed to update user";
        }
    }

    if($action == 'delete'){
        $id = $_POST['id'];
        $sql = $conn->query("DELETE FROM users WHERE id='$id'");
        
        if($sql){
            $result['message'] = "User deleted successfully!";
        }
        else{
        $reset['error'] = true;
        $reset['message'] = "Failed to delete user";
        }
    }

    $conn->close();
    echo json_encode($result);
    ?>
