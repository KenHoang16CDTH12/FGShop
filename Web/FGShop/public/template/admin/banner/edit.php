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

                       <div class="col-xs-11">
                        <label>Product</label>
                        <select class="form-control" data-style="btn-success" name='id_product'>
                            <?php
                                foreach ($products as $key => $value) {
                                    $arr = (array) $value;
                                    $id = $arr['id'];
                                    $name = $arr['name_product'];
                                    if ($object->id_product == $id)
                                      echo "<option value='$id' selected>$id - $name</option>";
                                    else
                                      echo "<option value='$id'>$id - $name</option>";
                                }
                                ?>
                        </select>
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
