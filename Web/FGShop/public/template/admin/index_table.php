<div class="col-md-12">
  <div class="card">
    <div class="header" id="header">
         <!-- Seach bar -->
      <h4 class="title">
        <?=$table_name?>
      </h4>
      <p class="category">
        <?=$table_subtitle?>
      </p>
      <?php if ($action_table == 'index_table' && $page_name != 'UserType' && $page_name != 'Report') { ?>
      <form action="admin.php?controller=<?=$page_name?>&action=index&pages=0&token=<?=$token?>" method="post">
        <div class="wrap">
          <!-- Search -->
          <select class="searchSelector" id="select-search" data-style="btn-success" name='search_type'>
               <?php
                          if (isset($list_search_type)) {
                            foreach ($list_search_type as $key=>$value) {
                              if ($tag_search_type == $value) {
                                  echo "<option value='$value' selected>$key</option>";
                              } else {
                                  echo "<option value='$value'>$key</option>";
                              }
                            }
                          }
                ?>
          </select>
         <div class="search">
            <input type="text" class="searchTerm" placeholder="What are you looking for?" name="search_text">
            <button type="submit" class="searchButton" name="search">
              <i class="fa fa-search"></i>
           </button>
         </div>
        </div>
      </form>
      <?php } ?>
      <?php
      if ($page_name != 'Order' && $page_name != 'Report') {
       ?>
      <a id="btn_add" href='admin.php?controller=<?=$page_name?>&action=create&token=<?php echo $token?>'>ADD</a>
      <?php
      }
       ?>
    </div>
    <div class="content table-responsive table-full-width">
      <?php
                                  if ($list != null) {
                                ?>
        <table class="table table-striped">
          <thead>
            <?php
                                        $arr = (array) $list[0];
                                        $keys = array_keys($arr);
                                        foreach($keys as $row) {
                                          echo "<th>$row</th>";
                                        }
                                      ?>
          </thead>
          <tbody>
            <?php foreach ($list as $row):
                                          array_map('htmlentities', $row);
                                          ?>
            <tr>
              <td><?php echo implode('</td><td>', $row); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php if ($table_name == 'Order Details Table') {?>
        <div class="text-center">
          <hr class="hr2" />
          <h5 id="total">Total: <?=$total?>$</h5>
        </div>
        <?php } ?>
        <?php
                                } else {
                                  ?>
                                  <div class="text-center">
                                    <img src="public/assets/img/null_img.png" alt="Data null">
                                    <h4 id='table_null'>Data is null</h4>
                                  </div>
                                  <?php } ?>

    </div>
    <?php if ($num_rows > 10) {
    ?>
    <div class="text-center">
      <div class="pagination">
        <?php
          $paginations = ceil($num_rows / 10);
          $laquo = $pages == 0 ? $pages : $pages - 10;
          $raquo = ($pages == (($paginations - 1) * 10)) ? $pages : $pages + 10;
          echo "<a href='admin.php?controller=$page_name&action=index&pages=$laquo&token=$token'>&laquo;</a>";
          for ($i=0; $i < $paginations; $i++) {
            $index = $i + 1;
            $pages_index = $i * 10;
            if ($i == ceil($pages / 10)) {
              echo isset($filter) ?  "<a href='admin.php?controller=$page_name&action=index&pages=$pages_index&token=$token&filter=$filter' class='active'>$index</a>" : "<a href='admin.php?controller=$page_name&action=index&pages=$pages_index&token=$token' class='active'>$index</a>";
            } else {
              echo isset($filter) ? "<a href='admin.php?controller=$page_name&action=index&pages=$pages_index&token=$token&filter=$filter'>$index</a>" : "<a href='admin.php?controller=$page_name&action=index&pages=$pages_index&token=$token'>$index</a>";
            }
          }
          echo "<a href='admin.php?controller=$page_name&action=index&pages=$raquo&token=$token'>&raquo;</a>";
          ?>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
