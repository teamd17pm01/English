<?php
class BaseController{
    protected $folder;

    public function Render($file,$data = array())
    {
        $view_file = CURR_VIEW_PATH . $file . '.php';
        // kiểm tra file có tồn tại
        if (is_file($view_file)) {
            extract($data);
            ob_start();
            require_once($view_file);
            $content = ob_get_clean();

            require_once(CURR_LAYOUT_PATH . 'index.php');
        }
        else{
            header('Location: index.php?controller=pages&action=error');
        }
    }
}