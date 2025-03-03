<?php

namespace App\Livewire\Dashboard\Contact;

use App\Services\Dashboard\ContactService;
use Livewire\Component;

class Contactsidebar extends Component
{
    public $screen = 'inbox';
    protected $listeners = [
        'msg-deleted' => '$refresh',
        'refresh-messages' => '$refresh',
    ];

    protected ContactService $contactService;
    public function boot(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }
    public function selectScreen($screen)
    {
        $this->screen = $screen;
        $this->dispatch('select-screen', $screen);
    }

    // delete All
    public function markAllAsRead()
    {
        $this->contactService->markAllAsRead();
        $this->dispatch('msg-deleted',__('messages.updateed_successfully'));
    }
    public function deleteAllReadContacts()
    {
        $this->contactService->deleteAllReadedContacts();
        $this->dispatch('msg-deleted',__('messages.deleted_successfully'));

    }
    public function deleteAllAnswereContacts()
    {
        $this->contactService->deleteAllAnsweredContacts();
        $this->dispatch('msg-deleted',__('messages.deleted_successfully'));

    }
    public function render()
    {
        return view('livewire.dashboard.contact.contactsidebar', [
            'inboxCount' => $this->contactService->getInboxContacts()->count(),
            'answeredCount' => $this->contactService->getAnsweredContacts()->count(),
            'readedCount' => $this->contactService->getMarkReadContacts()->count(),
            'trashedCount' => $this->contactService->getTrashedContacts()->count(),
        ]);
    }
}
