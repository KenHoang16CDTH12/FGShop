<?php  if ( ! defined('PATH_PUBLIC')) die ('Bad requested!'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="public/assets/img/FGDev_Logo.png">
    <link rel="icon" type="image/png" sizes="96x96" href="public/assets/img/FGDev_Logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>FGShop</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!--  Fonts and icons     -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="public/assets/css/themify-icons.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="public/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="public/assets/css/bootstrap-glyphicons.css" rel="stylesheet">
    <!-- Animation library for notifications   -->
    <link href="public/assets/css/animate.min.css" rel="stylesheet" />
    <!--  Paper Dashboard core CSS    -->
    <link href="public/assets/css/paper-dashboard.css" rel="stylesheet" />
    <!-- Fileinput core CSS -->
    <link href="public/assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="public/assets/css/demo.css" rel="stylesheet" />
</head>
<body>

    <div class="wrapper">

        <?php require_once(PATH_PUBLIC . '/template/admin/sidebar.php'); ?>

            <div class="main-panel">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar bar1"></span>
                                <span class="icon-bar bar2"></span>
                                <span class="icon-bar bar3"></span>
                            </button>
                            <a id="page_name" class="navbar-brand" href='<?="admin.php?controller=".$page_name."&action=index&token=$token"?>'>
                                <?=$page_name?>
                            </a>
                        </div>
                        <?php require_once(PATH_PUBLIC . '/template/admin/navbar_collapse.php'); ?>
                    </div>
                </nav>

                <div class="content">
                    <?php
                        if ($page_name == 'Dashboard')
                            require_once(PATH_PUBLIC . '/template/admin/container_fluid.php');
                        if ($page_name == 'Image')
                            require_once(PATH_PUBLIC . '/template/admin/container_fluid.php');
                    ?>
                    <div class="row">
                    <?php
                        if ($action_table != null && $page_name != "Dashboard" && $page_name != "Image")
                            require_once(PATH_PUBLIC . '/template/admin/' . $action_table . '.php');
                    ?>
                    </div>
                </div>
            </div>

            <?php require_once(PATH_PUBLIC . '/template/admin/footer.php'); ?>
    </div>
    <!-- </div> -->


</body>
<!--   Core JS Files   -->
<script src="public/assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
<script src="public/assets/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Sweet alert  -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Flieinput Plugin  -->
<script src="public/assets/js/fileinput.js" type="text/javascript"></script>
<!--  Checkbox, Radio & Switch Plugins -->
<script src="public/assets/js/bootstrap-checkbox-radio.js"></script>
<!--  Notifications Plugin    -->
<script src="public/assets/js/bootstrap-notify.js"></script>
<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="public/assets/js/paper-dashboard.js"></script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="public/assets/js/demo.js"></script>
<!-- My JS -->
<script src="public/assets/js/custom.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        //demo.showNotification('top','center');
        inputfile();
    });

    function update() {
        demo.showNotification('top', 'center', 'You have updated', 'ti-write');
    }

    function create() {
        demo.showNotification('top', 'center', 'You have created', 'ti-save');
    }

    function inputfile() {
        // with plugin options
        $("#path").fileinput({'showUpload':true, 'previewFileType':'any'});
    }
</script>
</html>
