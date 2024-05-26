<?php
Namespace App\Actions\Label;

use App\Actions\Action;

class LabelCreateAction extends Action
{
    protected function handle(array $data)
    {
        return auth()->user()->labels()->create($data);
    }
}