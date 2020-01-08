<!-- A grey horizontal navbar that becomes vertical on small screens -->
<script>
    function searchContactFun()
    {
        var searchContactDetail=document.getElementById("searchContactDetail").value;
        var formdata=new FormData();
        formdata.append("searchContact","searchContact");
        formdata.append("contact",searchContactDetail);
        console.log("searchContact","searchContact");
        console.log("contact",searchContactDetail);

        var httpreg=new XMLHttpRequest();
        httpreg.open("POST","contactaction.php",true);
        httpreg.send(formdata);
        httpreg.onreadystatechange=function () {

            if(this.readyState==4 && this.status==200)
            {
                var data=JSON.parse(this.response);
                var tab="";
                tab+="<thead>";
                tab+="<tr>";
                tab+=" <th>FULL NAME</th>\n" +
                    "        <th>MOBILE</th>\n" +
                    "        <th>EMAIL</th>\n" +
                    "        <th>Photo</th>\n" +
                    "        "

                tab+="</tr>";
                tab+="</thead>";




                for(var i=0;i<data.length;i++)
                {
                    tab+="<tr>";
                    tab+="<td>"+data[i]["fullname"]+" </td>";
                    tab+="<td>"+data[i]["mobile"]+" </td>";
                    tab+="<td>"+data[i]["email"]+" </td>";
                    tab+="<td><img src="+data[i]["photo"]+" style='width:100px;height:100px'/> </td>";
                                        tab+="</tr>"

                }

                document.getElementById("searchOutput").innerHTML=tab;

            }
        }

    }


</script>



<nav class="navbar navbar-expand-sm bg-light">


    <!-- Links -->
    <ul class="navbar-nav">

        <li class="nav-item">
            <a class="navbar-brand" href="#">ADD CONTACTS </a>
        </li>



        <li class="nav-item">
            <a class="nav-link" href="contactPage.php">ADD Contact </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="viewContact.php">View Contact Page</a>
        </li>

        <li class="nav-item">
            <span style="cursor: pointer"><a class="nav-link" href="logout.php">LOG OUT</a></span>
        </li>
    </ul>


    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" id="searchContactDetail" onkeyup="searchContactFun()" name="searchContactDetail" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick="searchContactFun()">Search</button>
    </form>

</nav>
<?php
include_once ("searchContact.php");
?>


