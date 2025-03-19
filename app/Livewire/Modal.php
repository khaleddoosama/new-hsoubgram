<?php

namespace App\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $isOpen = false;

    protected $listeners = ['openModal' => 'open', 'closeModal' => 'close'];

    public function mount()
    {
        $this->isOpen = false; // Ensure it's always false when the page loads
    }

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.modal');
    }
}