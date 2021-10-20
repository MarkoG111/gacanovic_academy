<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Topic extends Model
{
    public function getAllTopics()
    {
        return DB::table('topic')
            ->get();
    }

    public function addTopic($topic)
    {
        DB::table('topic')
            ->insert([
                'topic_name' => $topic,
                'created_at' => date('Y-m-d H-i-s', time()),
                'updated_at' => date('Y-m-d H-i-s', time())
            ]);
    }

    public function getAdminTopics()
    {
        return DB::table('topic')
            ->paginate(6);
    }

    public function getSingleTopic($id)
    {
        return DB::table('topic')
            ->where('id_topic', $id)
            ->first();
    }

    public function updateTopic($id, $topic)
    {
        DB::table('topic')
            ->where('id_topic', $id)
            ->update([
                'topic_name' => $topic,
                'updated_at' => date('Y-m-d H-i-s', time())
            ]);
    }

    public function deleteTopic($id)
    {
        DB::table('topic')
            ->where('id_topic', $id)
            ->delete();
    }
}
