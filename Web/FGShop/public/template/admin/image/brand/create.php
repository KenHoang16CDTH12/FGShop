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

                       <div class="col-xs-8">
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

                      <div class="col-xs-3">
                        <label>Type</label>
                        <select class="form-control" data-style="btn-success" name="type">
                            <option value="PRIMARY">PRIMARY</option>
                            <option value="BANNER">BANNER</option>
                            <option value="DETAIL">DETAIL</option>
                            <option value="LOGO">LOGO</option>
                        </select>
                      </div>

                  </div>

                  <!-- Test Image File -->
                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Image</label>
                              <input name="path" id="path" type="file" class="file" data-preview-file-type="any" data-upload-url="admin.php?controller=ImageBrand&action=upload&token=<?=$token?>">
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
