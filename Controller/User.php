<?php
class Controller_User extends System_Controller
{
    public function profileAction()
    {

        $userId = $this->getArgs()['id'];

        try{
            $modelUser = Model_User:: getById($userId);
        }
        catch (Exception $e){

        }
    }
}