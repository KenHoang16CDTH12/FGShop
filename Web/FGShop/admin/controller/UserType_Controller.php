<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class UserType_Controller extends Base_Controller
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
        $this->model->load('UserType');
        $list_user_type = $this->model->UserType->getTable($pages, $token);
        $num_rows = $this->model->UserType->getNumRow();

        $table_name = "UserType Table ($num_rows)";

        $data = [
            'page_name' => 'UserType',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => $table_name,
            'table_subtitle' => 'Here is a table user_type',
            'list' => $list_user_type,
            'num_rows' => $num_rows,
        ];

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a user_type
    * method: GET
    */
    public function edit()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('UserType');
        $user_type = $this->model->UserType->findById($_GET['id']);

        $data = [
            'page_name' => 'UserType',
            'action_table' => 'user_type/edit',
            'action_name' => 'Edit UserType',
            'token' => $token,
            'title' => 'edit',
            'object' => $user_type,
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

        $this->model->load('UserType');
        $users = $this->model->UserType->findById($_GET['id']);
        $users->name_user_type = $_POST['name_user_type'];
        $users->update();

        go_back();

    }


    /**
    * action create: create a user_type
    * method: GET
    */
    public function create()
    {
        //Check token
        $token = $this->have_token();

        $data = [
            'page_name' => 'UserType',
            'action_table' => 'user_type/create',
            'action_name' => 'Add UserType',
            'token' => $token,
            'title' => 'create',
        ];

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a user_type to database
    * method: POST
    */
    public function store()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('UserType');
        $this->model->UserType->name_user_type = $_POST['name_user_type'];
        $this->model->UserType->save();

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

        $this->model->load('UserType');
        $user = $this->model->UserType->findById($_GET['id']);
        $user->delete();

        go_back();
    }

}
