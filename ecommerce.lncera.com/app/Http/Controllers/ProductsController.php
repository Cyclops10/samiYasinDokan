<?php

namespace App\Http\Controllers;

use App\Category;
use App\Element;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
        $images=array();
        $validator = Validator::make(Input::all(), Product::rules(0));

//        print("<html><head></head><body><pre>".print_r(json_encode(Input::get('element'),JSON_PRETTY_PRINT),true)."</pre></body></html>");
        //echo 'sami1';

        if($validator->passes())
        {
            //echo 'sami2';
            if($request->hasFile('images'))
            {
                //echo 'sami3';
                $allowedfileExtension=['pdf','jpg','png','jpeg'];
                $files = $request->file('images');
                foreach($files as $file)
                {
                    //echo 'sami4';
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $check=in_array($extension,$allowedfileExtension);
                    if($check)
                    {
                        //echo 'sami5';
                        $filename = $file->store('public/images');
                        if(Storage::exists($filename))
                        {
                            //echo 'sami6';
                            array_push($images, substr($filename,7));
                            print("<html><head></head><body><pre>".print_r(json_encode($images,JSON_PRETTY_PRINT),true)."</pre></body></html>");
                            echo "Upload Successfully";
                        }
                        else
                        {
                            //echo 'sami7';
                            return Redirect::to(route('admin_product'))
                            ->with('message','Image Upload Failed')
                            ->withErrors($validator)
                            ->withInput();
                        }
                    }
                    else
                    {
                        return Redirect::to(route('admin_product'))
                            ->with('message','Invalid Extension')
                            ->withErrors($validator)
                            ->withInput();
                    }
                }
            }

            //echo 'sami8';
            $product = new Product();
            $product->name=Input::get('name');
            $product->cat_id=Input::get('cat_id');
            $product->desc=Input::get('desc');
            $product->price=Input::get('price');
            $product->quantity=Input::get('available');
            $product->element=json_encode(Input::get('element'),JSON_PRETTY_PRINT);
            $product->image=json_encode($images,JSON_PRETTY_PRINT);
            $product->save();

            //$product->elements()->attach(Input::get('subelement'));

            return Redirect::to(route('admin_product_list'))->with('message','Product Created');
        }
        return Redirect::to(route('admin_product'))
            ->with('message','Something went wrong')
            ->withErrors($validator)
            ->withInput();
    }

    public function proEditShow($id)
    {
        $product = Product::findOrFail($id);

        return view('common.product_edit')->with(['product'=>$product,'images'=>json_decode($product['image']),'elements'=>json_decode($product['element']),'categories' => Category::all()]);
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
            $product->element=json_encode(Input::get('element'),JSON_PRETTY_PRINT);
            $product->save();

            return Redirect::to(route('admin_product_edit_show',$id))->with('message','Category Updated');
        }

        return Redirect::to(route('admin_category_edit_show',$id))
            ->with('message','Something went wrong')
            ->withErrors($validator)
            ->withInput();
    }
}
