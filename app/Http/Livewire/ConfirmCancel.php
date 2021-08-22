<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ConfirmCancel extends Component
{
    public $model, $route;

    public function render()
    {
        return view('livewire.confirm-cancel');
    }

    public function mount($model, $route)
    {
	$this->model = $model;
	$this->route = $route;
    }
}
