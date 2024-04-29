<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\GoodsRequest;
use App\Models\Category;
use App\Models\Goods;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ModifyTablesController extends Controller
{
    public function addCategory(CategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->validated());

        return response()->json($category, 201);
    }

    public function addGoods(GoodsRequest $request): JsonResponse
    {
        // Create a new goods instance with the validated data
        $goods = Goods::create($request->validated());

        return response()->json($goods, 201);
    }

    public function updateCategory(CategoryRequest $request, $id): JsonResponse
    {
        $category = Category::find($id);

        if(Category::all()->count() < $id){
            return response()->json([
                'data' => 'Trying to update not existing category',
            ],400);
        }

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Update only the fields that are present in the request
        $category->update($request->validated());

        return response()->json($category);
    }

    public function updateGoods(Request $request, $id): JsonResponse
    {
        $goods = Goods::find($id);

        if (!$goods) {
            return response()->json(['message' => 'Goods not found'], 404);
        }

        if (!is_null($request->category_id)) {
            $howManyIDs = Category::all()->count();
            if($howManyIDs < $request->category_id) {
                return response()->json([
                    'data' => 'Trying to assign goods to not existing category',
                ],400);
            }
        }

        // Get the fields that are present in the request
        $updateData = $request->only([
            'category_id',
            'goods_name',
            'goods_description',
            'goods_price',
            // Add more fields as needed
        ]);

        // Update only the fields that are present in the request
        $goods->update($updateData);

        return response()->json($goods);
    }
}
