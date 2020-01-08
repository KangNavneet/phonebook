<?php
@session_start();

if(!(isset($_SESSION["username"]) &&isset($_SESSION["password"])))
{
    header("location:home.php");
}
?>
<!Doctype HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form</title>
    <?php
    include_once ("headerfiles.html");
    include_once ("contactHeader.php");
    ?>
    <script>

        function  contactUploadFun() {


            if($('#contactUploadForm').valid()) {
                var controls=document.getElementById("contactUploadForm").elements;
                var formdata=new FormData();
                for(var i=0;i<controls.length;i++)
                {
                    if(controls[i].type=='file')
                    {
                        formdata.append(controls[i].name,controls[i].files[0]);
                        console.log(controls[i].name,controls[i].value);
                    }
                    else
                    {
                        formdata.append(controls[i].name,controls[i].value);
                        console.log(controls[i].name,controls[i].value);
                    }
                }
                var response="";
                var httpreg=new XMLHttpRequest();
                httpreg.open("POST","contactAction.php",true);
                httpreg.send(formdata);
                httpreg.onreadystatechange=function()
                {
                    if(this.readyState==4 && this.status==200)
                    {

                        if(this.response==0)
                        {
                            response="<h1 class='text-primary'>Mobile Number Already Exist</h1>";

                        }
                        else if(this.response=="Success")
                        {
                            response="<h1 class='text-danger'>DATA INSERTED SUCCESSFULLY</h1>"
                        }
                        else if(this.response==2)
                        {
                            response="<h1 class='text-warning'>FAILURE!!!</h1>"

                        }



                        document.getElementById("output").innerHTML=response;
                        setTimeout(function () {
                            $("#output").html("");
                            $("#photo").val("");
                            $("#mobile").val("");
                            $("#fullname").val("");
                            $("#email").val("");
                        }, 2000);

                    }
                }



            }

        }


    </script>

</head>



<body>

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h1 class="text-center">SAVE CONTACT</h1>
        </div>

    </div>
    <form id="contactUploadForm" class="contactUploadForm">

        <div class="form-group row">
            <label class="col-md-2">Fullname</label>
            <div class="col-md-4"><input type="text" name="fullname" id="fullname" class="form-control"
                                         data-rule-required="true">
            </div>

        </div>



        <div class="form-group row">
            <label class="col-md-2">Mobile</label>
            <div class="col-md-4"><input type="number" name="mobile" id="mobile" class="form-control"
                                         data-rule-required="true">
            </div>

        </div>

        <div class="form-group row">
            <label class="col-md-2">EMAIL</label>
            <div class="col-md-4"><input type="email" name="email" id="email" class="form-control"
                                         data-rule-required="true">
            </div>

        </div>

        <div class="form-group row">
            <label class="col-md-2">UPLOAD PHOTO</label>
            <div class="col-md-4"><input type="file" name="photo" id="photo" class="form-control"
                                         data-rule-required="true">
            </div>

        </div>


        <div class="form-group row">
            <div class="col-md-4"><button type="button" class="btn btn-danger" value="Submit" name="contactUpload" onclick="contactUploadFun()">SAVE CONTACT </button>
            </div>
        </div>
        <input type="hidden" name="username" value="<?php @session_start(); echo $_SESSION["username"] ?>">
    </form>


    <div id="output"></div>
</div>
</body>
</html>
