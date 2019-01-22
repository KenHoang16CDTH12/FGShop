<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class ImageBrand_Controller extends Base_Controller
{
    /**
    * action index: show all ImageBrand
    * method: GET
    */
    public function index()
    {
         //Check token
        $token = $this->have_token();
        $pages = isset($_GET['pages']) ? $_GET['pages'] : 0;
        $this->model->load('ImageBrand');

         $list_search_type = [
            "ID BRAND" => "id_brand",
            "NAME BRAND" => "name_brand",
            "TYPE" => "type"
        ];

        $tag_search_type = "";

        $list = $this->model->ImageBrand->getTable($pages, $token);
        $num_rows = $this->model->ImageBrand->getNumRow();

        if (isset($_POST['search'])) {
            if (isset($_POST['search_type']) && isset($_POST['search_text'])) {
                $search_type = $_POST['search_type'];
                $tag_search_type = $search_type;
                $search_text = $_POST['search_text'];
                $list =  $this->model->ImageBrand->getTable($pages, $token, $search_type, $search_text);
                $num_rows = $this->model->ImageBrand->getNumRow($search_type, $search_text);
            } else {
                $list = $this->model->ImageBrand->getTable($pages, $token);
                $num_rows = $this->model->ImageBrand->getNumRow();
            }
        }

        $table_name = "ImageBrand Table ($num_rows)";

        $data = [
            'page_name' => 'ImageBrand',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => $table_name,
            'table_subtitle' => 'Here is a table ImageBrand',
            'list_search_type' => $list_search_type,
            'tag_search_type' => $tag_search_type,
            'list' => $list,
            'num_rows' => $num_rows,
        ];

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a ImageBrand
    * method: GET
    */
    public function edit()
    {
         //Check token
        $token = $this->have_token();

        $this->model->load('ImageBrand');
        $ImageBrand = $this->model->ImageBrand->findById($_GET['id']);

        $this->model->load('Brand');
        $brands = $this->model->Brand->all();

        $data = [
            'page_name' => 'ImageBrand',
            'action_table' => 'image/brand/edit',
            'action_name' => 'Edit ImageBrand',
            'token' => $token,
            'title' => 'edit',
            'object' => $ImageBrand,
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

        $file_dir = URL_ASSETS_IMAGE . "/brands/";
        $this->model->load('ImageBrand');
        $ImageBrand = $this->model->ImageBrand->findById($_GET['id']);
        $ImageBrand->id_brand = $_POST['id_brand'];
        $ImageBrand->path = $file_dir . $_POST['path'];
        $ImageBrand->type = $_POST['type'];
        $ImageBrand->update();

        go_back();

    }


    /**
    * action create: create a ImageBrand
    * method: GET
    */
    public function create()
    {
         //Check token
        $token = $this->have_token();

        $this->model->load('Brand');
        $brands = $this->model->Brand->all();

        $data = [
            'page_name' => 'ImageBrand',
            'action_table' => 'image/brand/create',
            'action_name' => 'Add ImageBrand',
            'token' => $token,
            'title' => 'create',
            'brands' => $brands
        ];

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a ImageBrand to database
    * method: POST
    */
    public function store()
    {
         //Check token
        $token = $this->have_token();

        $file_dir = URL_ASSETS_IMAGE . "/brands/";

        $this->model->load('ImageBrand');
        $this->model->ImageBrand->id_brand = $_POST['id_brand'];
        $this->model->ImageBrand->path = $file_dir . $_POST['path'];
        $this->model->ImageBrand->type = $_POST['type'];
        $this->model->ImageBrand->save();

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

        $this->model->load('ImageBrand');
        $user = $this->model->ImageBrand->findById($_GET['id']);
        $user->delete();

        go_back();
    }


     public function upload() {
         //Check token
        $token = $this->have_token();

        if (isset($_FILES['path'])) {
            $file_dir = PATH_ASSETS . '/image/brands/';
            $file_name = $_FILES['path']["name"];
            $file_tmp  = $_FILES['path']["tmp_name"];
            $file_dir = $file_dir . $file_name;
            if (move_uploaded_file($file_tmp, $file_dir)) {
                chmod($file_dir, 0755);
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
