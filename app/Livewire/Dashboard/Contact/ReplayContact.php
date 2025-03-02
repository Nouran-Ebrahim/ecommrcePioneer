<?php

namespace App\Livewire\Dashboard\Contact;

use App\Services\Dashboard\ContactService;
use Livewire\Component;
use Livewire\Attributes\On;

class ReplayContact extends Component
{
    public $contact;
    public $id, $email, $subject, $replayMessage, $clientName;
    protected ContactService $contactService;
    public function mount(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }
    #[On('call-replay-contact-component')]
    public function luanchModal($contactId)
    {
        // dd($contactId);
        $this->setDataInAttributes($contactId);
        $this->dispatch('luanch-replay-contact-modal');
    }
    public function setDataInAttributes($contactId)
    {
        $this->contact = $this->contactService->getContactById($contactId);
        $this->id = $this->contact->id;
        $this->email = $this->contact->email;
        $this->subject = $this->contact->subject;
        $this->clientName = $this->contact->name;
    }

    public function replayContact()
    {
        $replayStatus = $this->contactService->replayContact($this->id, $this->replayMessage);
        if (!$replayStatus) {
            return false;
        }
        //  $this->dispatch('contact-replay');
        $this->dispatch('close-modal');
        // $this->dispatch('replay-contact-success');

    }
    public function render()
    {
        return view('livewire.dashboard.contact.replay-contact');
    }
}
