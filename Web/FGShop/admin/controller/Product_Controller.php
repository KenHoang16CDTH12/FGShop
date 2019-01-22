<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Product_Controller extends Base_Controller
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
        $this->model->load('Product');

        $list_search_type = [
            "ID" => "id",
            "NAME PRODUCT" => "name_product",
            "PRODUCT TYPE" => "name_type",
            "BRAND TYPE" => "name_brand"
        ];

        $tag_search_type = "";

        $list_product = $this->model->Product->getTable($pages, $token);
        $num_rows = $this->model->Product->getNumRow();

        if (isset($_POST['search'])) {
            if (isset($_POST['search_type']) && isset($_POST['search_text'])) {
                $search_type = $_POST['search_type'];
                $tag_search_type = $search_type;
                $search_text = $_POST['search_text'];
                $list_product =  $this->model->Product->getTable($pages, $token, $search_type, $search_text);
                $num_rows = $this->model->Product->getNumRow($search_type, $search_text);
            } else {
                $list_product = $this->model->Product->getTable($pages, $token);
                $num_rows = $this->model->Product->getNumRow();
            }
        }

        $table_name = "Product Table ($num_rows)";

        $data = [
            'page_name' => 'Product',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => $table_name,
            'table_subtitle' => 'Here is a table product',
            'list_search_type' => $list_search_type,
            'tag_search_type' => $tag_search_type,
            'list' => $list_product,
            'num_rows' => $num_rows,
        ];

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a product
    * method: GET
    */
    public function edit()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Product');
        $product = $this->model->Product->findById($_GET['id']);

        $this->model->load('Users');
        $users = $this->model->Users->all();

        $this->model->load('ProductType');
        $product_types = $this->model->ProductType->all();

        $this->model->load('Brand');
        $brands = $this->model->Brand->all();

        $data = [
            'page_name' => 'Product',
            'action_table' => 'product/edit',
            'action_name' => 'Edit Product',
            'token' => $token,
            'title' => 'edit',
            'object' => $product,
            'users' => $users,
            'product_types' => $product_types,
            'brands' => $brands,
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

        $this->model->load('Product');
        $product = $this->model->Product->findById($_GET['id']);
        $product->name_product = $_POST['name_product'];
        $product->price = $_POST['price'];
        $product->isbn = $_POST['isbn'];
        $product->infor = $_POST['infor'];
        $product->desc = $_POST['desc'];
        $product->status = $_POST['status'];
        $product->quanity = $_POST['quanity'];
        $product->add_by = $_POST['add_by'];
        $product->id_product_type = $_POST['id_product_type'];
        $product->id_brand = $_POST['id_brand'];
        $product->update();

        go_back();

    }


    /**
    * action create: create a product
    * method: GET
    */
    public function create()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Users');
        $users = $this->model->Users->all();

        $this->model->load('ProductType');
        $product_types = $this->model->ProductType->all();

        $this->model->load('Brand');
        $brands = $this->model->Brand->all();


        $data = [
            'page_name' => 'Product',
            'action_table' => 'product/create',
            'action_name' => 'Add Product',
            'token' => $token,
            'title' => 'create',
            'users' => $users,
            'product_types' => $product_types,
            'brands' => $brands,
        ];

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a product to database
    * method: POST
    */
    public function store()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Product');
        $this->model->Product->name_product = $_POST['name_product'];
        $this->model->Product->price = $_POST['price'];
        $this->model->Product->isbn = $_POST['isbn'];
        $this->model->Product->infor = $_POST['infor'];
        $this->model->Product->desc = $_POST['desc'];
        $this->model->Product->status = $_POST['status'];
        $this->model->Product->quanity = $_POST['quanity'];
        $this->model->Product->add_by = $_POST['add_by'];
        $this->model->Product->id_product_type = $_POST['id_product_type'];
        $this->model->Product->id_brand = $_POST['id_brand'];
        $this->model->Product->save();

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

        $this->model->load('Product');
        $product = $this->model->Product->findById($_GET['id']);
        $product->delete();

        go_back();
    }

}
