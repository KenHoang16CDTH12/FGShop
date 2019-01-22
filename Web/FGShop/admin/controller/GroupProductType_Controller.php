<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class GroupProductType_Controller extends Base_Controller
{
    /**
    * action index: show all GroupProductTypes
    * method: GET
    */
    public function index()
    {
        //Check token
        $token = $this->have_token();
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 0;
        $this->model->load('GroupProductType');

         $list_search_type = [
            "ID" => "id",
            "GROUP TYPE" => "name_group"
        ];

        $tag_search_type = "";

        $list_group_product_type = $this->model->GroupProductType->getTable($pages, $token);
        $num_rows = $this->model->GroupProductType->getNumRow();

          if (isset($_POST['search'])) {
            if (isset($_POST['search_type']) && isset($_POST['search_text'])) {
                $search_type = $_POST['search_type'];
                $tag_search_type = $search_type;
                $search_text = $_POST['search_text'];
                $list_group_product_type =  $this->model->GroupProductType->getTable($pages, $token, $search_type, $search_text);
                $num_rows = $this->model->GroupProductType->getNumRow($search_type, $search_text);
            } else {
                $list_group_product_type = $this->model->GroupProductType->getTable($pages, $token);
                $num_rows = $this->model->GroupProductType->getNumRow();
            }
        }

        $table_name = "GroupProductType Table ($num_rows)";

        $data = [
            'page_name' => 'GroupProductType',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => $table_name,
            'table_subtitle' => 'Here is a table GroupProductType',
            'list_search_type' => $list_search_type,
            'tag_search_type' => $tag_search_type,
            'list' => $list_group_product_type,
            'num_rows' => $num_rows,
        ];

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a GroupProductType
    * method: GET
    */
    public function edit()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('GroupProductType');
        $GroupProductType = $this->model->GroupProductType->findById($_GET['id']);

        $data = [
            'page_name' => 'GroupProductType',
            'action_table' => 'group_product_type/edit',
            'action_name' => 'Edit GroupProductType',
            'token' => $token,
            'title' => 'edit',
            'object' => $GroupProductType,
        ];

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action edit: update GroupProductType database
    * method: POST
    */
    public function update()
    {
        //Check token
        $token = $this->have_token();

        $file_dir = URL_ASSETS_IMAGE . "/types/";

        $this->model->load('GroupProductType');
        $GroupProductType = $this->model->GroupProductType->findById($_GET['id']);
        $GroupProductType->name_group = $_POST['name_group'];
        $GroupProductType->image = $file_dir . $_POST['image'];
        $GroupProductType->update();

        go_back();

    }


    /**
    * action create: create a GroupProductType
    * method: GET
    */
    public function create()
    {
        //Check token
        $token = $this->have_token();

        $data = [
            'page_name' => 'GroupProductType',
            'action_table' => 'group_product_type/create',
            'action_name' => 'Add GroupProductType',
            'token' => $token,
            'title' => 'create',
        ];

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a GroupProductType to database
    * method: POST
    */
    public function store()
    {
        //Check token
        $token = $this->have_token();

        $file_dir = URL_ASSETS_IMAGE . "/types/";
        $this->model->load('GroupProductType');
        $this->model->GroupProductType->name_group = $_POST['name_group'];
        $this->model->GroupProductType->image = $file_dir . $_POST['image'];
        $this->model->GroupProductType->save();

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

        $this->model->load('GroupProductType');
        $GroupProductType = $this->model->GroupProductType->findById($_GET['id']);
        $GroupProductType->delete();

        go_back();
    }


    public function upload() {
        //Check token
        $token = $this->have_token();

        if (isset($_FILES['image'])) {
            $file_dir = PATH_ASSETS . '/image/types/';
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
