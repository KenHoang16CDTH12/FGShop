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

                      <div class="col-md-11">
                          <div class="form-group">
                              <label>Name Product</label>
                              <input name="name_product" type="text" class="form-control border-input" placeholder="Name Product" value="">
                          </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                              <label>Price</label>
                              <input name="price" type="number" class="form-control border-input" placeholder="Price" value="" min="0">
                          </div>
                      </div>

                      <div class="col-md-3">
                          <div class="form-group">
                              <label>Quantity</label>
                              <input name="quanity" type="number" class="form-control border-input" placeholder="Quantity" value="" min="0">
                          </div>
                      </div>

                      <div class="col-md-3">
                          <div class="form-group">
                              <label>ISBN</label>
                              <input name="isbn" type="text" class="form-control border-input" placeholder="ISBN" value="">
                          </div>
                      </div>

                       <div class="col-xs-3">
                        <label>Status</label>
                        <select class="form-control" data-style="btn-success" name='status'>
                          <option value="READY">READY</option>
                          <option value="NOT READY">NOT READY</option>
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
                              <textarea rows="5" name="infor" type="textarea" class="form-control border-input" placeholder="Infor"></textarea>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Desciption</label>
                              <textarea rows="5" name="desc" type="textarea" class="form-control border-input" placeholder="Desc"></textarea>
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
