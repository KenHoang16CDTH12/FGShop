<?php    if ($page_name == 'Dashboard') {?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <a href="admin.php?controller=UserType&action=index&pages=0&token=<?=$token?>">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-warning text-center">
                                    <i class="ti-reddit"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Users Type</p>
                                    <?php echo $num_row_usertype;?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-view-list-alt"></i> user_type
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-sm-6">
            <a href="admin.php?controller=user&action=index&pages=0&token=<?=$token?>">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-success text-center">
                                    <i class="ti-user"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Users</p>
                                    <?php echo $num_row_user;?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-view-list-alt"></i> users
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-3 col-sm-6">
            <a href="admin.php?controller=image&action=index&pages=0&token=<?=$token?>">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-info text-center">
                                    <i class="ti-image"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Image</p>
                                    <?php echo $num_row_image;?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-view-list-alt"></i> image
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-3 col-sm-6">
            <a href="admin.php?controller=brand&action=index&pages=0&token=<?=$token?>">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-danger text-center">
                                    <i class="ti-layout-list-thumb-alt"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Brands</p>
                                    <?php echo $num_row_brand;?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-view-list-alt"></i> brand
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-3 col-sm-6">
            <a href="admin.php?controller=GroupProductType&action=index&pages=0&token=<?=$token?>">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-warning text-center">
                                    <i class="ti-harddrive"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Group Type</p>
                                    <?php echo $num_row_grouptype;?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-view-list-alt"></i> group_product_type
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-3 col-sm-6">
            <a href="admin.php?controller=ProductType&action=index&pages=0&token=<?=$token?>">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-success text-center">
                                    <i class="ti-harddrives"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Type</p>
                                    <?php echo $num_row_type;?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-view-list-alt"></i>
                                product_type
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-sm-6">
            <a href="admin.php?controller=product&action=index&pages=0&token=<?=$token?>">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-info text-center">
                                    <i class="ti-package"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Product</p>
                                    <?php echo $num_row_product;?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-view-list-alt"></i>
                                product
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-sm-6">
            <a href="admin.php?controller=order&action=index&pages=0&token=<?=$token?>">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-danger text-center">
                                    <i class="ti-dropbox-alt"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Order</p>
                                    <?php echo $num_row_order;?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-view-list-alt"></i> order
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>

</div>
<?php } elseif ($page_name == 'Image') { ?>

<div class="container-fluid">
    <div class="row">

         <div class="col-lg-3 col-sm-6">
            <a href="admin.php?controller=ImageUser&action=index&pages=0&token=<?=$token?>">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-danger text-center">
                                    <i class="ti-image"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>User</p>
                                    <?php echo $num_row_image_user;?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-view-list-alt"></i> image_product
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-3 col-sm-6">
            <a href="admin.php?controller=ImageProduct&action=index&pages=0&token=<?=$token?>">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-success text-center">
                                    <i class="ti-image"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Product</p>
                                    <?php echo $num_row_image_product;?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-view-list-alt"></i> image_product
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-sm-6">
            <a href="admin.php?controller=ImageBrand&action=index&pages=0&token=<?=$token?>">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-info text-center">
                                    <i class="ti-image"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Brand</p>
                                    <?php echo $num_row_image_brand;?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-view-list-alt"></i> image_brand
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
<?php } ?>
