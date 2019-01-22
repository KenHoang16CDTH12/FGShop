<div class="col-md-12">
  <form action="admin.php?controller=<?=$page_name?>&action=update&id=<?=$object->id?>&token=<?=$token?>" method="post">
    <div class="card">
        <div class="header">
            <h4 class="title">
                <?=$action_name?>
            </h4>
            <div class="styled-select green rounded" id="status_order">
              <select name='status'>
                  <option value="PLACED" <?php echo $object->status == 'PLACED'? 'selected' : ''?>>PLACED</option>
                  <option value="ON MY WAY" <?php echo $object->status == 'ON MY WAY'? 'selected' : ''?>>ON MY WAY</option>
                  <option value="SHIPPED" <?php echo $object->status == 'SHIPPED'? 'selected' : ''?>>SHIPPED</option>
              </select>
            </div>
        </div>
        <div class="content">

                  <div class="row">
                      <div class="col-md-1">
                          <div class="form-group">
                              <label>#ID</label>
                              <input name="id" type="text" class="form-control border-input" disabled placeholder="ID" value="<?=$object->id?>">
                          </div>
                      </div>
                      <div class="col-xs-11">
                        <label>Order by</label>
                          <select class="form-control" name='id_user'>
                              <?php
                                foreach ($users as $key => $value) {
                                      $arr = (array) $value;
                                      $id = $arr['id'];
                                      $username = $arr['username'];
                                      if ($object->id_user == $id)
                                        echo "<option value='$id' selected>$id - $username</option>";
                                      else
                                        echo "<option value='$id'>$id - $username</option>";
                                  }
                                  ?>
                          </select>
                      </div>
                  </div>

                   <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                              <label>Phone</label>
                              <input name="phone" type="text" class="form-control border-input" placeholder="Phone" value="<?=$object->phone?>">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Delivery Date</label>
                              <input name="delivery_date" type="text" class="form-control border-input" placeholder="Delivery Date" value="<?=$object->delivery_date?>">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label>Order Date</label>
                              <input name="order_date" type="text" class="form-control border-input" placeholder="Order Date" value="<?=$object->order_date?>">
                          </div>
                      </div>
                    </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                          <label>Delivery Address</label>
                          <textarea rows="2" cols="50" name="delivery_address" type="textarea" class="form-control border-input" placeholder="Desc"><?=$object->delivery_address?></textarea>
                      </div>
                    </div>
                  </div>
                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label>Desciption</label>
                              <textarea rows="5" name="desc" type="textarea" class="form-control border-input" placeholder="Desc"><?=$object->desc?></textarea>
                          </div>
                      </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-info btn-fill btn-wd" onclick="update()">Update <?=$page_name?></button>
                    </div>

                <div class="clearfix"></div>
          </div>
      </div>
    </form>

    <?php
                        if ($action_table_details != null && $page_name != "Dashboard")
                            require_once(PATH_PUBLIC . '/template/admin/' . $action_table_details . '.php');
      ?>
</div>
