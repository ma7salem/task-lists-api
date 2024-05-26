<?php
Namespace App\Actions\Label;

use App\Actions\Action;

class LabelDeleteAction extends Action
{
    protected function handle(array $data)
    {
        $label = $data['label'];
        return $label->delete();
    }
}