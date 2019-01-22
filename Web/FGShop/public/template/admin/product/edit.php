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
                              <label>Name Product</label>
                              <input name="name_product" type="text" class="form-control border-input" placeholder="Name Product" value="<?=$object->name_product?>">
                          </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                              <label>Price</label>
                              <input name="price" type="number" class="form-control border-input" placeholder="Price" value="<?=$object->price?>" min="0">
                          </div>
                      </div>

                      <div class="col-md-3">
                          <div class="form-group">
                              <label>Quantity</label>
                              <input name="quanity" type="number" class="form-control border-input" placeholder="Quantity" value="<?=$object->quanity?>" min="0">
                          </div>
                      </div>

                      <div class="col-md-3">
                          <div class="form-group">
                              <label>ISBN</label>
                              <input name="isbn" type="text" class="form-control border-input" placeholder="ISBN" value="<?=$object->isbn?>">
                          </div>
                      </div>

                       <div class="col-xs-3">
                        <label>Status</label>
                        <select class="form-control" data-style="btn-success" name='status'>
                          <option value="READY" <?= $object->status == "READY" ? "selected" : ""?>>READY</option>
                          <option value="NOT READY" <?= $object->status == "NOT READY" ? "selected" : ""?>>NOT READY</option>
                        </select>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-12">
                        <label>Add by</label>
                        <select class="form-control" data-style="btn-success" name='add_by'>
                            <?php
                                foreach ($users as $key => $value) {
                                    $arr = (array) $value;
                                    $id = $arr['id'];
                                    $name = $arr['name'];
                                    if ($object->add_by == $id)
                                      echo "<option value='$id' selected>$id - $name</option>";
                                    else
                                      echo "<option value='$id'>$id - $name</option>";
                                }
                                ?>
                        </select>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-12">
                        <label>Type</label>
                        <select class="form-control" data-style="btn-success" name='id_product_type'>
                            <?php
                                foreach ($product_types as $key => $value) {
                                    $arr = (array) $value;
                                    $id = $arr['id'];
                                    $type = $arr['name_type'];
                                    if ($object->id_product_type == $id)
                                      echo "<option value='$id' selected>$id - $type</option>";
                                    else
                                      echo "<option value='$id'>$id - $type</option>";
                                }
                                ?>
                        </select>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-12">
                        <label>Brand</label>
                        <select class="form-control" data-style="btn-success" name='id_brand'>
                            <?php
                                foreach ($brands as $key => $value) {
                                    $arr = (array) $value;
                                    $id = $arr['id'];
                                    $name = $arr['name_brand'];
                                    if ($object->id_brand == $id)
                                      echo "<option value='$id' selected>$id - $name</option>";
                                    else
                                      echo "<option value='$id'>$id - $name</option>";

                                }
                                ?>
                        </select>
                      </div>
                  </div>

                   <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Infor</label>
                              <textarea rows="5" cols="50" name="infor" type="textarea" class="form-control border-input" placeholder="Infor"><?=$object->infor?></textarea>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Desciption</label>
                              <textarea rows="5" cols="50" name="desc" type="textarea" class="form-control border-input" placeholder="Desc"><?=$object->desc?></textarea>
                          </div>
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
