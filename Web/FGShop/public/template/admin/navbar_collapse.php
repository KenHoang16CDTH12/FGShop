<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
        <!--     <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
                                <p>Stats</p>
                            </a>
                        </li> -->
        <?php
            if ($page_name=='Manage') {
         ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="ti-filter"></i>
                <p class="filter"></p>
                <p id="p2">Filter</p>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li id="li">
                    <a href="<?="admin.php?controller=manage&action=index&token=$token&filter=1"?>">Out of stock</a>
                    <a href="<?="admin.php?controller=manage&action=index&token=$token&filter=2"?>">Coming out stock</a>
                    <a href="<?="admin.php?controller=manage&action=index&token=$token&filter=3"?>">In stock</a>
                </li>
            </ul>
        </li>
        <?php
        }
         ?>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="ti-bell"></i>
                <p class="notification"></p>
                <p id="p2">Notifications</p>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li id="li">
                    <a href="#">Another notification</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="ti-settings"></i>
                <p id="p2">Settings</p>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="admin.php?controller=user&action=logout&token=<?=$token?>">Logout</a>
                </li>
            </ul>
        </li>
    </ul>

</div>
