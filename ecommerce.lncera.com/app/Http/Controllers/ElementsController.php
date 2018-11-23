<?php

namespace App\Http\Controllers;

use App\Element;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ElementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('common.element')->with('elements',Element::all());
    }

    public function eleCreate()
    {
        $validator = Validator::make(Input::all(), Element::rules(0));

        if($validator->passes())
        {
            $category = new Element();
            $category->name=Input::get('name');
            $category->desc=Input::get('desc');
            $category->parent_id=Input::get('parent_id');
            $category->save();

            return Redirect::to(route('admin_element'))->with('message','Element Created');
        }

        return Redirect::to(route('admin_element'))
            ->with('message','Something went wrong')
            ->withErrors($validator)
            ->withInput();
    }

    public function eleEditShow($id)
    {
        $elements = Element::all();
        $element = Element::findOrFail($id);

        return view('common.element_edit')->with(['elements'=>$elements,'element'=>$element]);
    }

    public function eleEdit($id)
    {
        $validator = Validator::make(Input::all(), Element::rules($id));

        if($validator->passes()) {
            $element = Element::findOrFail($id);

            $element->name = Input::get('name');
            $element->desc = Input::get('desc');
            $element->parent_id = Input::get('parent_id');
            $element->save();

            return redirect('admin/element');
        }

        return Redirect::to(route('admin_element_edit_show',$id))
            ->with('message','Something went wrong')
            ->withErrors($validator)
            ->withInput();
    }

    public function eleDestroy($id)
    {
        $element = Element::find($id);

        if($element)
        {
            $element->delete();
            return Redirect::to('admin/element')->with('message','Element Deleted');
        }

        return Redirect::to('admin/element')->with('message','Something went wrong, Please try again ');
    }
}
