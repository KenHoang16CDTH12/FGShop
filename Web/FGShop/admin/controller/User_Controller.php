<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class User_Controller extends Base_Controller
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
        $this->model->load('Users');

         $list_search_type = [
            "ID" => "id",
            "NAME" => "name",
            "USERNAME" => "username",
            "GENDER" => "gender",
            "USER TYPE" => "name_user_type"];

        $tag_search_type = "";

        $list_user = $this->model->Users->getTable($pages, $token);
        $num_rows = $this->model->Users->getNumRow();

        if (isset($_POST['search'])) {
            if (isset($_POST['search_type']) && isset($_POST['search_text'])) {
                $search_type = $_POST['search_type'];
                $tag_search_type = $search_type;
                $search_text = $_POST['search_text'];
                $list_user =  $this->model->Users->getTable($pages, $token, $search_type, $search_text);
                $num_rows = $this->model->Users->getNumRow($search_type, $search_text);
            } else {
                $list_user = $this->model->Users->getTable($pages, $token);
                $num_rows = $this->model->Users->getNumRow();
            }
        }

        $table_name = "Users Table ($num_rows)";

        $data = [
            'page_name' => 'User',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => $table_name,
            'table_subtitle' => 'Here is a table users',
            'list_search_type' => $list_search_type,
            'tag_search_type' => $tag_search_type,
            'list' => $list_user,
            'num_rows' => $num_rows,
        ];

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a user
    * method: GET
    */
    public function edit()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Users');
        $users = $this->model->Users->findById($_GET['id']);

        $this->model->load('UserType');
        $user_types = $this->model->UserType->all();

        $data = [
            'page_name' => 'User',
            'action_table' => 'user/edit',
            'action_name' => 'Edit User',
            'token' => $token,
            'title' => 'edit',
            'object' => $users,
            'user_types' => $user_types,
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

        $this->model->load('Users');
        //echo isset($_POST['username']) ? $_POST['username'] : 'null';
        $users = $this->model->Users->findById($_GET['id']);
        $users->name = $_POST['name'];
        $users->username = $_POST['username'];
        $users->password = $_POST['password'];
        $users->birthdate = $_POST['birthdate'];
        $users->phone = $_POST['phone'];
        $users->gender = $_POST['gender'];
        $users->identify_number = $_POST['identify_number'];
        $users->wallet = $_POST['wallet'];
        $users->is_social = $_POST['is_social'];
        $users->status = $_POST['status'];
        $users->id_user_type = $_POST['id_user_type'];
        $users->update();

        go_back();

    }


    /**
    * action create: create a user
    * method: GET
    */
    public function create()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('UserType');
        $user_types = $this->model->UserType->all();

        $data = [
            'page_name' => 'User',
            'action_table' => 'user/create',
            'action_name' => 'Add User',
            'token' => $token,
            'title' => 'create',
            'user_types' => $user_types,
        ];

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a user to database
    * method: POST
    */
    public function store()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Users');
        $this->model->Users->name = $_POST['name'];
        $this->model->Users->username = $_POST['username'];
        $this->model->Users->password = $_POST['password'];
        $this->model->Users->birthdate = $_POST['birthdate'];
        $this->model->Users->phone = $_POST['phone'];
        $this->model->Users->gender = $_POST['gender'];
        $this->model->Users->identify_number = $_POST['identify_number'];
        $this->model->Users->wallet = $_POST['wallet'];
        $this->model->Users->is_social = $_POST['is_social'];
        $this->model->Users->status = $_POST['status'];
        $this->model->Users->id_user_type = $_POST['id_user_type'];
        if ($this->model->Users->save() != null)
            go_back();
        else redirect_to(URL . 'controller=utils&action=error&message=User%20exists!');
    }


    /**
    * action delete: delete
    * method: GET
    */
    public function delete()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Users');
        $user = $this->model->Users->findById($_GET['id']);
        $user->delete();

        go_back();
    }

    public function login() {
        $error = "";
        if(isset($_GET['status'])) {
            if ($_GET['status'] == 401) {
                $error = "Invalid login.";
            }
            else if ($_GET['status'] == 403) {
                $error = "Token not exists.";
            }
            else if ($_GET['status'] == 404) {
                $error = "Permission denied.";
            }
            else if ($_GET['status'] == 405) {
                $error = "Timeout! Please login again.";
            }
            else {
                $error = "";
            }
        }
        $data = [
            "error" =>  $error
        ];
        $this->view->load('login', $data);
    }

    /**
    * action login: validate login
    * method: POST
    */
    public function validate_login() {
        if (isset($_POST['log_button'])) {
            $username = $_POST['log_username'];
            $password = $_POST['log_pass'];
            $this->model->load('Users');
            $id = $this->model->Users->validate_login($username, $password);
            if ($id != 0) {

                $user = $this->model->Users->findById($id);
                $id_user_type = $user->id_user_type;

                $this->model->load('UserType');
                $user_type = $this->model->UserType->findById($id_user_type);


                $role = $user_type->name_user_type;
                $this->middleware->load('Admin');
                $admin_midlleware = $this->middleware->Admin->handle($role);

                if ($admin_midlleware) {
                    //Login success
                    $token = $this->model->Users->generate_token($id);
                    setcookie("token", $token, time() + 60 * 30,'/');
                    redirect_to(URL . "controller=dashboard&action=index&token=$token");
                } else {
                    redirect_to(URL . 'controller=user&action=login&status=404');
                }

            } else {
                redirect_to(URL . 'controller=user&action=login&status=401');
            }
        }
    }

    /**
    * action logout
    * method: GET
    */

    public function logout() {
        //Check token
        $token = $this->have_token();
        $this->model->load('Users');
        $id = $this->model->Users->validate_logout($_GET['token']);
        if($id != 0) {
            $this->model->Users->remove_token($id);
            //setcookie("token", "", time() + 25292000 ,'/');
            redirect_to(URL . "controller=user&action=login");
        }
    }

}
