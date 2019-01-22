<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Product_Controller extends Base_Controller
{

    public function group() {
        $this->model->load('Product');
        $this->model->load('ImageProduct');
        $this->model->load('Rating');
        $this->model->load('Favorite');

        $id_product_type = $_POST['id_product_type'];
        $limit = $_POST['limit'];
        $list = $this->model->Product->group_with_type($id_product_type, $limit);

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

    public function detail()
    {
        $this->model->load('Product');
        $this->model->load('ImageProduct');
        $this->model->load('ImageBrand');
        $this->model->load('ImageUser');
        $this->model->load('Rating');
        $this->model->load('Favorite');
        $this->model->load('Brand');
        $this->model->load('Users');

        $id_product = $_POST['id_product'];
        $object = $this->model->Product->findById($id_product);

        $json = [];
        echo "{";
        echo "\"Product\":";
         // Set a response code
        http_response_code(200);
        $id = $object->id;

        $image_product = $this->model->ImageProduct->image_primary($id)->path;
        $brand = $this->model->Brand->findById($object->id_brand);
        $image_brand = $this->model->ImageBrand->image_logo($object->id_brand)->path;
        $rate = $this->model->Rating->rate($id);
        $num_people_rates = $this->model->Rating->num_people_rates($id);
        $num_likes = $this->model->Favorite->num_likes($id);

        $user = $this->model->Users->findById($object->add_by);
        $name = $user->name;
        $avatar = $this->model->ImageUser->image_primary($object->add_by)->path;

        $add_by = [
            "id" => $object->add_by,
            "name" => $name,
            "avatar" => $avatar
        ];

        array_push($json, [
                            'id' => $id,
                            'name_product' => $object->name_product,
                            'price' => $object->price,
                            'isbn' => $object->isbn,
                            'infor' => $object->infor,
                            'desc' => $object->desc,
                            'status' => $object->status,
                            'quanity' => $object->quanity,
                            'add_by' => $add_by,
                            'brand' => [
                                'id' => $brand->id,
                                'name_brand' => $brand->name_brand,
                                'image' => $image_brand
                            ],
                            'image' => $image_product,
                            'rate' => $rate,
                            'num_people_rates' => $num_people_rates,
                            'num_likes' => $num_likes
                    ]);

        echo json_encode($json, JSON_UNESCAPED_UNICODE);
        echo "}";
    }
}
