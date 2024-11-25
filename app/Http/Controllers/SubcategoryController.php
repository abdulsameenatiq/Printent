<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Validator;
use JWTAuth;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function SubCategoryProducts($id)
    {
        try {

            $subcategory = SubCategory::with('products.attributes')->find($id);
        } catch (\Exception $e) {           
            return response()->json(['error' => 'Failed to create SubCategory: ' . $e->getMessage()], 500);
        }
        if (!$subcategory) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        return response()->json([
            'Subcategory' => $subcategory->name,
            'products' => $subcategory->products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or not provided'], 401);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'sometimes|image',
            'category_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        if ($request->hasFile('image')) {
            // Get the uploaded file
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/Storage/SubCategoryImages/'), $fileName);
            $image = '/Storage/SubCategoryImages/' . $fileName;
        } else {
            $image = null;
        }
        // return $request;
        
        try {
            $subcategory = SubCategory::create([
                'category_id' => $request->input('category_id'),
                'name' => $request->input('name'),
                'image' => $image,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create SubCategory: ' . $e->getMessage()], 500);
        }
        
        if (!$subcategory) {
            return response()->json(['error' => 'Failed to create new Sub Category.'], 500);
        }

        return response()->json(['Subcategory' => $subcategory], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        try {
            $subcategories = SubCategory::with('category')->get();
            return response()->json(['subcategories' => $subcategories], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to show products.'. $e->getMessage()], 500);
        }
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
        $subCategory = SubCategory::find($id);
        if(!$subCategory) {
            return response()->json(['subCategory does not exist'], 401);
        }
        $result = $subCategory->delete();
        if($result) {
            return response()->json(['subCategory deleted']);
        }
    }

    public function getSubcategoriesByCategory($id)
    {
        $subCategory = SubCategory::where('category_id', $id)->get();
        if(!$subCategory) {
            return response()->json(['subCategory does not exist'], 401);
        }
        if($subCategory) {
            return response()->json(['subcategories' => $subCategory], 200);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error'=>'Token is invalid or not provided']);
        }

        $validator = Validator::make($request->all(), [
            'name'=>'sometimes|string',
            'image'=>'sometimes|image',
            'category_id' =>'sometimes|integer'
        ]);

        
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $subCategory = SubCategory::find($id);
        
        if(!$subCategory) {
            return response()->json(['error'=>'Sub category not found']);
        }
        
        // return 'ok';
        if($request->hasFile('image')) {
            if ($subCategory->image && File::exists(public_path($subCategory->image))) {
                File::delete(public_path($subCategory->image));
            }
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/Storage/SubCategoryImages/'), $fileName);
            $image = '/Storage/SubCategoryImages/' . $fileName;
        }

        $subCategory->image = $image;
        if ($request->has('name')) {
            $subCategory->name = $request->input('name');
        }
        if ($request->has('catgory_id')) {
            $subCategory->category_id = $request->input('category_id');
        }
        $subCategory->save();
        return response()->json(['category'=>$subCategory], 200);

    }
}
