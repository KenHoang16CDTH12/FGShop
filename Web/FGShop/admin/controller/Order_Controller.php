<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Order_Controller extends Base_Controller
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
        $this->model->load('Order');

         $list_search_type = [
            "ID" => "id",
            "ORDER BY" => "username",
            "PHONE" => "phone",
            "STATUS" => "status",
            "DELIVERY ADDRESS" => "delivery_address",
            "DELIVERY DATE" => "delivery_date",
            "ORDER DATE" => "order_date",
        ];

        $tag_search_type = "";

        $list = $this->model->Order->getTable($pages, $token);
        $num_rows = $this->model->Order->getNumRow();

        if (isset($_POST['search'])) {
            if (isset($_POST['search_type']) && isset($_POST['search_text'])) {
                $search_type = $_POST['search_type'];
                $tag_search_type = $search_type;
                $search_text = $_POST['search_text'];
                $list =  $this->model->Order->getTable($pages, $token, $search_type, $search_text);
                $num_rows = $this->model->Order->getNumRow($search_type, $search_text);
            } else {
                $list = $this->model->Order->getTable($pages, $token);
                $num_rows = $this->model->Order->getNumRow();
            }
        }

        $table_name = "Order Table ($num_rows)";

        $data = [
            'page_name' => 'Order',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => $table_name,
            'table_subtitle' => 'Here is a table Order',
            'list_search_type' => $list_search_type,
            'tag_search_type' => $tag_search_type,
            'list' => $list,
            'num_rows' => $num_rows,
        ];

        // Load view
        $this->view->load('index', $data);
    }

    /**
    * action edit: show form edit a Order
    * method: GET
    */
    public function edit()
    {
         //Check token
        $token = $this->have_token();

        $this->model->load('Order');
        $Order = $this->model->Order->findById($_GET['id']);

        $this->model->load('Users');
        $users = $this->model->Users->all();

        $pages = isset($_GET['pages']) ? $_GET['pages'] : 0;
        $this->model->load('OrderDetail');
        $order_detail = $this->model->OrderDetail->getTable($pages, $token, $_GET['id']);
        $num_rows = $this->model->OrderDetail->getNumRow($_GET['id']);
        $total = $this->model->OrderDetail->getTotal($_GET['id']);

        $data = [
            'page_name' => 'Order',
            'pages' => $pages,
            'action_table' => 'order/edit',
            'action_table_details' => 'index_table',
            'action_name' => 'Edit Order',
            'token' => $token,
            'title' => 'edit',
            'table_name' => 'Order Details Table',
            'table_subtitle' => 'Here is a table Order Details',
            'object' => $Order,
            'users' => $users,
            'list' => $order_detail,
            'num_rows' => $num_rows,
            'total' => $total
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

        $this->model->load('Order');
        $order = $this->model->Order->findById($_GET['id']);
        $order->id_user = $_POST['id_user'];
        $order->phone = $_POST['phone'];
        $order->status = $_POST['status'];
        $order->delivery_address = $_POST['delivery_address'];
        $order->delivery_date = $_POST['delivery_date'];
        $order->order_date = $_POST['order_date'];
        $order->desc = $_POST['desc'];
        $order->update();

        go_back();

    }


    /**
    * action create: create a Order
    * method: GET
    */
    public function create()
    {
        //Check token
        $token = $this->have_token();

        $this->model->load('Users');
        $users = $this->model->Users->all();

        $data = [
            'page_name' => 'Order',
            'action_table' => 'order/create',
            'action_name' => 'Add Order',
            'token' => $token,
            'title' => 'create',
            'users' => $users,
            'product_types' => $product_types,
            'brands' => $brands,
        ];

        // Load view
        $this->view->load('index', $data);
    }

     /**
    * action store: save a Order to database
    * method: POST
    */
    public function store()
    {
        //Check token
        $token = $this->have_token();
        $this->model->load('Order');
        $this->model->Order->id_user = $_POST['id_user'];
        $this->model->Order->phone = $_POST['phone'];
        $this->model->Order->status = $_POST['status'];
        $this->model->Order->delivery_address = $_POST['delivery_address'];
        $this->model->Order->delivery_date = $_POST['delivery_date'];
        $this->model->Order->order_date = $_POST['order_date'];
        $this->model->Order->desc = $_POST['desc'];
        $this->model->Order->save();

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
        $this->model->load('Order');
        $Order = $this->model->Order->findById($_GET['id']);
        $Order->delete();

        go_back();
    }

}
