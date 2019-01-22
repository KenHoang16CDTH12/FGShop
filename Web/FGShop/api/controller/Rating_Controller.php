<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Rating_Controller extends Base_Controller
{

     public function group()
    {
        $this->model->load('Rating');
        $this->model->load('Users');
        $this->model->load('ImageUser');

        $id_product = $_POST['id_product'];
        $limit = $_POST['limit'];
        $list = $this->model->Rating->group_products($id_product, $limit);

        $json = [];
        echo "{";
        echo "\"Rating\":";
         // Set a response code
        http_response_code(200);
        foreach ($list as $object) {
            $id = $object->id;
            $id_product = $object->id_product;
            $id_user = $object->id_user;
            $content = $object->content;
            $stars = $object->stars;
            $time_rate = $object->time_rate;

            $user = $this->model->Users->findById($id_user);
            $name = $user->name;
            $avatar = $this->model->ImageUser->image_primary($id_user)->path;

            array_push($json, [
                                'id' => $id,
                                'id_product' => $id_product,
                                'user' => [
                                    'id' => $id_user,
                                    'name'  => $name,
                                    'avatar' => $avatar
                                ],
                                'stars' => $stars,
                                'content' => $content,
                                'time_rate' => $time_rate,
                        ]);
        }

        echo json_encode($json, JSON_UNESCAPED_UNICODE);
        echo "}";
    }

    public function store()
    {

        if ($this->have_token()) {
            $this->model->load('Rating');

            $rating = $this->model->Rating;
            $rating->id_product = $_POST['id_product'];
            $rating->id_user = $_POST['id_user'];
            $rating->content = $_POST['content'];
            $rating->stars = $_POST['stars'];
            $rating->time_rate = $_POST['time_rate'];
            $rating->save();

            $json = [];
            echo "{";
            echo "\"Rating\":";
            http_response_code(200);
            array_push($json, [
                'message' => 'Success'
            ]);
            echo json_encode($json, JSON_UNESCAPED_UNICODE);
            echo "}";
        }
    }
}
