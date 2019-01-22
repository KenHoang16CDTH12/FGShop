<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">
                <?=$action_name?>
            </h4>
        </div>
        <div class="content">
            <form action="admin.php?controller=<?=$page_name?>&action=store&token=<?=$token?>" method="post">
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label>#ID</label>
                            <input name="id" type="text" class="form-control border-input" disabled placeholder="ID" value="#">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control border-input" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input name="username" type="text" class="form-control border-input" placeholder="Username">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control border-input" placeholder="Password">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Birthdate</label>
                            <input name="birthdate" type="text" class="form-control border-input" placeholder="Birthdate">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Phone</label>
                            <input name="phone" type="tel" class="form-control border-input" placeholder="Phone">
                        </div>
                    </div>

                    <div class="col-xs-3">
                        <label>Gender</label>
                        <select class="form-control" data-style="btn-success" name="gender">
                            <option value="MALE">MALE</option>
                            <option value="FEMALE">FEMALE</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Identify number</label>
                            <input name="identify_number" type="text" class="form-control border-input" placeholder="Identify number">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Wallet</label>
                            <input name="wallet" type="number" min="0" class="form-control border-input" placeholder="Wallet">
                        </div>
                    </div>

                    <div class="col-xs-3">
                        <label>Is social</label>
                        <select class="form-control" data-style="btn-success" name="is_social">
                            <option value="NO">NO</option>
                            <option value="FACEBOOK">FACEBOOK</option>
                            <option value="GOOGLE">GOOGLE</option>
                        </select>
                    </div>

                    <div class="col-xs-3">
                        <label>Status</label>
                        <select class="form-control" data-style="btn-success" name='status'>
                            <option value="ACTIVE">ACTIVE</option>
                            <option value="INACTIVE">INACTIVE</option>
                        </select>
                    </div>

                    <div class="col-xs-3">
                        <label>Role</label>
                        <select class="form-control" data-style="btn-success" name='id_user_type'>
                            <?php
                                foreach ($user_types as $key => $value) {
                                    $arr = (array) $value;
                                    $id = $arr['id'];
                                    $type = $arr['name_user_type'];
                                    echo "<option value='$id'>$type</option>";
                                }
                                ?>
                        </select>
                    </div>

                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-info btn-fill btn-wd" onclick="create()">Add <?=$page_name?></button>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
