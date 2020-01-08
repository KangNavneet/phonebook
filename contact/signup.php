<?php
include_once ("publicheader.php");
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

    ?>
    <script>

        function  signupForm() {


            if($('#addAdminForm').valid()) {
                var controls=document.getElementById("addAdminForm").elements;
                var formdata=new FormData();
                for(var i=0;i<controls.length;i++)
                {
                    formdata.append(controls[i].name,controls[i].value);
                    console.log(controls[i].name,controls[i].value);
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
                            response="<h1 class='text-primary'>Duplicate Data Exist</h1>";

                        }
                        else if(this.response==1)
                        {
                            response="<h1 class='text-danger'>DATA INSERTED SUCCESSFULLY</h1>";

                        }
                        else if(this.response==2)
                        {
                            response="<h1 class='text-warning'>FAILURE!!!</h1>"

                        }
                        else
                        {
                            response="<h1 class='text-danger'>GOD KNOWS!!!</h1>"

                        }


                        document.getElementById("output").innerHTML=response;
                        setTimeout(function () {
                            $("#output").html("");
                            $("#username").val("");
                            $("#password").val("");
                            $("#conpassword").val("");
                            $("#mobile").val("");
                            $("#fullname").val("");
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
            <h1 class="text-center">Sign Up Admin</h1>
        </div>

    </div>
    <form id="addAdminForm" class="addAdminForm">
        <div class="form-group row">
            <label class="col-md-2">Username</label>
            <div class="col-md-4"><input type="text" name="username" id="username" class="form-control" data-rule-required="true">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2">Password</label>
            <div class="col-md-4"><input type="password" name="password" id="password" class="form-control"
                                         data-rule-required="true">
            </div>

        </div>

        <div class="form-group row">
            <label class="col-md-2">Confirm Password</label>
            <div class="col-md-4"><input type="password" name="conpassword" id="conpassword" class="form-control"
                                         data-rule-equalTo="#password">
            </div>
        </div>

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
            <div class="col-md-4"><button type="button" class="btn btn-danger" value="Submit" name="signup" onclick="signupForm()">Signup</button>
            </div>
        </div>
    </form>


    <div id="output"></div>
</div>
</body>
</html>
