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
        <h2>Element</h2>

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
            <form id="summary-form" method="POST" action="{{ route('admin_element_post') }}" >
                {{ csrf_field() }}

                <section class="card">
                    <header class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                            <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                        </div>

                        <h2 class="card-title">Add Element</h2>
                        <p class="card-subtitle">
                            Add Element For the required product list with appropriate parent
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
                            <label class="col-sm-3 control-label text-sm-right pt-2">Name of The Element <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" title="Please enter a name." placeholder="eg.: Size" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Description <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <textarea name="desc" rows="5" title="Your Description is too short." class="form-control" placeholder="Enter your description" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Parent Element</label>
                            <div class="col-sm-9">
                                <select id="parent_id" name="parent_id" data-plugin-selectTwo class="form-control populate" title="Please select a element">
                                    <option value="">Choose a Element</option>
                                    @foreach($elements as $element)
                                        @if(is_null($element->parent_id))
                                            <option value="{{$element->id}}">{{$element->name}}</option>
                                        @endif
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
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                    </div>

                    <h2 class="card-title">Element List</h2>
                </header>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped mb-0" id="datatable-default">
                        <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Name</th>
                                <th>Details</th>
                                <th>Parent</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($elements as $element)

                            <tr>
                                <td>{{$element->id}}</td>
                                <td>{{$element->name}}</td>
                                <td>{{$element->desc}}</td>
                                <td>@if($element->parent){{$element->parent['name']}} @else --- @endif</td>
                                <td class="actions-hover actions-fade">
                                    <a href="{{route('admin_element_edit_show',$element->id)}}"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('admin_element_delete',$element->id)}}" class="delete-row"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
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