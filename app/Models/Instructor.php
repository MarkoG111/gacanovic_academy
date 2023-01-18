<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Instructor extends Model
{
    use HasFactory;

    public function getPollAnswers()
    {
        return DB::table('answer')
            ->get();
    }

    public function voting($answer, $idUser)
    {
        DB::table('voting')
            ->insert([
                'id_answer' => $answer,
                'id_user' => $idUser
            ]);
    }

    public function ifVoted($idUser)
    {
        return DB::table('voting')
            ->where('id_user', '=', $idUser)
            ->exists();
    }

    public function updateToInstructor($idUser)
    {
        return DB::table('user')
            ->where('id_user', $idUser)
            ->update([
                'is_instructor' => 1
            ]);
    }
}
