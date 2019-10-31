<?php
abstract class System_Db_Table
{
    /**
     * Table name
     * @var string
     * */
    protected $_name = '';

    /**
     *
     * @var PDO $_connection
     *
     */
    protected $_connection;

    public function __construct()
    {
        $this->_connection = System_Registry::get('connection');
    }

    /**
     *
     * @return PDO
     */
    public function getConnection()
    {
        return $this->_connection;
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     *
     * @param int $id
     * @return array
     */
    public function getById($id)
    {
        $sql = 'select * from ' . $this->getName() . ' where id = ?';

        $sth = $this->getConnection()->prepare($sql);
        $sth->execute([$id]);

        $result = $sth->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }
}