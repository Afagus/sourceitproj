<?php
class Controller_User extends System_Controller
{
    public function profileAction()
    {

        $userId = $this->getArgs()['id'];

        try{
            $modelUser = Model_User:: getById($userId);

//            echo '<pre>';
//            print_r($modelUser);
//            echo '</pre>';

        }
        catch (Exception $e){
            echo 'Пользователь не найден!';

        }
    }
}