<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Pages extends Component
{
    public $modalFormVisible = false;
    public $slug;
    public $title;
    public $content;

    public function createShowModal()
    {

    }

    public function render()
    {
        return view('livewire.pages');
    }
}
