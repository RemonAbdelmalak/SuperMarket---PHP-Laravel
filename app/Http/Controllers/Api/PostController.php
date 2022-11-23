<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponseTrait;

    public function index(){

        $Products = PostResource::collection(Product::get());
        
        return $this->apiResponse($Products,'ok',200);

    }

    public function show($id){
        $Product = Product::find($id);

        if($Product){
            return $this->apiResponse(new PostResource($Product),'ok',200);
        }
        return $this->apiResponse(null,'Product not found',404);


    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'price' => 'required',
            'bio' => 'required',
        ]);

        if ($validator-> fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }
        
        
        
        $Products=Product::create($request->all());

        if($Products){
            return $this->apiResponse(new PostResource($Products),'Product saved',201);
        }
        return $this->apiResponse(null,'Product not saved',400);

    }

    public function update(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'price' => 'required',
            'bio' => 'required',
        ]);

        if ($validator-> fails()){
            return $this->apiResponse(null,$validator->errors(),400);
        }
        
        $Product = Product::find($id);
        if(!$Product){
            return $this->apiResponse(null,'Product not found',404);
        }
        $Product->update($request->all());

        if($Product){
            return $this->apiResponse(new PostResource($Product),'Product saved',201);
        }
        return $this->apiResponse(null,'Product not saved',400);
    }

    public function destroy($id){
       
        $Product = Product::find($id);
        
        if(!$Product){
            return $this->apiResponse(null,'Product not found',404);
        }

        $Product->delete($id);
        if($Product){
            return $this->apiResponse(null,'Product deleted',200);
        }
    }
}
