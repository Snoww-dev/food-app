<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $food = Food::orderBy('created_at', 'DESC')->paginate(10);

        if ($food->count() > 0) {
            return response([
                'message' => "success",
                'total_size' => $food->count(),
                'type_id' => 0,
                'offset' => 0,
                'products' => $food,
            ], 200);
        } else {
            return response([
                'message' => "error",
                'message' => 'List is empty',
            ], 200);
        }
    }

    public function getPopularItems()
    {
        $popularFoods = Food::where('type_id', '3')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        if ($popularFoods->count() > 0) {
            return response([
                'message' => 'success',
                'total_size' => $popularFoods->count(),
                'type_id' => 3,
                'offset' => 0,
                'products' => $popularFoods,
            ], 200);
        } else {
            return response([
                'message' => 'error',
                'message' => 'Không có thức ăn phổ biến nào trong danh sách',
            ], 200);
        }
    }

    public function getRecommendedItems(Request $request)
    {
        $recommendFoods = Food::where('type_id', '2')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        if ($recommendFoods->count() > 0) {
            return response([
                'message' => 'success',
                'total_size' => $recommendFoods->count(),
                'type_id' => 2,
                'offset' => 0,
                'products' => $recommendFoods,
            ], 200);
        } else {
            return response([
                'message' => 'error',
                'message' => 'Không có thức ăn phổ biến nào trong danh sách',
            ], 200);
        }
    }

    public function search_products(Request $request)
    {
        $keyword = $request->input('keyword');
        $search_by = $request->input('search_by', 'name'); // Mặc định tìm kiếm theo tên

        $foods = Food::search($keyword, $search_by);
        $result = $foods->paginate(10);

        if ($foods->count() > 0) {
            return response([
                'message' => 'success',
                'total_size' => $foods->count(),
                'type_id' => 0,
                'offset' => 0,
                'products' => $result,
            ], 200);
        } else {
            return response([
                'message' => 'error',
                'message' => 'Không có thức ăn phổ biến nào trong danh sách',
            ], 404);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
