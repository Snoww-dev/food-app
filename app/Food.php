<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Food extends Model
{
    // Tìm kiếm đồ ăn theo tên hoặc giá
    public static function search($keyword, $search_by = 'name')
    {
        return self::where(function ($query) use ($search_by, $keyword) {
            $query->where($search_by, 'like', '%' . $keyword . '%');
        });
    }
}
