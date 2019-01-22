<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class ImageProduct_Controller extends Base_Controller
{
    /**
    * action index: show all users
    * method: GET
    */
    public function index()
    {
         //Check token
        $token = $this->have_token();
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 0;
        $this->model->load('ImageProduct');

        $list_search_type = [
            "ID PRODUCT" => "id_product",
            "NAME PRODUCT" => "name_product",
            "TYPE" => "type"
        ];

        $tag_search_type = "";

        $list = $this->model->ImageProduct->getTable($pages, $token);
        $num_rows = $this->model->ImageProduct->getNumRow();

        if (isset($_POST['search'])) {
            if (isset($_POST['search_type']) && isset($_POST['search_text'])) {
                $search_type = $_POST['search_type'];
                $tag_search_type = $search_type;
                $search_text = $_POST['search_text'];
                $list =  $this->model->ImageProduct->getTable($pages, $token, $search_type, $search_text);
                $num_rows = $this->model->ImageProduct->getNumRow($search_type, $search_text);
            } else {
                $list = $this->model->ImageProduct->getTable($pages, $token);
                $num_rows = $this->model->ImageProduct->getNumRow();
            }
        }

        $table_name = "ImageProduct Table ($num_rows)";

        $data = [
            'page_name' => 'ImageProduct',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => $table_name,
            'table_subtitle' => 'Here is a table ImageProduct',
            'list_search_type' => $list_search_type,
            'tag_search_type' => $tag_search_type,
            'list' => $list,
            'num_rows' => $num_rows,
        ];

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a ImageProduct
    * method: GET
    */
    public function edit()
    {
         //Check token
        $token = $this->have_token();

        $this->model->load('ImageProduct');
        $ImageProduct = $this->model->ImageProduct->findById($_GET['id']);

        $this->model->load('Product');
        $products = $this->model->Product->all();

        $data = [
            'page_name' => 'ImageProduct',
            'action_table' => 'image/product/edit',
            'action_name' => 'Edit ImageProduct',
            'token' => $token,
            'title' => 'edit',
            'object' => $ImageProduct,
            'products' => $products
        ];

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action edit: update user database
    * method: POST
    */
    public function update()
    {
         //Check token
        $token = $this->have_token();

        $file_dir = URL_ASSETS_IMAGE . "/products/";
        $this->model->load('ImageProduct');
        $ImageProduct = $this->model->ImageProduct->findById($_GET['id']);
        $ImageProduct->id_product = $_POST['id_product'];
        $ImageProduct->path = $file_dir . $_POST['path'];
        $ImageProduct->type = $_POST['type'];
        $ImageProduct->update();

       go_back();

    }


    /**
    * action create: create a ImageProduct
    * method: GET
    */
    public function create()
    {
         //Check token
        $token = $this->have_token();

        $this->model->load('Product');
        $products = $this->model->Product->all();

        $data = [
            'page_name' => 'ImageProduct',
            'action_table' => 'image/product/create',
            'action_name' => 'Add ImageProduct',
            'token' => $token,
            'title' => 'create',
            'products' => $products,
        ];

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a ImageProduct to database
    * method: POST
    */
    public function store()
    {
             //Check token
            $token = $this->have_token();

            $file_dir = URL_ASSETS_IMAGE . "/products/";
            $this->model->load('ImageProduct');
            $this->model->ImageProduct->id_product = $_POST['id_product'];
            $this->model->ImageProduct->path = $file_dir . $_POST['path'];
            $this->model->ImageProduct->type = $_POST['type'];
            $this->model->ImageProduct->save();
            go_back();
    }


    /**
    * action delete: delete
    * method: GET
    */
    public function delete()
    {
         //Check token
        $token = $this->have_token();

        $this->model->load('ImageProduct');
        $user = $this->model->ImageProduct->findById($_GET['id']);
        $user->delete();

        go_back();
    }

    public function upload() {
         //Check token
        $token = $this->have_token();

        if (isset($_FILES['path'])) {
            $file_dir = PATH_ASSETS . '/image/products/';
            $file_name = $_FILES['path']["name"];
            $file_tmp  = $_FILES['path']["tmp_name"];
            $file_dir = $file_dir . $file_name;
           if (move_uploaded_file($file_tmp, $file_dir)) {
                $output = [
                    "Upload success!"
                ];
            } else {
                $output = [
                    "Upload failed!"
                ];
            }
            echo json_encode($output);
        }
    }

}
