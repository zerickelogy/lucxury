<!DOCTYPE html>
<?php
session_start();
include '../../scripts/bootstrap_scripts/bootstrap_scripts.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#logout').click(function () {
                    if (confirm("Are you sure to logout?")) {
                        $.ajax({
                            type: "GET",
                            url: "../Webservices/doLogout.php",
                            cache: false,
//                        dataType: "JSON",
                            success: function (response) {
                                console.log("result for deletion: " + response);
                                location.reload();
                            },
                            error: function (obj, textStatus, errorThrown) {
                                console.log("Error " + textStatus + ": " + errorThrown);
                            }
                        });
                    }
                });
            });
        </script>
    </head>
    <body>
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <a class="navbar-brand" href="#">Welcome, <?php echo $_SESSION['merchant_name'] ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </body>
</html>
