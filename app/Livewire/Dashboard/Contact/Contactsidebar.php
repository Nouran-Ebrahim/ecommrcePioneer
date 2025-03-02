<?php

namespace App\Livewire\Dashboard\Contact;

use Livewire\Component;

class Contactsidebar extends Component
{
    public $screen = 'inbox';
    public function selectScreen($screen)
    {
        $this->screen = $screen;
        $this->dispatch('select-screen', $screen);
        $this->dispatch('refresh-show');
    }
    public function render()
    {
        return view('livewire.dashboard.contact.contactsidebar');
    }
}
