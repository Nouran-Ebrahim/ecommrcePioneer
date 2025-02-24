<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactMessage extends Component
{
    use WithPagination;
    public $itemSearch;
    public $page = 1;
    public function updatingItemSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.dashboard.contact.contact-message', [
            'messages' => Contact::when($this->itemSearch, function ($q) {
                return $q->where('email', 'like', '%' . $this->itemSearch . '%');
            })->latest()->paginate(5),
        ]); 
    }
}
