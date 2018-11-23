<?php

namespace App\Http\Controllers;

use App\Category;
use App\Element;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function productListView()
    {
        return view('common.product_list_view')->with(['products' => Product::with("categories")->get()]);
    }

    public function showForm()
    {
        return view('common.product')->with(['categories' => Category::all()]);
    }

    public function proCatElement()
    {

        $elements = Category::with('elements')->find(Input::get('data1'));
        $sub_element = new Element();
        foreach($elements['elements'] as $element)
        {
            $sub_element[$element->name]=$sub_element->where('parent_id',$element->id)->get();
        }
        return response()->json(["element"=>$elements['elements'],"subelement"=>$sub_element], 200);
    }

    public function proCreate(Request $request)
    {
        $validator = Validator::make(Input::all(), Product::rules(0));

        print("<html><head></head><body><pre>".print_r(json_encode(Input::get('element'),JSON_PRETTY_PRINT),true)."</pre></body></html>");

        if($validator->passes())
        {
            $product = new Product();
            $product->name=Input::get('name');
            $product->cat_id=Input::get('cat_id');
            $product->desc=Input::get('desc');
            $product->price=Input::get('price');
            $product->quantity=Input::get('available');
            $product->save();

            $product->elements()->attach(Input::get('subelement'));

            if($request->hasFile('images'))
            {
                $allowedfileExtension=['pdf','jpg','png','docx'];
                $files = $request->file('images');
                foreach($files as $file)
                {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $check=in_array($extension,$allowedfileExtension);
                    //dd($check);
                    if($check)
                    {

                      //  foreach ($request->images as $image) {
                            $filename = $file->store('images');
                            $products_images = new Image();
                            $products_images->pro_id=$product->id;
                            $products_images->type = 'product';
                            $products_images->file_path = $filename;
                            $products_images->save();
                       // }
                        echo "Upload Successfully";
                    }
                    else
                    {
                        /*return Redirect::to(route('admin_product'))
                            ->with('message','Invalid Extension')
                            ->withErrors($validator)
                            ->withInput();*/
                    }
                }
            }
            //return Redirect::to(route('admin_product'))->with('message','Product Created');
        }

        /*return Redirect::to(route('admin_product'))
            ->with('message','Something went wrong')
            ->withErrors($validator)
            ->withInput();*/
    }

    public function proEditShow($id)
    {
        $product = Product::all();
        $product = Product::findOrFail($id);

        return view('common.product_edit')->with(['product'=>$product,'categories' => Category::all()]);
    }

    public function proEdit($id)
    {
        $validator = Validator::make(Input::all(), Product::rules($id));

        if($validator->passes()) {
            $product = Product::findOrFail($id);

            $product->name = Input::get('name');
            $product->desc = Input::get('desc');
            $product->quantity = Input::get('available');
            $product->price = Input::get('price');
            $product->cat_id=Input::get('cat_id');
            $product->save();

            return Redirect::to(route('admin_product_edit_show',$id))->with('message','Category Updated');
        }

        return Redirect::to(route('admin_category_edit_show',$id))
            ->with('message','Something went wrong')
            ->withErrors($validator)
            ->withInput();
    }
}
