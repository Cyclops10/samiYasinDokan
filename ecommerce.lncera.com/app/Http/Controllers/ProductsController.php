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
use ImageProcess;

class ProductsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function frontSingleProductView($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::findOrFail($product->cat_id);
        return view('product')->with(['product' => $product,'category'=>$category->getParentsAttribute()]);
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

        if($validator->passes())
        {
            if($request->hasFile('images'))
            {
                $allowedFileExtension=['jpg','png','jpeg'];
                $files = $request->file('images');
                foreach($files as $file)
                {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $check=in_array($extension,$allowedFileExtension);
                    if($check)
                    {
                        echo 'sami1';
                        $processImage350 = ImageProcess::make($file);
                        $processImage500 = ImageProcess::make($file);
                        $processImage66 = ImageProcess::make($file);

                        $processImage350->encode('png');
                        $processImage350->resize(350,350);
                        if($processImage350->save(storage_path('app').'/public/images/350x350_'.$filename))
                        {
                            echo 'sami23';
                            array_push($images, "images/350x350_".$filename);
                        }

                        $processImage500->encode('png');
                        $processImage500->resize(500,500);
                        if($processImage500->save(storage_path('app').'/public/images/500x500_'.$filename))
                        {
                            echo 'sami33';
                            array_push($images, "images/500x500_".$filename);
                        }

                        $processImage66->encode('png');
                        $processImage66->resize(66,66);
                        if($processImage66->save(storage_path('app').'/public/images/66x66_'.$filename))
                        {
                            echo 'sami34';
                            array_push($images, "images/66x66_".$filename);
                        }
                    }
                    else
                    {
                        echo 'sami4';
                        return Redirect::to(route('admin_product'))
                            ->with('message','Invalid Extension')
                            ->withErrors($validator)
                            ->withInput();
                    }
                }
            }

            $product = new Product();
            $product->name=Input::get('name');
            $product->cat_id=Input::get('cat_id');
            $product->desc=Input::get('desc');
            $product->price=Input::get('price');
            $product->quantity=Input::get('available');
            $product->element=json_encode(Input::get('element'),JSON_PRETTY_PRINT);
            $product->image=json_encode($images,JSON_PRETTY_PRINT);
            $product->save();

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

    public function proEdit(Request $request, $id)
    {
        $images=array();
        $product = Product::findOrFail($id);
        $server_image = json_decode($product->image);

        $validator = Validator::make(Input::all(), Product::rules($id));

        if($validator->passes()) {

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
                            array_push($server_image, substr($filename,7));
//                            print("<html><head></head><body><pre>".print_r(json_encode($images,JSON_PRETTY_PRINT),true)."</pre></body></html>");
//                            echo "Upload Successfully";
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


            $product->name = Input::get('name');
            $product->desc = Input::get('desc');
            $product->quantity = Input::get('available');
            $product->price = Input::get('price');
            $product->cat_id=Input::get('cat_id');
            $product->element=json_encode(Input::get('element'),JSON_PRETTY_PRINT);
//            print("<html><head></head><body><pre>".print_r($server_image,true)."</pre></body></html>");
            $product->image=json_encode($server_image,JSON_PRETTY_PRINT);
            $product->save();

            return Redirect::to(route('admin_product_edit_show',$id))->with('message','Category Updated');
        }

        return Redirect::to(route('admin_category_edit_show',$id))
            ->with('message','Something went wrong')
            ->withErrors($validator)
            ->withInput();
    }

    public function proDestroy($id)
    {
        $product = Product::find($id);

        if($product)
        {
            $images = json_decode($product->image);
            foreach($images as $image)
            {
                Storage::delete('/public/'.$image);
            }

            $product->delete();
            return Redirect::to('admin/product')->with('message','Product Deleted');
        }

        return Redirect::to('admin/product')->with('message','Something went wrong, Please try again ');
    }

    public function proImageDestroy($id,$imgId)
    {
        $product = Product::find($id);

        if($product)
        {
            $image = json_decode($product->image);
            Storage::delete('/public/'.$image[$imgId]);
            array_splice($image, $imgId, 1);

            $product->image=json_encode($image,JSON_PRETTY_PRINT);
            $product->save();

            return Redirect::to(route('admin_product_edit_show',$product->id))->with('message','Product Deleted');
        }

        return Redirect::to(route('admin_product_edit_show',$id))->with('message','Something went wrong, Please try again ');
    }
}
