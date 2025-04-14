<?php

namespace App\Services\Dashboard;

use App\Mail\ReplayContactMail;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\ContactRepository;
use DB;
use Illuminate\Support\Facades\Cache;
use Log;
class ContactService
{
    /**
     * Create a new class instance.
     */
    protected $contactRepository;
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getMarkReadContacts($keyword = null)
    {
        return $this->contactRepository->getMarkReadContacts($keyword);
    }
    public function getUnreadContacts($keyword = null)
    {
        return $this->contactRepository->getMarkUnreadContacts($keyword);
    }
    public function getInboxContacts($keyword = null)
    {
        return $this->contactRepository->getInboxContacts($keyword);
    }
    public function getAnsweredContacts($keyword = null)
    {
        return $this->contactRepository->getAnsweredContacts($keyword);
    }
    public function getTrashedContacts($keyword = null)
    {
        return $this->contactRepository->getTrashedContacts($keyword);
    }
    public function getContactById($id)
    {
        $contact = $this->contactRepository->getContactById($id);
        return $contact ?? false;
    }
    public function deleteContact($id)
    {
        $contact = $this->getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->contactRepository->deleteContact($contact);
    }
    public function markAsRead($id)
    {
        $contact = $this->getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->contactRepository->markRead($contact);
    }
    public function markUnread($id)
    {
        $contact = $this->getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->contactRepository->markUnread($contact);
    }
    public function restoreContact($id)
    {
        $contact = $this->getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->contactRepository->restoreContact($contact);
    }
    public function forceDeleteContact($id)
    {
        $contact = $this->getContactById($id);
        if (!$contact) {
            return false;
        }
        return $this->contactRepository->forceDeleteContact($contact);
    }
    public function deleteAllReadedContacts()
    {
        return $this->contactRepository->deleteAllReadedContacts();
    }
    public function markAllAsRead()
    {
        return $this->contactRepository->markAllAsRead();
    }
    public function deleteAllAnsweredContacts()
    {
        return $this->contactRepository->deleteAllAnsweredContacts();
    }
    public function latestContact()
    {
        return $this->contactRepository->latestContact();
    }
    public function replayContact($contactId, $replayMessage)
    {
        try {
            DB::beginTransaction();
            $contact = $this->getContactById($contactId);
            Mail::to($contact->email)->send(new ReplayContactMail($contact->name, $replayMessage, $contact->subject));

            //mark as read to contact
            $this->markAsRead($contactId);
            $contact->update([
                'replay_status' => 1,
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error Sending email: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return false;
        }

    }
}
