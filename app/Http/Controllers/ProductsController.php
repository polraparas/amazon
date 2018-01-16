<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use Validator;
use DB;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:admin');
    }
    
    public function index(){
        $products = Products::where('is_deleted',0)->get();
        if(!empty($products)) {
            return view('admin.product.productview',['products' => $products]);
        }
    	return view('admin.product.productview');
    }

    public function createProductView(){
    	return view('admin.product.createproductview');
    }

    public function createProduct(Request $request){
    	//Validate create product data
    	$validator = Validator::make($request->all(),[
    		'productname' => 'required',
    		'productamount' => 'required|numeric',
    		'producttype'=>'required|string',
    		'productimage'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    		'description'=> 'required'
    	]);
    	if($validator->fails()){
    		$errors = $validator->errors();
    		return redirect(route('product.create.view'))->withErrors($errors)->withInput();
    	}else {
    		$productname = $request->get('productname');
    		$productamount = $request->get('productamount');
    		$producttype = $request->get('producttype');
    		$description = $request->get('description');
    		
            $image = $request->file('productimage');
            $input['imagename'] = $productname.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/productimages');

    		$products = new Products();
    		$products->name = $productname;
    		$products->amount = $productamount;
    		$products->product_type = $producttype;
    		$products->product_image =  $input['imagename'];
    		$products->description = $description;
    		if($products->save()){
                 $image->move($destinationPath, $input['imagename']);
    			return redirect(route('product.create.view'))->with('success','Product created successfully.');
    		}else{
    			return redirect(route('product.create.view'))->withErrors('fail','Product not created.Try again!')->withInput($request->only($productname,$productamount,$producttype,$productimage,$description));
    		}
    	}
    }

    public function productDelete(Request $request){
    	$product_id = $request->get('product_id');
		if($product_id != NULL || strlen($product_id) != 0){
			$products = Products::where('product_id',$product_id)->first();
    	    $products->is_deleted = 1;
    	    $products->save();
            /*$delete_product_image = public_path('productimages/').$products->product_image;
            Storage::delete($delete_product_image);*/
            return redirect(route('product.view'));
		}	
    }

    public function editProduct(Request $request){
		$product_id = $request->get('product_id');
		$products = Products::where('product_id',$product_id)->where('is_deleted',0)->get();
		return response($products);
	}

	public function updateProduct(Request $request){
		$product_id = $request->get('product_id');
		$productname = $request->get('productname');
		$productamount = $request->get('productamount');
		$producttype = $request->get('producttype');
		$description = $request->get('description');

		$image = $request->file('productimage');
        if(!empty($image)){
            $input['imagename'] = $productname.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/productimages');
        }
      
        if(strlen($product_id)>0 && strlen($productname)>0 && strlen($productamount)>0 && strlen($producttype)>0  && strlen($description)>0 ){
            $products = Products::where('product_id',$product_id)->first();
            $products->name = $productname;
            $products->amount = $productamount;
            $products->product_type = $producttype;
            if(!empty($input['imagename'])){
                $products->product_image='';
                $products->product_image = $input['imagename'];
            }
            $products->description = $description;
            $products->save();
            if(!empty($input['imagename'])){
                 $image->move($destinationPath, $input['imagename']);
            }
            return response()->json(['response_code' => 1,'response_message'=>'Product updated successfully!']);
        }
		
        return response()->json(['response_code' => 0,'response_message'=>'Product updation fail!Something wrong!']);   
	}
}
