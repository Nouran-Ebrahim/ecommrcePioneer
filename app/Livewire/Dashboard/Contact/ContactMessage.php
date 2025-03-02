<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use App\Services\Dashboard\ContactService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ContactMessage extends Component
{
    use WithPagination;
    public $itemSearch;
    public $openMessageId;
    public $page = 1;
    public $screen = 'inbox';
    protected ContactService $contactService;

    public function mount(ContactService $contactService)
    {
        $this->contactService = $contactService;

        // $this->openMessageId = Contact::latest()->first()->id;


    }
    protected $listeners = [
        'msg-deleted' => '$refresh',
        'refresh-messages' => '$refresh',
        // 'contact-replay'=>'$refresh'
    ];

    #[On('select-screen')]
    public function selectScreen($screen)
    {
        $this->screen = $screen;
    }
    public function updatingItemSearch()
    {
        $this->resetPage();
    }
    public function makrkAsRead($msgId)
    {
        $this->contactService->markRead($msgId);
    }
    public function showMessage($msgId)
    {
        // $this->makrkAsRead($msgId);
        $this->dispatch('show-message', $msgId);
        $this->openMessageId = $msgId;
    }


    public function render()
    {
        if ($this->screen === 'readed') {
            $messages = Contact::where('is_read', 1);
        } elseif ($this->screen === 'answered') {
            $messages = Contact::where('replay_status', 1);
        } elseif ($this->screen === 'trash') {
            $messages = Contact::onlyTrashed();

        } else {
            $messages = Contact::query();
        }

        if ($this->itemSearch) {
            $messages = $messages->where('email', 'like', '%' . $this->itemSearch . '%');

        }
        // if ($this->screen === 'readed') {
        //     $messages = Contact::where('is_read', 1);
        // } elseif ($this->screen === 'answered') {
        //     $messages = Contact::where('replay_status', 1);
        // } elseif ($this->screen === 'trash') {
        //     $messages = $this->contactService->getTrashedContacts(trim($this->itemSearch));

        // } else {
        //     $messages = $this->contactService->getInboxContacts(trim($this->itemSearch));
        // }
        return view('livewire.dashboard.contact.contact-message', [
            'messages' => $messages->latest()->paginate(5),
        ]);
    }
}
