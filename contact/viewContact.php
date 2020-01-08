<?php
@session_start();

if(!(isset($_SESSION["username"]) &&isset($_SESSION["password"])))
{
    header("location:home.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<?php
include_once("headerfiles.html");
include_once("contactHeader.php");
?>

<script>
    function editData(obj)
    {
        var fullname=obj.fullname+"";
        var mobile=obj.mobile+"";
        var email=obj.email+"";
        var photo=obj.photo+"";
        $("#editContact").modal('show');
        $("#editfullname").val(fullname);
        $("#editemail").val(email);
        $("#editmobile").val(mobile);
        $("#editoutput").html("");
        $("#editphoto").attr('src', photo);
        $("#photoDisplay").attr('src',photo);

        var fileName;
        $('input[type="file"]').change(function (e) {

            fileName = URL.createObjectURL(e.target.files[0]);
            $("#photoDisplay").attr('src', fileName);

        });



    }

    function deleteData(obj) {
        if(!confirm("Are you sure to Delete ?"))
        {

        }
        else {


            var mobile = obj.mobile;
            var userid = obj.userid;

            var formdata = new FormData();
            formdata.append("deleteContact", "deleteContact");
            formdata.append("mobile", mobile);
            formdata.append("userid", userid);
            console.log("mobile", mobile);
            console.log("userid", userid);
            var httpreg = new XMLHttpRequest();
            httpreg.onreadystatechange = function () {

                if (this.status == 200 && this.readyState == 4) {

                    if (this.response == "5") {
                        getContactData();

                    } else if (this.response == "1") {
                        response = "<h1 class='text-danger'>DATA INSERTED SUCCESSFULLY</h1>"
                    } else if (this.response == "2") {
                        response = "<h1 class='text-warning'>FAILURE!!!</h1>"

                    } else {
                        response = "<h1 class='text-danger'>GOD KNOWS!!!</h1>"

                    }


                    document.getElementById("output").innerHTML = response;

                }

            };

            httpreg.open("POST", "contactAction.php", true);
            httpreg.send(formdata);

        }
    }


    function contactEditFun()
    {
        if($('#contactEditForm').valid()) {
            var controls=document.getElementById("contactEditForm").elements;
            var formdata=new FormData();
            for(var i=0;i<controls.length;i++)
            {
                if(controls[i].type=="file")
                {
                    formdata.append(controls[i].name,controls[i].files[0]);
                    console.log(controls[i].name,controls[i].files[0]);
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
                        response="<h1 class='text-primary'>Duplicate Data Exist</h1>";

                    }
                    else if(this.response==1)
                    {
                        response="<h1 class='text-danger'>DATA UPDATED SUCCESSFULLY</h1>";
                        getContactData();

                    }
                    else if(this.response==2)
                    {
                        response="<h1 class='text-warning'>FAILURE!!!</h1>"

                    }
                    else
                    {
                        response="<h1 class='text-danger'>GOD KNOWS!!!</h1>"

                    }


                    document.getElementById("editoutput").innerHTML=response;
                    setTimeout(function () {
                        $("#editoutput").html("");
                        $("#editphoto").val("");
                        $("#editmobile").val("");
                        $("#editfullname").val("");
                        $("#editemail").val("");
                    }, 2000);
                }
            }



        }

    }


    function getContactData()
    {
        var formdata=new FormData();
        formdata.append("getAdminData","getAdminData");
        var httpreg=new XMLHttpRequest();
        httpreg.onreadystatechange=function () {

            if(this.readyState==4 && this.status==200)
            {
                var tab="";

                var data=JSON.parse(this.response);
                for(var i=0;i<data.length;i++)
                {
                    tab+="<tr>";
                    tab+="<td>"+data[i]["fullname"]+" </td>";
                    tab+="<td>"+data[i]["mobile"]+" </td>";
                    tab+="<td>"+data[i]["email"]+" </td>";
                    tab+="<td><img src="+data[i]["photo"]+" style='width:100px;height:100px'/> </td>";
                    tab+="<td><span class='fa fa-edit' style='cursor:pointer' onclick='editData(   "+JSON.stringify(data[i])+")'></span> </td>";
                    tab+="<td><span class='fa fa-trash' style='cursor: pointer' onclick='deleteData("+JSON.stringify(data[i])+")'></span></td>";
                    tab+="</tr>"

                }

                document.getElementById("output").innerHTML=tab;


            }

        };
        httpreg.open("POST","contactAction.php",true);
        httpreg.send(formdata);

    }

    $(document).ready(function(){


        getContactData();

    });

</script>

<body>
<div class="container">

    <table class="table table-dark">
        <thead>
        <th>FULL NAME</th>
        <th>MOBILE</th>
        <th>EMAIL</th>
        <th>Photo</th>
        <th colspan="2">CONTROLS</th>
        </thead>

        <tbody id="output">

        </tbody>
    </table>


    <!--------------MODAL POPUP---->

    <!-- Modal -->
    <div id="editContact" class="modal fade" role="dialog">
        <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="text-center">UPDATE CONTACT</h1>
                            </div>

                        </div>
                        <form id="contactEditForm" class="contactEditForm" enctype="multipart/form-data">

                            <div class="form-group row">
                                <label class="col-md-4">Fullname</label>
                                <div class="col-md-8"><input type="text" name="editfullname" id="editfullname" class="form-control"
                                                             data-rule-required="true">
                                </div>

                            </div>



                            <div class="form-group row">
                                <label class="col-md-4">Mobile</label>
                                <div class="col-md-8"><input type="number" name="editmobile" id="editmobile" class="form-control"
                                                             data-rule-required="true">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-md-4">EMAIL</label>
                                <div class="col-md-8"><input type="email" name="editemail" id="editemail" class="form-control"
                                                             data-rule-required="true">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-md-4">UPLOAD PHOTO</label>
                                <div class="col-md-8'">
                                    <input type="file" name="editphoto" id="editphoto"
                                                             >
                                </div>
                                    <img style="width:100px;height:100px" id="photoDisplay"  name="photoDisplay"/>


                            </div>


                            <div class="form-group row">
                                <div class="col-md-8"><button type="button" class="btn btn-danger" value="Submit" name="contactEdit" onclick="contactEditFun()">Update CONTACT </button>
                                </div>
                            </div>
                            <input type="hidden" name="editusername" value="<?php @session_start(); echo $_SESSION["username"] ?>">
                        </form>


                        <div id="editoutput"></div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>














</div>


</body>
</html>
