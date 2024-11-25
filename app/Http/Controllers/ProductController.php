<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attributes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use JWTAuth;
use DB;

class ProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or not provided'], 401);
        }

        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'images.*' => 'image',
            'size' => 'required|array',
            'side' => 'required|string',
            'price' => 'required|numeric',
            'material' => 'required|array',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'attributes' => 'nullable|array',
            'attributes.*.name' => 'required_with:attributes|string',
            'attributes.*.value' => 'required_with:attributes|array',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        DB::beginTransaction();
        
        try {
            // Create the product
            $product = Product::create([
                'name' => $request->input('name'),
                'side' => $request->input('side'),
                'price' => $request->input('price'),
                'size' => json_encode($request->input('size')), 
                'material' => json_encode($request->input('material')),
                'category_id' => $request->input('category_id'),
                'subcategory_id' => $request->input('subcategory_id'),
            ]);

            // Handling image upload
            if($request->hasFile('images')) {
                $images = $request->file('images');
                $imagePaths = [];
                
                foreach ($images as $image) {
                    // Generate a unique name for the image and store it
                    $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/Storage/ProductImages/'), $fileName);
                    $imagePaths[] = '/Storage/ProductImages/' . $fileName;
                }
                
                // Optionally: Save image paths to the product or another table
                $product->update(['images' => json_encode($imagePaths)]);
            } else {
                $images = "null";
            }
            
            
            // Handle attributes if provided
            if ($request->has('attributes')) {
                $attributes = $request->input('attributes');
                foreach ($attributes as $attributeData) {
                    Attributes::create([
                        'product_id' => $product->id,
                        'name' => $attributeData['name'],
                        'value' => json_encode($attributeData['value']),
                    ]);
                }
            }
    
            DB::commit();
            
            // Load product with attributes to include in the response
            $product->load('attributes');
            $product->load('category');
    
            return response()->json(['product' => $product], 200);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create product.'. $e->getMessage()], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        try {
            $products = Product::with('attributes', 'category', 'subcategory')->get();        
            return response()->json(['Products' => $products], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to show products.'. $e->getMessage()], 500);
        }
    }

    /**
     * Display the single resource.
     */
    public function index($id)
    {
        try {
            $product = Product::with('attributes', 'category')->find($id);
            if($product == Null) {
                return response()->json(['No Products Found'], 401);
            }
            return response()->json(['Products' => $product], 200);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
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
            'name' => 'string',
            'images.*' => 'image',  // Validating new images
            'previous_images.*' => 'string', // Validating previous image addresses
            'size' => 'array',
            'side' => 'string',
            'price' => 'numeric',
            'material' => 'array',
            'category_id' => 'integer',
            'subcategory_id' => 'integer',
            'attributes' => 'array',
            'attributes.*.name' => 'required_with:attributes|string',
            'attributes.*.value' => 'required_with:attributes|array',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        DB::beginTransaction();
        
        try {
            $product = Product::findOrFail($id);
    
            // Update product details if provided
            $product->update([
                'name' => $request->input('name', $product->name),
                'size' => json_encode($request->input('size', json_decode($product->size, true))),
                'side' => $request->input('side', $product->side),
                'price' => $request->input('price', $product->price),
                'material' => json_encode($request->input('material', json_decode($product->material, true))),
                'category_id' => $request->input('category_id', $product->category_id),
                'subcategory_id' => $request->input('subcategory_id', $product->subcategory_id),
            ]);
    
            // Handle previous images address update
            if ($request->has('previous_images')) {
                $updatedImagePaths = $request->input('previous_images');
                // Replace existing images with the updated paths
                $product->update(['images' => json_encode(array_values($updatedImagePaths))]);
            }
    
            // Handle new image uploads
            if ($request->hasFile('images')) {
                // Process the uploaded images
                $newImagePaths = [];
                $images = $request->file('images');
    
                foreach ($images as $image) {
                    $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/Storage/ProductImages/'), $fileName);
                    $newImagePaths[] = '/Storage/ProductImages/' . $fileName;
                }
    
                // Merge existing images with newly uploaded images
                $existingImages = json_decode($product->images, true) ?? [];
                $product->update(['images' => json_encode(array_merge($existingImages, $newImagePaths))]);
            }
    
            // Handle attributes
            if ($request->has('attributes')) {
                Attributes::where('product_id', $product->id)->delete();
                foreach ($request->input('attributes') as $attributeData) {
                    Attributes::create([
                        'product_id' => $product->id,
                        'name' => $attributeData['name'],
                        'value' => json_encode($attributeData['value']),
                    ]);
                }
            }
    
            DB::commit();
    
            // Load product with attributes to include in the response
            $product->load('attributes');
            return response()->json(['product' => $product], 200);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to update product. ' . $e->getMessage()], 500);
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
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        DB::beginTransaction();
        
        try {
            $product->attributes()->delete();
            if ($product->images) {
                $imagePaths = json_decode($product->images);
                foreach ($imagePaths as $imagePath) {
                    $imageFullPath = public_path($imagePath);
                    if (File::exists($imageFullPath)) {
                        File::delete($imageFullPath);
                    }
                }
            }
            $product->delete();
            DB::commit();
            return response()->json(['message' => 'Product and related data deleted successfully.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }

    public function searchProduct(request $request) 
    {
        try {
            $keyword = $request->input("keyword");
            $categoryIds = Category::where("name", "like", "%" . $keyword . "%")->pluck('id');
            // return "ok";
            $productIdsFromCategoryIds= Product::whereIn("category_id", $categoryIds)->pluck('id');
            $productIdsFromKeywords = Product::where(function ($query) use ($keyword) {
                $query->where("name", "like", "%" . $keyword . "%");
            })->pluck('id');
            $mergedIds = $productIdsFromKeywords->merge($productIdsFromCategoryIds)->unique();
            $searchedProducts = [];
            foreach ($mergedIds as $productId) {
                $product = Product::find($productId);
                $product->load('attributes', 'category');
                $searchedProducts[] = array_merge($product->toArray());
            }
            if (empty($searchedProducts)) {
                return response()->json(['message' => 'No Products Found based on your search']);
            }
            return response()->json(['Search Products' => $searchedProducts], 200);    
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }
}    
