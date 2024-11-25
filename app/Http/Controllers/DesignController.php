<?php

namespace App\Http\Controllers;

use App\Models\Design;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Validator;
use JWTAuth;

class DesignController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return "ok";
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'tags' => 'required|string',
                'image' => 'required|image',
            ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        if ($request->hasFile('image')) {
            // Get the uploaded file
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/Storage/DesignImages/'), $fileName);
            $image = '/Storage/DesignImages/' . $fileName;
        }
        
        $userId = $authUser->id;
        $design = Design::create([
            'title' => $request->input('title'),
            'tags' => $request->input('tags'),
            'image' => $image,
            'user_id' => $userId
        ]);
        // return "ook";
        
        if (!$design) {
            return response()->json(['error' => 'Failed to create new Design.'], 500);
        }
        
        return response()->json(['Design' => $design], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
            $Design = Design::all();
            return response()->json(['Design' => $Design], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function index(request $request)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
            $userId = $authUser->id;
            $Design = Design::where('user_id', $userId)
            ->get();
            return response()->json(['Design' => $Design], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $authUser = JWTAuth::parseToken()->authenticate();
            $design = Design::find($id);
            if(!$design) {
                return response()->json(['design does not exist'], 401);
            }
            $result = $design->delete();
            if($result) {
                return response()->json(['design deleted']);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed.'. $e->getMessage()], 500);
        }
    }
}
