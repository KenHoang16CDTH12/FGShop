<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Banner_Controller extends Base_Controller
{
    /**
    * action index: show all GroupProductTypes
    * method: GET
    */
    public function index()
    {

        $this->model->load('Banner');
        $list = $this->model->Banner->all();

        $this->model->load('Product');

        $this->model->load('ImageProduct');

        $json = [];
        echo "{";
        echo "\"Banner\":";
        // Set a response code
        http_response_code(200);
        foreach ($list as $object) {
            $product = $this->model->Product->findById($object->id_product);
            $image_product = $this->model->ImageProduct->image_banner($object->id_product);
            array_push($json, [
                    'id' =>  $object->id,
                    'id_product' => $object->id_product,
                    'name_product' => $product->name_product,
                    'image' => $image_product->path,
                ]);
        }

        echo json_encode($json, JSON_UNESCAPED_UNICODE);
        echo "}";
    }
}
