<?php

namespace App\Repositories\Dashboard;

use App\Models\User;
use App\Models\Contact;
use PhpParser\Node\Expr\AssignOp\Concat;

class ContactRepository
{
    public function getMarkReadContacts()
    {
        return Contact::where('is_read', 1)->get();
    }
    public function getInboxContacts($keyword = null)
    {
        return Contact::searchContacts($keyword)->latest();
    }

    public function getContactById($id)
    {
        return Concat::withTrashed()->find($id);
    }

    public function markRead($contact)
    {
        $contact->is_read = 1;
        $contact->save();
    }

    public function deleteContact($contact)
    {
        return $contact->delete();
    }
    public function getTrashedContacts($keyword = null)
    {
        return Contact::searchContacts($keyword)->onlyTrashed()->latest();
    }

    public function markUnRead($contact)
    {
        $contact->is_read = 0;
        $contact->save();
    }
    // softDeletes
    public function restoreContact($contact)
    {
        return $contact->restore();
    }
    public function forceDeleteContact($contact)
    {
        return $contact->forceDelete();
    }


}
