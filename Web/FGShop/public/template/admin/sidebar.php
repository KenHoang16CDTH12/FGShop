<div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
    Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
    Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
  -->

    <div class="sidebar-wrapper">
        <div class="logo">
            <a id="logo" href="<?=" admin.php?controller=dashboard&action=index&token=$token "?>" class="simple-text">
                FGShop
            </a>
        </div>

        <ul class="nav">
            <li <?php echo $page_name=='Dashboard' ? "class='active'" : "" ?> >
                <a href='<?="admin.php?controller=dashboard&action=index&token=$token"?>'>
                    <i class="ti-panel"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li <?php echo $page_name=='Manage' ? "class='active'" : "" ?> >
                <a href='<?="admin.php?controller=manage&action=index&token=$token"?>'>
                    <i class="ti-package"></i>
                    <p>Manage</p>
                </a>
            </li>

            <li <?php echo $page_name=='Banner' ? "class='active'" : "" ?> >
                <a href='<?="admin.php?controller=banner&action=index&token=$token"?>'>
                    <i class="ti-layout-slider"></i>
                    <p>Banner</p>
                </a>
            </li>

            <li <?php echo $page_name=='Report' ? "class='active'" : "" ?> >
                <a href='<?="admin.php?controller=report&action=index&token=$token"?>'>
                    <i class="ti-stats-up"></i>
                    <p>Report</p>
                </a>
            </li>

            <li class="active-pro">
                <a href="admin.php?controller=user&action=logout&token=<?=$token?>">
                    <i class="ti-power-off"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
</div>
