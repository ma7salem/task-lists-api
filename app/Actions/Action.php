<?php
namespace App\Actions;

abstract class Action 
{
    abstract protected function handle(array $data);

    public static function run(array $data){
        return (new static())->handle($data);
    }
}