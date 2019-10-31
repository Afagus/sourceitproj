<?php
abstract class System_Controller
{
    /**
     *
     * @var array
     */
    public $args;

    /**
     *
     * @param array $args
     */
    public function setArgs($args)
    {
        $this->args = $args;
    }

    /**
     *
     * @return array
     */
    public function getArgs()
    {
        $count = count($this->args);
        $arguments = [];

        for($i = 0; $i < $count - 1; $i += 2) {
            $arguments[$this->args[$i]] = $this->args[$i + 1];
        }

        return $arguments;
    }
}