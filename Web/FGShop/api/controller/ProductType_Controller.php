<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class ProductType_Controller extends Base_Controller
{

    public function group()
    {

        $this->model->load('ProductType');

        $id_group = $_POST['id_group'];;
        $list = $this->model->ProductType->group_with_id($id_group);

        $json = [];
        echo "{";
        echo "\"ProductType\":";
         // Set a response code
        http_response_code(200);
        foreach ($list as $object) {
            array_push($json, [
                    'id' => $object->id,
                    'name_type' => $object->name_type,
                    'image' => $object->image,
                    'id_group' => $object->id_group,
                ]);
        }

        echo json_encode($json, JSON_UNESCAPED_UNICODE);
        echo "}";
    }
}
