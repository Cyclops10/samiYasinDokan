<?php

namespace App\Http\Controllers;

use App\Category;
use App\Element;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('common.category')->with(['categories'=>Category::all(),'elements'=>Element::whereNull('parent_id')->get()]);
    }

    public function catCreate()
    {
        $validator = Validator::make(Input::all(), Category::rules(0));

        if($validator->passes())
        {
            $category = new Category;
            $category->name=Input::get('name');
            $category->desc=Input::get('desc');
            $category->parent_id=Input::get('parent_id');
            $category->save();

            $category->elements()->attach(Input::get('element_list'));

            return Redirect::to(route('admin_category'))->with('message','Category Created');
        }

        return Redirect::to(route('admin_category'))
            ->with('message','Something went wrong')
            ->withErrors($validator)
            ->withInput();
    }

    public function catEditShow($id)
    {
        $categories = Category::all();
        $category = Category::findOrFail($id);
        $element_list=$category->elements()->where('cat_id',$id)->get(['element_id']);
        $i=0;
        $ele_all=array();
        foreach($element_list as $ele)
            $ele_all[$i++]=$ele->element_id;

        return view('common.category_edit')->with(['categories'=>$categories,'category'=>$category,'elements'=>Element::whereNull('parent_id')->get(),'element_list'=>$ele_all]);
    }

    public function catEdit($id)
    {
        $validator = Validator::make(Input::all(), Category::rules($id));

        if($validator->passes()) {
            $category = Category::findOrFail($id);

            $category->name = Input::get('name');
            $category->desc = Input::get('desc');
            $category->parent_id = Input::get('parent_id');
            $category->save();

            $category->elements()->detach();
            $category->elements()->attach(Input::get('element_list'));

            return Redirect::to(route('admin_category_edit_show',$id))->with('message','Category Updated');
        }

        return Redirect::to(route('admin_category_edit_show',$id))
            ->with('message','Something went wrong')
            ->withErrors($validator)
            ->withInput();
    }

    public function catDestroy($id)
    {
        $category = Category::find($id);

        if($category)
        {
            $category->delete();
            return Redirect::to('admin/category')->with('message','Category Deleted');
        }

        return Redirect::to('admin/category')->with('message','Something went wrong, Please try again ');
    }

}
