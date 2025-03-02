<?php

namespace App\Services\Dashboard;

use App\Mail\ReplayContactMail;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\ContactRepository;

class ContactService
{
    /**
     * Create a new class instance.
     */
    protected $ContactRepository;
    public function __construct(ContactRepository $ContactRepository)
    {
        $this->ContactRepository = $ContactRepository;
    }
    public function getMarkReadContacts()
    {
        return $this->ContactRepository->getMarkReadContacts();
    }
    public function getInboxContacts($keyword = null)
    {
        return $this->ContactRepository->getInboxContacts($keyword);
    }
    public function getTrashedContacts($keyword = null)
    {
        return $this->ContactRepository->getTrashedContacts($keyword);

    }

    public function getContactById($id): mixed
    {
        $contact = $this->getContactById($id);
        return $contact ?? false;
    }

    public function markRead($id)
    {
        $contact = $this->getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->ContactRepository->markRead($contact);

    }

    public function deleteContact($id)
    {
        $contact = $this->getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->ContactRepository->deleteContact($contact);
    }

    public function markUnRead($id)
    {
        $contact = $this->getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->ContactRepository->markUnRead($contact);

    }
    public function restoreContact($id)
    {
        $contact = $this->getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->ContactRepository->restoreContact($contact);
    }
    public function forceDeleteContact($id)
    {
        $contact = $this->getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->ContactRepository->forceDeleteContact($contact);
    }
    public function replayContact($contactId, $replayMessage)
    {
        $contact = $this->getContactById($contactId);
        Mail::to($contact->email)->send(new ReplayContactMail($replayMessage, $contact->subject, $contact->name));
        return true;
    }
}
