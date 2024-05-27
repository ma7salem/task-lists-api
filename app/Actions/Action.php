<?php
namespace App\Actions;

abstract class Action 
{
    /**
     * Handle any logic by creating handle function
     * @param array $data
     * 
    */
    abstract protected function handle(array $data);

    /**
     * Run your logic by return all logic that has been written in handle function
     * @param array $array
     * 
    */
    public static function run(array $data){
        return (new static())->handle($data);
    }
}