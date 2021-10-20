<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMail extends Model
{
    use HasFactory;

    public function getMailsForAdmin()
    {
        return DB::table('contact_mail')
            ->paginate(6);
    }

    public function deleteContactMail($id)
    {
        DB::table('contact_mail')
            ->where('id_contact_mail', $id)
            ->delete();
    }
}
