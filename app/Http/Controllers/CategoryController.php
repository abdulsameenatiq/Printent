<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Validator;
use JWTAuth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show()
    {
        $categories = Category::with('subcategories')->get();
        return response()->json(['categories' => $categories], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or not provided'], 401);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|image',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        if ($request->hasFile('image')) {
            // Get the uploaded file
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/Storage/CategoryImages/'), $fileName);
            $image = '/Storage/CategoryImages/' . $fileName;
        }
        
        // return "ok";
        $category = Category::create([
            'name' => $request->input('name'),
            'image' => $image,
        ]);
        
        if (!$category) {
            return response()->json(['error' => 'Failed to create new Category.'], 500);
        }

        return response()->json(['category' => $category], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or not provided'], 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string',
            'image' => 'sometimes|image',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found.'], 404);
        }

        if ($request->hasFile('image')) {
            if ($category->image && File::exists(public_path($category->image))) {
                File::delete(public_path($category->image));
            }

            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/Storage/CategoryImages/'), $fileName);
            $image = '/Storage/CategoryImages/' . $fileName;
        }

        $category->image = $image;
        if ($request->has('name')) {
            $category->name = $request->input('name');
        }

        $category->save();

        return response()->json(['category' => $category], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or not provided'], 401);
        }
        $Category = Category::find($id);
        if(!$Category) {
            return response()->json(['Category does not exist'], 401);
        }
        $result = $Category->delete();
        if($result) {
            return response()->json(['Category deleted']);
        }
    }

    public function CategoryProducts($id) 
    {
        $category = Category::with('products.attributes')->find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        return response()->json([
            'category' => $category->name,
            'products' => $category->products
        ]);
    }
}
