<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class User_Controller extends Base_Controller
{
    public function exists() {
        $json = [];
        echo "{";
        echo "\"User\":";

        $this->model->load('Users');
        $rs = $this->model->Users->check_user_exists($_POST['username']);
        if ($rs == 0) {
          // Set a response code
          http_response_code(200);
          array_push($json, [
                'message' => 'false'
            ]);
        } else {
         // Set a response code
         http_response_code(401);
         array_push($json, [
                'message' => 'true'
            ]);
        }

        echo json_encode($json, JSON_UNESCAPED_UNICODE);
        echo "}";
    }

    public function register() {

        $json = [];
        echo "{";
        echo "\"User\":";

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
        $this->model->Users->id_user_type = 3; //default 3 - CLIENT
        $id = $this->model->Users->save();
        if ($id != null) {
                /* Register success */
                $this->model->Users->generate_token($id);
                $user = $this->model->Users->findById($id);

                $this->model->load('ImageUser');
                $avatar = $this->model->ImageUser->image_primary($id)->path;
                $cover = $this->model->ImageUser->image_banner($id)->path;

                $id_user_type = $user->id_user_type;
                $this->model->load('UserType');
                $user_type = $this->model->UserType->findById($id_user_type);
                $role = $user_type->name_user_type;
                // Set a response code
                http_response_code(200);
                array_push($json, [
                    'token' => $user->token,
                    'role' => $role,

                        'id' => $user->id,
                        'name' => $user->name,
                        'username' => $user->username,
                        'password' => $user->password,
                        'birthdate' => $user->birthdate,
                        'phone' => $user->phone,
                        'gender' => $user->gender,
                        'identify_number' => $user->identify_number,
                        'wallet' => $user->wallet,
                        'is_social' => $user->is_social,
                        'status' => $user->status,
                        'image' => [
                            'avatar' => $avatar,
                            'cover' => $cover,

                    ]
                ]);
        } else {
                /* Login failed */
                // Set a response code
                http_response_code(401);
                array_push($json, [
                    'message' => 'User is exists!'
                ]);
        }

        echo json_encode($json, JSON_UNESCAPED_UNICODE);
        echo "}";
    }

    /**
    * action login: validate login
    * method: POST
    */
    public function login() {
        $json = [];
        echo "{";
        echo "\"User\":";
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $this->model->load('Users');
            $id = $this->model->Users->validate_login($username, $password);
            if ($id != 0) {
                $token = $this->model->Users->generate_token($id);
                $user = $this->model->Users->findById($id);

                $this->model->load('ImageUser');
                $avatar = $this->model->ImageUser->image_primary($id)->path;
                $cover = $this->model->ImageUser->image_banner($id)->path;

                $id_user_type = $user->id_user_type;
                $this->model->load('UserType');
                $user_type = $this->model->UserType->findById($id_user_type);
                $role = $user_type->name_user_type;

                $password = $user->password;
                $decrypt_password = $this->model->Users->decrypt_password($password);

                // Set a response code
                http_response_code(200);
                array_push($json, [
                    'token' => $user->token,
                    'role' => $role,
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'password' =>  $decrypt_password,
                    'birthdate' => $user->birthdate,
                    'phone' => $user->phone,
                    'gender' => $user->gender,
                    'identify_number' => $user->identify_number,
                    'wallet' => $user->wallet,
                    'is_social' => $user->is_social,
                    'status' => $user->status,
                    'image' => [
                        'avatar' => $avatar,
                        'cover' => $cover,
                        ]
                ]);

            } else {
                /* Login failed */
                // Set a response code
                http_response_code(401);
                array_push($json, [
                    'message' => 'Unauthorized'
                ]);
            }
        } else {

        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
        echo "}";
    }

    /**
    * action logout
    * method: GET
    */

    public function logout() {
        $json = [];
        echo "{";
        echo "\"User\":";
        if(isset($_GET['token'])) {
            $token = $_GET['token'];
            $this->model->load('Users');
            $id = $this->model->Users->validate_logout($_GET['token']);
            if($id != 0) {
                // Set a response code
                http_response_code(200);
                $this->model->Users->remove_token($id);
                 /*Logout success*/
                 array_push($json, [
                     'message' => 'Logout success',
                 ]);
            } else {
                // Set a response code
                http_response_code(401);
                 /*Logout failed*/
                 array_push($json, [
                    'message' => 'Unauthorized user',
                ]);
            }
        } else {
            // Set a response code
            http_response_code(400);
            /*Token not exists*/
            array_push($json, [
                'message' => 'Token not exists',
            ]);
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
        echo "}";
    }

}
