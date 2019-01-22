<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Image_Controller extends Base_Controller
{
  public function index() {
        //Check token
        $token = $this->have_token();

        $this->model->load('ImageUser');
        $num_row_image_user = $this->model->ImageUser->getNumRow();

        $this->model->load('ImageProduct');
        $num_row_image_product = $this->model->ImageProduct->getNumRow();

        $this->model->load('ImageBrand');
        $num_row_image_brand = $this->model->ImageBrand->getNumRow();

        $data = [
            'page_name' => 'Image',
            'action_table' => 'null',
            'token' => $token,
            'title' => 'index',
            'num_row_image_user' => $num_row_image_user,
            'num_row_image_product' => $num_row_image_product,
            'num_row_image_brand' => $num_row_image_brand,
        ];

        // Load view
        $this->view->load('index', $data);
  }
}
