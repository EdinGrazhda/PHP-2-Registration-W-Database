<?php
    session_start();

    //Inicializimi i variablave
    $firstName="";
    $lastName="";
    $email="";
    $errors=array();


    $conn=mysqli_connect("localhost","root","","edin");
    mysqli_select_db($conn,'edin');

    if(isset($_POST['login']))
    {
        $firstName=mysqli_real_escape_string($conn,$_POST['firstName']);
        $lastName=mysqli_real_escape_string($conn,$_POST['lastName']);
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $password=mysqli_real_escape_string($conn,$_POST['password']);
        $confirmPassword=mysqli_real_escape_string($conn,$_POST['confirmPassword']);
        $gender=mysqli_real_escape_string($conn,$_POST['gender']);
        $birthday=mysqli_real_escape_string($conn,$_POST['birthday']);

        if(empty($firstName)) {array_push($errors,"Firstname is required");}
        if(empty($lastName)){array_push($errors,"Lastname is required");}
        if(empty($email)){array_push($errors,"Email is required");}
        if(empty($password)){array_push($errors,"Password is required");}
        if($password!=$confirmPassword)
        {
            array_push($errors,"The two passwords do not match");
        }

        $check_query="Select*from registration where firstName='$firstName' or lastName='$lastName' or email='$email' limit 1 ";
        $result=mysqli_query($conn,$check_query);
        $user=mysqli_fetch_assoc($result);

        if($user)
        { //If user exists
            if($user['firstName']===$firstName)
            {
                array_push($errors,"Firstname alreay exists");
            }

            if($user['lastName']===$lastName)
            {
                array_push($errors,"Lastname alreay exists");
            }

            if($user['email']===$email)
            {
                array_push($errors,"Email alreay exists");
            }
        }

        if(count($errors)==0)
        {
            $password=md5($password);//encrypt i passwordit para se ta ruajme ne database

            //Kujdes te veqante tek insertimi i te dhenave!!!

            $regist="Insert into registration(firstName,lastName,email,password,gender,birthday)
            values('$firstName','$lastName','$email','$password','$gender','$birthday')";

            $rows="select * from registration where firstName='$firstName' AND lastName='$lastName'";

            $run=mysqli_query($conn,$rows);

            if(mysqli_num_rows($run)<7)
            {
                mysqli_query($conn,$regist);

                echo "<script>alert('Registration completed successfully!');</script>";
                // echo "<script>window.open('Login.php','_self');</script>";
            }
            else
            {
                echo "<script>alert('Full users');</script>";
            }
            
        }


    }





?>