<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Goods;
use Illuminate\Http\JsonResponse;

class CategoriesController extends Controller
{
    public function allCategories(): JsonResponse
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function byId(int $id): JsonResponse
    {
        if($this->checkAccessingWrongCategoryID($id)) {
            return response()->json([
                'data' => 'Trying access not existing ID',
            ],400);
        }

        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function goodsWithId(int $id): JsonResponse
    {
        if($this->checkAccessingWrongCategoryID($id)) {
            return response()->json([
                'data' => 'Trying to look goods from not existing ID\'s',
            ],400);
        }

        $goodsWithOneCategory = Goods::where('category_id', $id)->get();
        if($goodsWithOneCategory->count() > 0) {
            return response()->json($goodsWithOneCategory);
        } else {
            return response()->json(['message' => 'No goods with this ID']);
        }
    }

    public function checkAccessingWrongCategoryID(int $id): bool {
        $howManyIDs = Category::all()->count();
        if($howManyIDs < $id) {
            return true;
        }
        return false;
    }
}
