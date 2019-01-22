<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class ProductType_Controller extends Base_Controller
{
    /**
    * action index: show all ProductTypes
    * method: GET
    */
    public function index()
    {

       //Check token
        $token = $this->have_token();

        $pages = isset($_GET['pages']) ? $_GET['pages'] : 0;

        $this->model->load('ProductType');

         $list_search_type = [
            "ID" => "id",
            "NAME TYPE" => "name_type",
            "NAME GROUP" => "name_group"
        ];

        $tag_search_type = "";

        $list = $this->model->ProductType->getTable($pages, $token);
        $num_rows = $this->model->ProductType->getNumRow();

        if (isset($_POST['search'])) {
            if (isset($_POST['search_type']) && isset($_POST['search_text'])) {
                $search_type = $_POST['search_type'];
                $tag_search_type = $search_type;
                $search_text = $_POST['search_text'];
                $list =  $this->model->ProductType->getTable($pages, $token, $search_type, $search_text);
                $num_rows = $this->model->ProductType->getNumRow($search_type, $search_text);
            } else {
                $list = $this->model->ProductType->getTable($pages, $token);
                $num_rows = $this->model->ProductType->getNumRow();
            }
        }

        $table_name = "ProductType Table ($num_rows)";

        $data = [
            'page_name' => 'ProductType',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => $table_name,
            'table_subtitle' => 'Here is a table ProductType',
            'list_search_type' => $list_search_type,
            'tag_search_type' => $tag_search_type,
            'list' => $list,
            'num_rows' => $num_rows,
        ];

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a ProductType
    * method: GET
    */
    public function edit()
    {
       //Check token
        $token = $this->have_token();

        $this->model->load('ProductType');
        $ProductType = $this->model->ProductType->findById($_GET['id']);

        $this->model->load('GroupProductType');
        $group_product_types = $this->model->GroupProductType->all();

        $data = [
            'page_name' => 'ProductType',
            'action_table' => 'product_type/edit',
            'action_name' => 'Edit ProductType',
            'token' => $token,
            'title' => 'edit',
            'object' => $ProductType,
            'group_product_types' => $group_product_types
        ];

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action edit: update ProductType database
    * method: POST
    */
    public function update()
    {
        //Check token
        $token = $this->have_token();

        $file_dir = URL_ASSETS_IMAGE . "/types/";

        $this->model->load('ProductType');
        $ProductTypes = $this->model->ProductType->findById($_GET['id']);
        $ProductTypes->name_type = $_POST['name_type'];
        $ProductTypes->image = $file_dir . $_POST['image'];
        $ProductTypes->id_group = $_POST['id_group'];
        $ProductTypes->update();

        go_back();

    }


    /**
    * action create: create a ProductType
    * method: GET
    */
    public function create()
    {
       //Check token
        $token = $this->have_token();

        $this->model->load('GroupProductType');
        $group_product_types = $this->model->GroupProductType->all();

        $data = [
            'page_name' => 'ProductType',
            'action_table' => 'product_type/create',
            'action_name' => 'Add ProductType',
            'token' => $token,
            'title' => 'create',
            'group_product_types' => $group_product_types
        ];

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a ProductType to database
    * method: POST
    */
    public function store()
    {
        //Check token
        $token = $this->have_token();

        $file_dir = URL_ASSETS_IMAGE . "/types/";

        $this->model->load('ProductType');
        $this->model->ProductType->name_type = $_POST['name_type'];
        $this->model->ProductType->image = $file_dir . $_POST['image'];
        $this->model->ProductType->id_group = $_POST['id_group'];
        $this->model->ProductType->save();

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

        $this->model->load('ProductType');
        $ProductType = $this->model->ProductType->findById($_GET['id']);
        $ProductType->delete();

        go_back();
    }

    public function upload() {
        //Check token
        $token = $this->have_token();

        if (isset($_FILES['image'])) {
            $file_dir = image_ASSETS . '/image/types/';
            $file_name = $_FILES['image']["name"];
            $file_tmp  = $_FILES['image']["tmp_name"];
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
