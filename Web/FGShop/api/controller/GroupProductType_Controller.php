<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class GroupProductType_Controller extends Base_Controller
{
    /**
    * action index: show all GroupProductTypes
    * method: GET
    */
    public function index()
    {

        $this->model->load('GroupProductType');

        $list = $this->model->GroupProductType->all();

        $json = [];
        echo "{";
        echo "\"GroupProductType\":";
         // Set a response code
        http_response_code(200);
        foreach ($list as $object) {
            array_push($json, [
                    'id' =>  $object->id,
                    'name_group' => $object->name_group,
                    'image' => $object->image,
                ]);
        }

        echo json_encode($json, JSON_UNESCAPED_UNICODE);
        echo "}";
    }
}
