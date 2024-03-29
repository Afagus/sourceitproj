<?php
ini_set('display _errors',1);
error_reporting(E_ALL);

const DS = DIRECTORY_SEPARATOR;
// Узнаём путь к файлам сайта
$site_path = realpath(dirname(__FILE__)).DS;

$config = file_get_contents($site_path . DS . 'config.xml');

$configXML  = new SimpleXMLElement($config);

$host       = (string)$configXML->db->host;
$dbname     = (string)$configXML->db->dbname;
$username   = (string)$configXML->db->username;
$password   = (string)$configXML->db->password;

try {
    $db = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $password);
} catch (PDOException $e) {

    echo "Error!: " . $e->getMessage();
}
/**
 * Вызвывается автоматически при обращении к классу или при создании объекта
 */
spl_autoload_register('loadClass');

/**
 *
 * Функция, реализующая автозагрузку файла с нужным классом,
 * по принципу: имя класса - это путь к файлу, в котором он хранится
 *
 * @param string $className
 * @throws Exception
 */
function loadClass($className)
{
    //echo $className . '<br />';
    $path = explode('_', $className);


    $file = '';
    foreach ($path as $item) {
        $file .= $item . DS;
        }

    $file = substr($file, 0, -1) . '.php';


    if(file_exists($file)) {
        include_once $file;
    }
    else {
        throw new Exception('File '. $file . ' not found', 1);
    }
}

try {
    System_Registry :: set('connection', $db);

    $router = new System_Router();
   $router->setPath($site_path . 'Controller');
    $router->start();
}
catch(Exception $e) {
    echo $e->getMessage();
}
