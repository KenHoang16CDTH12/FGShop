<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');


class Brand_Controller extends Base_Controller
{
    /**
    * action index: show all brand
    * method: GET
    */
    public function index()
    {
        //Check token
        $token = $this->have_token();
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 0;
        $this->model->load('Brand');

        $list_search_type = [
            "ID" => "id",
            "NAME BRAND" => "name_brand"
        ];

        $tag_search_type = "";

        $list_brand = $this->model->Brand->getTable($pages, $token);
        $num_rows = $this->model->Brand->getNumRow();

          if (isset($_POST['search'])) {
            if (isset($_POST['search_type']) && isset($_POST['search_text'])) {
                $search_type = $_POST['search_type'];
                $tag_search_type = $search_type;
                $search_text = $_POST['search_text'];
                $list_brand =  $this->model->Brand->getTable($pages, $token, $search_type, $search_text);
                $num_rows = $this->model->Brand->getNumRow($search_type, $search_text);
            } else {
                $list_brand = $this->model->Brand->getTable($pages, $token);
                $num_rows = $this->model->Brand->getNumRow();
            }
        }

        $table_name = "Brand Table ($num_rows)";

        $data = [
            'page_name' => 'Brand',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => $table_name,
            'table_subtitle' => 'Here is a table brand',
            'list_search_type' => $list_search_type,
            'tag_search_type' => $tag_search_type,
            'list' => $list_brand,
            'num_rows' => $num_rows,
        ];
        // Load view
        $this->view->load('index', $data);
    }
    /**
    * action edit: show form edit a brand
    * method: GET
    */
    public function edit()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Brand');
        $brand = $this->model->Brand->findById($_GET['id']);
        $data = [
            'page_name' => 'Brand',
            'action_table' => 'brand/edit',
            'action_name' => 'Edit Brand',
            'token' => $token,
            'title' => 'edit',
            'object' => $brand,
        ];
        // Load view
        $this->view->load('index', $data);
    }
     /**
    * action edit: update branddatabase
    * method: POST
    */
    public function update()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Brand');
        $brand = $this->model->Brand->findById($_GET['id']);
        $brand->name_brand = $_POST['name_brand'];
        $brand->update();
        go_back();
    }
    /**
    * action create: create a brand
    * method: GET
    */
    public function create()
    {
        //Check token
        $token = $this->have_token();

        $data = [
            'page_name' => 'Brand',
            'action_table' => 'brand/create',
            'action_name' => 'Add Brand',
            'token' => $token,
            'title' => 'create',
        ];
        // Load view
        $this->view->load('index', $data);
    }
     /**
    * action store: save a brand to database
    * method: POST
    */
    public function store()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Brand');
        $this->model->Brand->name_brand = $_POST['name_brand'];
        $this->model->Brand->save();
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

        $this->model->load('Brand');
        $brand= $this->model->Brand->findById($_GET['id']);
        $brand->delete();
        go_back();
    }
}
