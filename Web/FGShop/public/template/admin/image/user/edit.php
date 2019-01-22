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

                       <div class="col-xs-8">
                        <label>Product</label>
                        <select class="form-control" data-style="btn-success" name='id_user'>
                            <?php
                                foreach ($users as $key => $value) {
                                    $arr = (array) $value;
                                    $id = $arr['id'];
                                    $name = $arr['username'];
                                    if ($object->id_user == $id)
                                      echo "<option value='$id' selected>$id - $name</option>";
                                    else
                                      echo "<option value='$id'>$id - $name</option>";
                                }
                                ?>
                        </select>
                      </div>

                      <div class="col-xs-3">
                        <label>Type</label>
                        <select class="form-control" data-style="btn-success" name="type">
                            <option value="PRIMARY" <?php echo $object->type == 'PRRIMARY' ? 'selected' : '';?>>PRIMARY</option>
                            <option value="BANNER" <?php echo $object->type == 'BANNER' ? 'selected' : '';?> >BANNER</option>
                            <option value="DETAIL" <?php echo $object->type == 'DETAIL' ? 'selected' : '';?>>DETAIL</option>
                            <option value="LOGO" <?php echo $object->type == 'LOGO' ? 'selected' : '';?>>LOGO</option>
                        </select>
                      </div>

                  </div>

                  <!-- Test Image File -->
                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Image</label>
                              <input name="path" id="path" type="file" class="file" data-preview-file-type="any" data-upload-url="admin.php?controller=ImageProduct&action=upload&token=<?=$token?>">
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
