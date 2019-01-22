<?php

class FT_Middleware_Loader {

  public function load($middleware) {
   // Nếu thư viện chưa được load thì thực hiện load
        if ( empty($this->{$middleware}) )
        {
            // Chuyển chữ hoa đầu và thêm hậu tố _Middleware
            $class = ucfirst($middleware) . '_Middleware';
            require_once(PATH_SYSTEM . '/middleware/' . $class . '.php');
            $this->{$middleware} = new $class();
        }
  }

}

?>
