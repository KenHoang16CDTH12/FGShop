<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Favorite_Controller extends Base_Controller
{

    public function group() {
        if ($this->have_token()) {
            $this->model->load('Product');
            $this->model->load('ImageProduct');
            $this->model->load('Rating');
            $this->model->load('Favorite');

            $id_user = $_POST['id_user'];
            $list = $this->model->Product->group_with_favorite($id_user);

            $json = [];
            echo "{";
            echo "\"Product\":";
             // Set a response code
            http_response_code(200);
            foreach ($list as $object) {
                $id = $object->id;
                $image_product = $this->model->ImageProduct->image_primary($id)->path;
                $rate = $this->model->Rating->rate($id);
                $num_people_rates = $this->model->Rating->num_people_rates($id);
                $num_likes = $this->model->Favorite->num_likes($id);
                array_push($json, [
                                    'id' => $id,
                                    'name_product' => $object->name_product,
                                    'price' => $object->price,
                                    'image' => $image_product,
                                    'rate' => $rate,
                                    'num_people_rates' => $num_people_rates,
                                    'num_likes' => $num_likes
                            ]);
            }

            echo json_encode($json, JSON_UNESCAPED_UNICODE);
            echo "}";
        }
    }

    public function store()
    {

        if ($this->have_token()) {
            $this->model->load('Favorite');

            $favorite = $this->model->Favorite;
            $favorite->id_product = $_POST['id_product'];
            $favorite->id_user = $_POST['id_user'];
            $rs = $favorite->save();

            $json = [];
            echo "{";
            echo "\"Favorite\":";
            http_response_code(200);
            if ($rs == true) {
                array_push($json, [
                    'message' => 'Favorite'
                ]);
            } else {
                array_push($json, [
                    'message' => 'Unfavorite'
                ]);
            }
            echo json_encode($json, JSON_UNESCAPED_UNICODE);
            echo "}";
        }
    }

    public function check() {
        if ($this->have_token()) {
            $this->model->load('Favorite');

            $favorite = $this->model->Favorite;
            $rs = $favorite->check_favorite_exists($_POST['id_product'], $_POST['id_user']);

            $json = [];
            echo "{";
            echo "\"Favorite\":";
            http_response_code(200);
            if ($rs == 0) {
                array_push($json, [
                    'message' => 'Unfavorite'
                ]);
            } else {
                array_push($json, [
                    'message' => 'Favorite'
                ]);
            }
            echo json_encode($json, JSON_UNESCAPED_UNICODE);
            echo "}";
        }
    }
}
