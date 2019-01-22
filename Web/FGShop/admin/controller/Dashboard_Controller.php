<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Dashboard_Controller extends Base_Controller
{
  public function index() {
        //Check token
        $token = $this->have_token();

        $this->model->load('UserType');
        $num_row_usertype = $this->model->UserType->getNumRow();

        $this->model->load('Users');
        $num_row_user = $this->model->Users->getNumRow();

        $this->model->load('ImageUser');
        $num_row_image_user = $this->model->ImageUser->getNumRow();


        $this->model->load('ImageProduct');
        $num_row_image_product = $this->model->ImageProduct->getNumRow();

        $this->model->load('ImageBrand');
        $num_row_image_brand = $this->model->ImageBrand->getNumRow();

        $this->model->load('Brand');
        $num_row_brand = $this->model->Brand->getNumRow();

        $this->model->load('GroupProductType');
        $num_row_grouptype = $this->model->GroupProductType->getNumRow();

        $this->model->load('ProductType');
        $num_row_type = $this->model->ProductType->getNumRow();

        $this->model->load('Product');
        $num_row_product = $this->model->Product->getNumRow();

        $this->model->load('Order');
        $num_row_order = $this->model->Order->getNumRow();
        $data = [
            'page_name' => 'Dashboard',
            'action_table' => 'null',
            'token' => $token,
            'title' => 'index',
            'num_row_usertype' => $num_row_usertype,
            'num_row_user' => $num_row_user,
            'num_row_image' => $num_row_image_user + $num_row_image_product + $num_row_image_brand,
            'num_row_brand' => $num_row_brand,
            'num_row_grouptype' => $num_row_grouptype,
            'num_row_type' => $num_row_type,
            'num_row_product' => $num_row_product,
            'num_row_order' => $num_row_order,
        ];

        // Load view
        $this->view->load('index', $data);
  }
}
