<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');


class Banner_Controller extends Base_Controller
{
    /**
    * action index: show all Banner
    * method: GET
    */
    public function index()
    {
        //Check token
        $token = $this->have_token();

        $pages = isset($_GET['pages']) ? $_GET['pages'] : 0;
        $this->model->load('Banner');

         $list_search_type = [
            "ID" => "id",
            "ID PRODUCT" => "id_product",
            "NAME PRODUCT" => "name_product",
        ];

        $tag_search_type = "";

        $banners = $this->model->Banner->getTable($pages, $token);
        $num_rows = $this->model->Banner->getNumRow();

        if (isset($_POST['search'])) {
            if (isset($_POST['search_type']) && isset($_POST['search_text'])) {
                $search_type = $_POST['search_type'];
                $tag_search_type = $search_type;
                $search_text = $_POST['search_text'];
                $banners =  $this->model->Banner->getTable($pages, $token, $search_type, $search_text);
                $num_rows = $this->model->Banner->getNumRow($search_type, $search_text);
            } else {
                $banners = $this->model->Banner->getTable($pages, $token);
                $num_rows = $this->model->Banner->getNumRow();
            }
        }

        $table_name = "Banner Table ($num_rows)";

        $data = [
            'page_name' => 'Banner',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => $table_name,
            'table_subtitle' => 'Here is a table Banner',
            'list_search_type' => $list_search_type,
            'tag_search_type' => $tag_search_type,
            'list' => $banners,
            'num_rows' => $num_rows,
        ];
        // Load view
        $this->view->load('index', $data);
    }
    /**
    * action edit: show form edit a Banner
    * method: GET
    */
    public function edit()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Banner');

        $this->model->load('Product');
        $products = $this->model->Product->all();

        $banner = $this->model->Banner->findById($_GET['id']);
        $data = [
            'page_name' => 'Banner',
            'action_table' => 'banner/edit',
            'action_name' => 'Edit Banner',
            'token' => $token,
            'title' => 'edit',
            'object' => $banner,
            'products' => $products
        ];
        // Load view
        $this->view->load('index', $data);
    }
     /**
    * action edit: update Bannerdatabase
    * method: POST
    */
    public function update()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Banner');
        $banner = $this->model->Banner->findById($_GET['id']);
        $banner->id_product = $_POST['id_product'];
        $banner->update();
        go_back();
    }
    /**
    * action create: create a Banner
    * method: GET
    */
    public function create()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Product');
        $products = $this->model->Product->all();

        $data = [
            'page_name' => 'Banner',
            'action_table' => 'banner/create',
            'action_name' => 'Add Banner',
            'token' => $token,
            'title' => 'create',
            'products' => $products,
        ];
        // Load view
        $this->view->load('index', $data);
    }
     /**
    * action store: save a Banner to database
    * method: POST
    */
    public function store()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Banner');
        $this->model->Banner->id_product = $_POST['id_product'];
        $this->model->Banner->save();
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

        $this->model->load('Banner');
        $banner= $this->model->Banner->findById($_GET['id']);
        $banner->delete();
        go_back();
    }
}
