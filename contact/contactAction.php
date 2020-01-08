<?php
@session_start();
include_once ("connection.php");

if(isset($_POST["signup"]))
{

    $username=$_POST["username"];
    $password=$_POST["password"];
    $fullname=$_POST["fullname"];
    $mobile=$_POST["mobile"];

    $query="select * from signup where username='$username'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {
        echo "0";
    }
    else
    {

        $query="insert into signup values(null,'$username','$password','$fullname','$mobile')";

        if(mysqli_query($con,$query))
        {
            echo "1" ;
        }
        else
        {
            echo "2";
        }
    }





}


if(isset($_POST["loginAdmin"]))
{
    $username=$_POST["username"];
    $password=$_POST["password"];
    $query="Select * from signup where username='$username' and password='$password'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {

        $query="select id from signup where username='$username'";
        $result=mysqli_query($con,$query);
        if(mysqli_query($con,$query))
        {
            $id=mysqli_fetch_assoc($result)['id'];
            $_SESSION["username"]=$id;
            $_SESSION["password"]=$password;
            echo "3";
        }


    }
    else
    {
            echo "4";

    }

}


if(isset($_POST["contactUpload"]))
{
    $fullname=$_POST["fullname"];
    $mobile=$_POST["mobile"];
    $email=$_POST["email"];

    //$photo=$_POST["photo"];
    $temppath=$_FILES["photo"]["tmp_name"];
    $error="";
    $filepath="";
    $subcommand="";
    if($temppath !="")
    {
        $filesize = round($_FILES["photo"]["size"] / 1024, 2);
        $name = $_FILES["photo"]["name"];
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        if ($ext != "jpg" and $ext != "png") {
            $error= "please select jpg or png file only";
        } elseif ($filesize > 20000) {
            $error= "File size must be less than or equalto 20000 KB";
        } else
            {
            $filepath = "uploads/$name";// create folder named upload
            move_uploaded_file($temppath, $filepath);
        }
    }








    $photo="Hello";
    $username=$_POST["username"];
    $query="select * from contacts where mobile='$mobile'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0)
    {
        echo "0";

    }
    else
    {

        $query="insert into contacts values(null,'$fullname','$mobile','$email','$filepath',$username)";
        $result=mysqli_query($con,$query);
        if($result)
        {
            echo "Success";
        }
        else
        {
            echo "2";
        }
    }





}


if(isset($_POST["getAdminData"]))
{
    $userid=$_SESSION["username"];
    $query="select * from contacts where userid=$userid";
    $result=mysqli_query($con,$query);
    $data=array();
    if(mysqli_query($con,$query))
    {
        while($row=mysqli_fetch_array($result))
        {
            array_push($data,$row);
        }

        echo json_encode($data);

    }
}


if(isset($_POST["contactEdit"]))
{
    $fullname=$_POST["editfullname"];
    $mobile=$_POST["editmobile"];
    $email=$_POST["editemail"];
    $userid=$_POST["editusername"];
   // $photo="Photo";

    if(isset($_FILES["editphoto"]))
    {

        $temppath=$_FILES["editphoto"]["tmp_name"];
        $error="";
        $filepath="";
        $subcommand="";

        $filesize = round($_FILES["editphoto"]["size"] / 1024, 2);
        $name = $_FILES["editphoto"]["name"];
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        if ($ext != "jpg" and $ext != "png") {
            $error= "please select jpg or png file only";
        } elseif ($filesize > 20000) {
            $error= "File size must be less than or equalto 20000 KB";
        } else
        {
            $filepath = "uploads/$name";// create folder named upload
            move_uploaded_file($temppath, $filepath);
        }


    }


    $query="Select * from contacts where mobile='$mobile' ";
    $result=mysqli_query($con,$query);

    if(mysqli_num_rows($result)>1)
    {
        echo "0";
    }
    else
    {

        if(!isset($_FILES['editphoto']))
        {
            $query="update contacts set fullname='$fullname',mobile=$mobile,email='$email' where userid='$userid' and mobile='$mobile'";
            if(mysqli_query($con,$query))
            {
                echo "1";
            }
            else
            {
                echo "2";
            }
        }
        else
        {

            $query="update contacts set fullname='$fullname',mobile=$mobile,email='$email',photo='$filepath' where userid='$userid' and mobile='$mobile'";
            if(mysqli_query($con,$query))
            {
                echo "1";
            }
            else
            {
                echo "2";
            }

        }


    }

}


if(isset($_POST["deleteContact"]))
{
    $mobile=$_POST["mobile"];
    $userid=$_POST["userid"];
    $query="delete from contacts where mobile='$mobile' and userid='$userid'  ";
    if(mysqli_query($con,$query))
    {
        echo "5";
    }
    else
    {
        echo "2";
    }
}


if(isset($_POST["searchContact"]))
{
    $search=$_POST["contact"];
    $username=$_SESSION["username"];
    $query="Select * from contacts where userid=$username and (fullname like '".$search."%"."' or mobile like '".$search."%' )";
    $data=array();
    $result=mysqli_query($con,$query);
    while ($row=mysqli_fetch_array($result))
    {
        array_push($data,$row);
    }
    echo json_encode($data);
}

?>
