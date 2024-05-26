<?php
Namespace App\Actions\Label;

use App\Actions\Action;

class LabelUpdateAction extends Action
{
    protected function handle(array $data)
    {
        $inputs   = $data['inputs'];
        $label    = $data['label'];
        $label->update($inputs);
        return $label->fresh();
    }
}