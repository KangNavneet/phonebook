

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
                if(this.response=="0")
                {
                    response="<h1 class='text-primary'>Duplicate Data Exist</h1>";

                }
                else if(this.response=="1")
                {
                    response="<h1 class='text-danger'>DATA INSERTED SUCCESSFULLY</h1>"
                }
                else if(this.response=="2")
                {
                    response="<h1 class='text-warning'>FAILURE!!!</h1>"

                }
                else
                {
                    response="<h1 class='text-danger'>GOD KNOWS!!!</h1>"

                }


                document.getElementById("output").innerHTML=response;
            }
        }



    }

}

