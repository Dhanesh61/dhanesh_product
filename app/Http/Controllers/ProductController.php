<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('verified');
    //     $this->middleware('admin.role')->only('index'); 
    // }
    
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');

        $products = Product::orderBy($sortBy, $sortOrder)->paginate(10);

        return view('index', compact('products', 'sortOrder','sortBy'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', '%' . $query . '%')->paginate(10);
        $sortOrder = $request->get('sort_order', 'asc');
        $sortBy = $request->get('sort_by', 'asc');
        return view('index', ['products' => $products, 'sortOrder' => $sortOrder, 'sortBy' => $sortBy]);
    }

    public function bulkDelete(Request $request)
    {
        $productIds = $request->input('selected_products');
        if ($productIds) {
            Product::whereIn('id', $productIds)->delete();
        }
        return redirect()->route('product.index');
    }

    Public function order(){
        return view('order');
    }

    public function dash(){
        return view('/dash');
    }
    
        public function create(){
            return view('/create');
        }
    
        public function store(Request $request){
            //validate data
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif|max:1000'
                ], [
                        'name.required' => '**The name field is required.',
                        'description.required' => '**The description field is required.',
                        'price.required' => '**The price filed is required.',
                        'image.required' => '**The image field is required.',
                ]);
                
                //upload image
                $imageName = time().'.'.$request->image->extension();
               
            $request->image->move(public_path('img'),$imageName);
    
            $product = new Product;
            $product->image = $imageName;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price ?? 0;
    
            $product->save();
             return redirect()->route('product.index')->withSuccess('Product Created');
        }
        public function edit($id){
            //dd($id);
            $product = Product::where('id',$id)->first();
            return view('edit',['product'=>$product]);
        }
     
        public function update(Request $request, $id){
          // dd($request->all());
           $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:1000'
            ], [
                    'name.required' => '**The name field is required.',
                    'description.required' => '**The description field is required.',
                    'price.required' => '**The price filed is required.',
                    // 'image.required' => '**The image field is required.',
            ]);
            
            $product = Product::where('id',$id)->first();
    
            if(isset($request->image)){
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('img'),$imageName);
                $product->image = $imageName;
            }
                    
       
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
       
    
        $product->save();
        return redirect()->route('product.index')->withSuccess('Product Updated');
    
        }
    
        public function delete($id){
            $product = Product::findOrFail($id);

            // Delete the image file if it exists
            $imagePath = public_path('img') . '/' . $product->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $product->delete();
            return back()->withSuccess('Product Deleted');
        }
}
