@extends('layouts.back')

@section('specific_page_vendor_css')

<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{URL::asset('back/vendor/select2/css/select2.css')}}" />
<link rel="stylesheet" href="{{URL::asset('back/vendor/select2-bootstrap-theme/select2-bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{URL::asset('back/vendor/datatables/media/css/dataTables.bootstrap4.css')}}" />

<link rel="stylesheet" href="{{URL::asset('back/vendor/jstree/themes/default/style.css')}}" />

@endsection

@section('content')

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Category</h2>

        <div class="right-wrapper text-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Layouts</span></li>
                <li><span>Dark Header</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <form id="summary-form" method="POST" action="{{ route('admin_category_edit',$category->id) }}" >
                {{ csrf_field() }}

                <section class="card">
                    <header class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                            <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                        </div>

                        <h2 class="card-title">Edit Category</h2>
                        <p class="card-subtitle">
                            Edit Category For the required product list with appropriate parent
                        </p>
                    </header>
                    <div class="card-body">
                        <div class="validation-message">
                            <ul @if($errors->any()) style="display:block" @endif >
                                @if ($errors->has('name')) <li><label id="name-error" class="error" for="name" style="">{{ $errors->first('name') }}</label></li>@endif
                                @if ($errors->has('desc')) <li><label id="desc-error" class="error" for="desc" style="">{{ $errors->first('desc') }}</label></li>@endif
                            </ul>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Name of The Category <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" title="Please enter a name." placeholder="eg.: Electronics" value="{{$category->name}}" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Description <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <textarea name="desc" rows="5" title="Your Description is too short." class="form-control" value="{{$category->desc}}" placeholder="Enter your description" required>{{$category->desc}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Parent Category</label>
                            <div class="col-sm-9">
                                <select id="parent_id" name="parent_id" data-plugin-selectTwo class="form-control populate" title="Please select a category">
                                    <option value="">Choose a Category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->id}}" @if($category->parent_id == $cat->id) selected @endif>{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">Select Element List</label>
                            <div class="col-lg-9">
                                <select id="element_list" name="element_list[]" multiple data-plugin-selectTwo class="form-control populate placeholder" data-plugin-options='{ "placeholder": "Select One or More Element", "allowClear": true }'>
                                    @foreach($elements as $element)
                                        <option value="{{$element->id}}" @if(in_array($element->id,$element_list)) selected @endif>{{$element->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <button class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </footer>
                </section>
            </form>
        </div>

    </div>
    <!-- end: page -->
</section>

@endsection

@section('specific_page_vendor_js')
        <!-- Specific Page Vendor -->

        <script src="{{URL::asset('back/vendor/jquery-validation/jquery.validate.js')}}"></script>

		<script src="{{URL::asset('back/vendor/select2/js/select2.js')}}"></script>
		<script src="{{URL::asset('back/vendor/datatables/media/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{URL::asset('back/vendor/datatables/media/js/dataTables.bootstrap4.min.js')}}"></script>
		<script src="{{URL::asset('back/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js')}}"></script>
		<script src="{{URL::asset('back/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js')}}"></script>
		<script src="{{URL::asset('back/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js')}}"></script>
		<script src="{{URL::asset('back/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js')}}"></script>
		<script src="{{URL::asset('back/vendor/datatables/extras/TableTools/JSZip-2.5.0//jszip.min.js')}}"></script>
		<script src="{{URL::asset('back/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js')}}"></script>
		<script src="{{URL::asset('back/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js')}}"></script>

		<script src="{{URL::asset('back/vendor/jstree/jstree.js')}}"></script>


@endsection

@section('example')
    <!-- Examples -->
    <script src="{{URL::asset('back/js/examples/examples.datatables.default.js')}}"></script>
    <script src="{{URL::asset('back/js/examples/examples.datatables.row.with.details.js')}}"></script>
    <script src="{{URL::asset('back/js/examples/examples.datatables.tabletools.js')}}"></script>

    <script src="{{URL::asset('back/js/examples/examples.validation.js')}}"></script>

    <script src="{{URL::asset('back/js/examples/examples.treeview.js')}}"></script>
@endsection