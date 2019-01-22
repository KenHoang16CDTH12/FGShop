<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">
                <?=$action_name?>
            </h4>
        </div>
        <div class="content">
            <form action="admin.php?controller=<?=$page_name?>&action=update&id=<?=$object->id?>&token=<?=$token?>" method="post">

                  <div class="row">
                      <div class="col-md-1">
                          <div class="form-group">
                              <label>#ID</label>
                              <input name="id" type="text" class="form-control border-input" disabled placeholder="ID" value="<?=$object->id?>">
                          </div>
                      </div>



                      <div class="col-md-11">
                          <div class="form-group">
                              <label>Name Group</label>
                              <input name="name_group" type="text" class="form-control border-input" placeholder="Role" value="<?=$object->name_group?>">
                          </div>
                      </div>

                    </div>

                     <!-- Test Image File -->
                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Image</label>
                              <input name="image" id="path" type="file" class="file" data-preview-file-type="any" data-upload-url="admin.php?controller=GroupProductType&action=upload&token=<?=$token?>">
                          </div>
                      </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-info btn-fill btn-wd" onclick="update()">Update <?=$page_name?></button>
                    </div>

                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
