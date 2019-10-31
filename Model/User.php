<?php

class Model_User
{
    /**
     * Register mode
     */
    const MODE_REGISTER = 1;

    /**
     * Login mode
     */
    const MODE_LOGIN = 2;

    /**
     * Admin role id
     */
    const ROLE_ADMIN = 5;

    /**
     *
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    private $_password;

    /**
     *
     * @var string
     */
    public $photo;

    /**
     *
     * @var int
     */
    public $role_id;

    /**
     *
     * @param int $userId
     * @return Model_User
     * @throws Exception
     */
    public static function getById($userId)
    {
        $dbUser = new Model_Db_Table_User();
        $u = $dbUser->getById($userId);
        echo '<pre>';
        print_r($u);
        echo '</pre>';


        //$userData = !empty($dbUser->getById($userId)[0]) ? $dbUser->getById($userId)[0] : '';

        if (!empty($userData)) {
            $modelUser = new self();
            $modelUser->id = $userData->id;
            $modelUser->name = $userData->first_name . ' ' . $userData->last_name;
            $modelUser->email = $userData->email;
            $modelUser->photo = $userData->photo;
            $modelUser->role_id = $userData->role_id;

            return $modelUser;
        } else {
            throw new Exception('User not found', /*System_Exception::NOT_FOUND*/ 23);
        }
    }
}