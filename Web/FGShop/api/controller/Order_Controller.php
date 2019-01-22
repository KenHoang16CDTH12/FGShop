<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Order_Controller extends Base_Controller
{
    public function group() {
        if ($this->have_token()) {

            $this->model->load('Order');

            $order = $this->model->Order;
            $list = $order->group_with_id($_POST['id_user']);

            $json = [];
            echo "{";
            echo "\"Order\":";
            http_response_code(200);
            $json = $list;
            echo json_encode($json, JSON_UNESCAPED_UNICODE);
            echo "}";
         }
    }

    public function group_detail() {
          if ($this->have_token()) {

            $this->model->load('OrderDetail');

            $order_detail = $this->model->OrderDetail;
            $id_order = $_POST['id_order'];
            $list = $order_detail->group_with_id($id_order);

            $json = [];
            echo "{";
            echo "\"Order\":";
            http_response_code(200);
            $json = $list;
            echo json_encode($json, JSON_UNESCAPED_UNICODE);
            echo "}";
         }
    }

    public function request()
    {

        if ($this->have_token()) {

            $this->model->load('Order');

            $order = $this->model->Order;
            $order->id_user = $_POST['id_user'];
            $order->status = $_POST['status'];
            $order->phone = $_POST['phone'];
            $order->delivery_address = $_POST['delivery_address'];
            $order->delivery_date = isset($_POST['delivery_date']) ? $_POST['delivery_date'] : "";
            $order->order_date = $_POST['order_date'];
            $order->desc = isset($_POST['desc']) ? $_POST['desc'] : "";
            $order->save();

            $json = [];
            echo "{";
            echo "\"Order\":";
            http_response_code(200);
            array_push($json, [
                'id' => $order->id
            ]);
            echo json_encode($json, JSON_UNESCAPED_UNICODE);
            echo "}";
        }
    }

    public function store() {
        if ($this->have_token()) {

            $this->model->load('OrderDetail');

            $order_detail = $this->model->OrderDetail;
            $order_detail->id_order = $_POST['id_order'];
            $order_detail->id_product = $_POST['id_product'];
            $order_detail->quanity = $_POST['quanity'];
            $order_detail->save();

            $json = [];
            echo "{";
            echo "\"Order\":";
            http_response_code(200);
            array_push($json, [
                $order_detail
            ]);
            echo json_encode($json, JSON_UNESCAPED_UNICODE);
            echo "}";
        }
    }
}
