<?php

class System_Router
{
    /**
     * Путь к файлу
     * @var string
     */
    private $_path;

    /**
     *
     * @param string $path
     * @throws Exception
     * @Return System_Router
     */
    public function setPath($path)
    {

        $path = trim($path, '/\\');
        $path .= DS;

        if (!is_dir($path)) {
            throw new Exception ('Invalid controller path: \'' . $path . '\'');
        }

        $this->_path = $path;
        return $this;
    }

    /**
     * Анализирует строку запроса, подгружает файл с нужным классом
     * @throws Exception
     */
    public function start()
    {
        // Анализируем путь
        $this->_getController($controllerName, $action, $args);



        // Создаём экземпляр контроллера
        $class = 'Controller_' . $controllerName;

        $controller = new $class();
        $controller->setArgs($args);
        // Действие доступно?
        if (!is_callable([$controller, $action])) {
            throw new Exception('404 error. Action ' . '\'' . $action . '\'' . ' Not Found');
        }

        call_user_func([$controller, $action]);

        //$viewFileName = 'View' . DS . $controllerName . DS . substr($action, 0, -6) . '.phtml';

        /**
         * @var System_View $view
         */
        //$view = $controller->view;

        //$layoutFileName = 'View' . DS . 'layout.phtml';
        //include $layoutFileName;
    }

    /**
     *
     * @param string $file
     * @param string $controller
     * @param string $action
     * @param string $args
     */
    private function _getController(&$controller, &$action, &$args)
    {
        $route = empty($_GET['route']) ? 'index' : $_GET['route'];

        // Получаем раздельные части
        $route = trim($route, '/\\');

        $parts = explode('/', $route);

        // Находим путь к файлу с контроллером

        if (empty($parts[0])) {
            $controller = 'Index';
        } else {
                        $controller = ucfirst(array_shift($parts));

        }

        if (empty($parts[0])) {
            $action = 'indexAction';
        } else {
            $action = array_shift($parts) . 'Action';
        }

        $args = $parts;
    }
}