<?php
@session_start();

if(!(isset($_SESSION["username"]) &&isset($_SESSION["password"])))
{
    header("location:home.php");
}

include_once ("headerfiles.html");

?>
<div class="container">
    <table class="table table-striped">
<tbody id="searchOutput">

</tbody>
    </table>
</div>


