<?php  if(!defined('PATH_SYSTEM')) die('Bad request!');

class FT_Model_Loader
{
    /**
     * Load helper
     *
     * @param   string
     * @desc    hàm load model, tham số truyền vào là tên của model
     */
    public function load($model)
    {
        // Nếu thư viện chưa được load thì thực hiện load
        if ( empty($this->{$model}) )
        {
            // Chuyển chữ hoa đầu và thêm hậu tố _Model
            $class = ucfirst($model) . '_Model';
            require_once(PATH_ROOT . '/model/' . $class . '.php');
            $this->{$model} = new $class();
        }
    }

}
