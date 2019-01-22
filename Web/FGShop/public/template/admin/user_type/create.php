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
                              <label>Role</label>
                              <input name="name_user_type" type="text" class="form-control border-input" placeholder="Role" value="">
                          </div>
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
