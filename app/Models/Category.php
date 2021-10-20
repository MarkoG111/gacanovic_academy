<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    public function getFeaturedCategories($limit)
    {
        return DB::table('category')
            ->limit($limit)
            ->get();
    }

    public function getAllCateogries()
    {
        return DB::table('category')
            ->get();
    }

    public function getCategoriesForAdmin()
    {
        return DB::table('category')
            ->paginate(6);
    }

    public function addCategory($category, $image)
    {
        DB::table('category')
            ->insert([
                'category_name' => $category,
                'category_image' => $image,
                'created_at' => date('Y-m-d H-i-s', time()),
                'updated_at' => date('Y-m-d H-i-s', time())
            ]);
    }

    public function getSingleCategory($id)
    {
        return DB::table('category')
            ->where('id_category', $id)
            ->first();
    }

    public function updateCategoryWithoutImage($id, $name, $updatedAt)
    {
        DB::table('category')
            ->where('id_category', $id)
            ->update([
                'id_category' => $id,
                'category_name' => $name,
                'updated_at' => $updatedAt
            ]);
    }

    public function updateCategoryWithImage($id, $name, $image, $updatedAt)
    {
        DB::table('category')
            ->where('id_category', $id)
            ->update([
                'id_category' => $id,
                'category_name' => $name,
                'category_image' => $image,
                'updated_at' => $updatedAt
            ]);
    }

    public function deleteCategory($id)
    {
        DB::table('category')
            ->where('id_category', $id)
            ->delete();
    }


}
