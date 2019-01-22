<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!');

class Report_Controller extends Base_Controller
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

        $list_report = $this->model->Users->getTableReport($pages, $token);
        $num_rows = $this->model->Users->getNumRowReport();

        $table_name = "Report ($num_rows)";

        $data = [
            'page_name' => 'Report',
            'action_table' => 'index_table',
            'token' => $token,
            'pages' => $pages,
            'title' => 'index',
            'table_name' => $table_name,
            'table_subtitle' => 'Here is a table report',
            'list' => $list_report,
            'num_rows' => $num_rows,
        ];

        // Load view
        $this->view->load('index', $data);
    }
}
