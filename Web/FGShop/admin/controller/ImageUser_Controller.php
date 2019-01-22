<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class ImageUser_Controller extends Base_Controller
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
        $this->model->load('ImageUser');

         $list_search_type = [
            "ID USER" => "id_user",
            "USERNAME" => "username",
            "TYPE" => "type"
        ];

        $tag_search_type = "";
        $list = $this->model->ImageUser->getTable($pages, $token);
        $num_rows = $this->model->ImageUser->getNumRow();

        if (isset($_POST['search'])) {
            if (isset($_POST['search_type']) && isset($_POST['search_text'])) {
                $search_type = $_POST['search_type'];
                $tag_search_type = $search_type;
                $search_text = $_POST['search_text'];
                $list =  $this->model->ImageUser->getTable($pages, $token, $search_type, $search_text);
                $num_rows = $this->model->ImageUser->getNumRow($search_type, $search_text);
            } else {
                $list = $this->model->ImageUser->getTable($pages, $token);
                $num_rows = $this->model->ImageUser->getNumRow();
            }
        }

        $table_name = "ImageUser Table ($num_rows)";

        $data = [
            'page_name' => 'ImageUser',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => $table_name,
            'table_subtitle' => 'Here is a table ImageUser',
            'list_search_type' => $list_search_type,
            'tag_search_type' => $tag_search_type,
            'list' => $list,
            'num_rows' => $num_rows,
        ];

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a ImageUser
    * method: GET
    */
    public function edit()
    {
         //Check token
        $token = $this->have_token();

        $this->model->load('ImageUser');
        $ImageUser = $this->model->ImageUser->findById($_GET['id']);

        $this->model->load('Users');
        $users = $this->model->Users->all();

        $data = [
            'page_name' => 'ImageUser',
            'action_table' => 'image/user/edit',
            'action_name' => 'Edit ImageUser',
            'token' => $token,
            'title' => 'edit',
            'object' => $ImageUser,
            'users' => $users
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

        $file_dir = URL_ASSETS_IMAGE . "/users/";
        $this->model->load('ImageUser');
        $image_user = $this->model->ImageUser->findById($_GET['id']);
        $image_user->id_user = $_POST['id_user'];
        $image_user->path = $file_dir . $_POST['path'];
        $image_user->type = $_POST['type'];
        $image_user->update();

       go_back();

    }


    /**
    * action create: create a ImageUser
    * method: GET
    */
    public function create()
    {
         //Check token
        $token = $this->have_token();

        $this->model->load('Users');
        $users = $this->model->Users->all();

        $data = [
            'page_name' => 'ImageUser',
            'action_table' => 'image/user/create',
            'action_name' => 'Add ImageUser',
            'token' => $token,
            'title' => 'create',
            'users' => $users,
        ];

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a ImageUser to database
    * method: POST
    */
    public function store()
    {
             //Check token
            $token = $this->have_token();

            $file_dir = URL_ASSETS_IMAGE . "/users/";
            $this->model->load('ImageUser');
            $this->model->ImageUser->id_user = $_POST['id_user'];
            $this->model->ImageUser->path = $file_dir . $_POST['path'];
            $this->model->ImageUser->type = $_POST['type'];
            $this->model->ImageUser->save();
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

        $this->model->load('ImageUser');
        $image_user = $this->model->ImageUser->findById($_GET['id']);
        $image_user->delete();

        go_back();
    }

    public function upload() {
        //Check token
        $token = $this->have_token();

        if (isset($_FILES['path'])) {
            $file_dir = PATH_ASSETS . '/image/users/';
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
