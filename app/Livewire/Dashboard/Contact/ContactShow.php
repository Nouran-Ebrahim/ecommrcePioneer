<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use App\Services\Dashboard\ContactService;
use Livewire\Attributes\On;
use Livewire\Component;

class ContactShow extends Component
{
    public $msg;
    protected $listeners = [
        'refresh-show' => '$refresh',
        'contact-replay' => '$refresh'
    ];
    protected ContactService $contactService;

    public function mount(ContactService $contactService)
    {
        // $this->msg = Contact::latest()->first();
        $this->contactService = $contactService;

    }
    #[On('show-message')]
    public function showMessage($msgId)
    {
        $this->msg = Contact::withTrashed()->where('id', $msgId)->first();
    }
    public function deleteMessage($msgId)
    {
        Contact::where('id', $msgId)->delete();
        $this->msg = Contact::latest()->first();
        $this->dispatch('msg-deleted', trans('messages.deleted_successfully'));
        $this->dispatch('refresh-show');


    }
    public function restoreContact($msgId)
    {
        $this->contactService->restoreContact($msgId);
        $this->msg = Contact::latest()->first();
        $this->dispatch('refresh-messages');
        $this->dispatch('refresh-show');


    }
    public function forceDeleteContact($msgId)
    {
        $this->contactService->forceDeleteContact($msgId);
        $this->msg = Contact::latest()->first();
        $this->dispatch('msg-deleted', 'deleted permanently successfully');
        $this->dispatch('refresh-show');
    }
    public function replayMsg($msgId)
    {
        // dd($msgId);
        $this->dispatch('call-replay-contact-component', $msgId);

    }
    public function markAsUnRead($msgId)
    {
        // dd($msgId);
        $this->contactService->markUnRead($msgId);
        $this->dispatch('refresh-messages');

    }
    public function render()
    {
        return view('livewire.dashboard.contact.contact-show');
    }
}
