@extends('layouts.back')

@section('specific_page_vendor_css')

<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="{{URL::asset('back/vendor/select2/css/select2.css')}}" />
<link rel="stylesheet" href="{{URL::asset('back/vendor/select2-bootstrap-theme/select2-bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{URL::asset('back/vendor/datatables/media/css/dataTables.bootstrap4.css')}}" />

<link rel="stylesheet" href="{{URL::asset('back/vendor/jstree/themes/default/style.css')}}" />

<link rel="stylesheet" href="{{URL::asset('back/vendor/owl.carousel/assets/owl.carousel.css')}}" />
<link rel="stylesheet" href="{{URL::asset('back/vendor/owl.carousel/assets/owl.theme.default.css')}}" />

<link rel="stylesheet" href="{{URL::asset('back/vendor/magnific-popup/magnific-popup.css')}}" />

@endsection

@section('content')

<section role="main" class="content-body">
    <header class="page-header">
        <h2>Product Edit #{{$product->id}}</h2>

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
            <form id="summary-form" method="POST" action="{{ route('admin_product_edit',$product->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <section class="card">
                    <header class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                            <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                        </div>

                        <h2 class="card-title">Product Basic Information</h2>
                        <p class="card-subtitle">
                            Add Product Basic Information
                        </p>
                    </header>
                    <div class="card-body">
                        <div class="validation-message">
                            <ul @if($errors->any()) style="display:block" @endif >
                                @if ($errors->has('name')) <li><label id="name-error" class="error" for="name" style="">{{ $errors->first('name') }}</label></li>@endif
                                @if ($errors->has('desc')) <li><label id="desc-error" class="error" for="desc" style="">{{ $errors->first('desc') }}</label></li>@endif
                                @if ($errors->has('images')) <li><label id="images-error" class="error" for="images" style="">{{ $errors->first('images') }}</label></li>@endif
                            </ul>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Name of The Product <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="name"  value="{{ $product->name }}" class="form-control" title="Please enter a name." placeholder="Ex.: White Samsung Mobile A9" required="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2" for="textareaAutosize">Product Details<span class="required">*</span></label>
                            <div class="col-lg-9">
                                <textarea class="form-control" rows="3" id="textareaAutosize" name="desc" data-plugin-textarea-autosize>{{ $product->desc }}</textarea>
                            </div>
                        </div>

                        @if(!empty($images))
                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2" for="textareaAutosize">Existing Image <span class="required">*</span></label>
                            <div class="col-lg-9">
                                <div class="gallery">
                                <?php $i=0;?>
                                @foreach($images as $image)
                                    <div class="img-wrap">
                                        <span class="closex"><a href="{{ route('admin_product_image_delete',[$product->id,$i++]) }}" title="Delete"><i class="fa fa-trash-o"></i></a></span>
                                        <a class="image-popup-no-margins" href="{{asset('storage/'.$image)}}">
                                            <img src="{{asset('storage/'.$image)}}" class="img-fluid img-thumbnail" style="width: 74px; height: 74px;">
                                        </a>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-lg-3 control-label text-lg-right pt-2">Product Image</label>
                            <div class="col-lg-9">
                                <input type="file" clsss="form-control" name="images[]" id="images" multiple required>
                            </div>
                            <div class="col-lg-9 offset-md-3">
                                <div class="gallery" id="images_preview"></div>
                            </div>
                        </div>

                        <script>
                            $("#images").on('change', function () {

                                //Get count of selected files
                                var countFiles = $(this)[0].files.length;
                                var imgPath = $(this)[0].value;
                                var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                                var image_holder = $("#images_preview");
                                image_holder.empty();

                                if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                                    if (typeof (FileReader) != "undefined") {
                                        //loop for each file selected for uploaded.
                                        for (var i = 0; i < countFiles; i++)
                                        {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                $("<img />", {
                                                    "src": e.target.result,
                                                    "class": "img-thumbnail",
                                                    "width": "74px",
                                                    "height": "74px"
                                                }).appendTo(image_holder);
                                            }
                                            image_holder.show();
                                            reader.readAsDataURL($(this)[0].files[i]);
                                        }
                                    } else {
                                        alert("This browser does not support FileReader.");
                                    }
                                } else {
                                    alert("Pls select only images");
                                }
                            });
                        </script>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Availability of The Product <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="available"  value="{{ $product->quantity }}" class="form-control" title="Please enter a quantity." placeholder="Ex.: 500" required="">
                            </div>
                        </div>
                    </div>
                    <header class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                            <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                        </div>

                        <h2 class="card-title">Product Price Information</h2>
                        <p class="card-subtitle">
                            Add Product Price Information
                        </p>
                    </header>
                    <div class="card-body">
                        <div class="validation-message">
                            <ul @if($errors->any()) style="display:block" @endif >
                                @if ($errors->has('price')) <li><label id="price-error" class="error" for="price" style="">{{ $errors->first('price') }}</label></li>@endif
                            </ul>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Price of The Product <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="price"  value="{{ $product->price }}" class="form-control" title="Please enter a price." placeholder="Ex.: 500" required="">
                            </div>
                        </div>
                    </div>
                    <header class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                            <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                        </div>

                        <h2 class="card-title">Product Category</h2>
                        <p class="card-subtitle">
                            Add Product Category that is suitable with Product
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
                            <label class="col-sm-3 control-label text-sm-right pt-2">Category Select<span class="required">*</span></label>
                            <div class="col-sm-9">
                                <select id="category_id" name="cat_id" data-plugin-selectTwo class="form-control populate placeholder" title="Please select a category">
                                    <option value="">Choose a Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($product->cat_id==$category->id) {{'selected'}} @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <header class="card-header" id="header_element">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                            <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                        </div>

                        <h2 class="card-title">Product Element</h2>
                        <p class="card-subtitle">
                            Add Product Element that is suitable with Product
                        </p>
                    </header>
                    <div class="card-body" id="body_element">
                        <div class="validation-message">
                            <ul @if($errors->any()) style="display:block" @endif >
                                @if ($errors->has('name')) <li><label id="name-error" class="error" for="name" style="">{{ $errors->first('name') }}</label></li>@endif
                                @if ($errors->has('desc')) <li><label id="desc-error" class="error" for="desc" style="">{{ $errors->first('desc') }}</label></li>@endif
                            </ul>
                        </div>

                        <div class="form-group row element_form">
                        <?php
                            $i=0;
                        ?>
                            @foreach($elements as $element)
                                <div class="row col-md-12 spec_element" data-book-index="{{$i++}}">
                                    <div class="col-md-11">
                                        <section class="card card-featured single_element mb-12">
                                            <header class="card-header">
                                                <input type="text" name="element[0][name]" value="{{$element->name}}" class="form-control element_name" title="Please enter a Field Name." placeholder="Ex.: Color" required="">
                                            </header>
                                            <?php $j=0;?>
                                            @foreach(array_combine($element->value, $element->quan) as $value => $quan)
                                                <?php $j++;?>
                                                <div class="card-body @if($j!=1){{"single"}} @endif row">
                                                    <div class="col-sm-4">
                                                        <input type="text" name="element[0][value][]" value="{{$value}}" class="form-control element_value" title="Please enter a Field Value." placeholder="Ex.: Red" required="">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" name="element[0][quan][]" value="{{$quan}}" class="form-control element_quan" title="Please enter a Field Quantity." placeholder="Ex.: 10" required="">
                                                    </div>
                                                    @if($j==1)
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-default maddButton"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                    @elseif($j!=1)
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-default mremoveButton"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </section>
                                    </div>
                                    @if($i==1)
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                                    </div>
                                    @elseif($i!=1)
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                                    </div>
                                    @endif
                                </div>
                            @endforeach

                        </div>

                        <!-- Template-->
                        <div class="row col-md-12 spec_element hidden" id="template_element" data-book-index="-1">
                            <div class="col-md-11">
                                <section class="card card-featured single_element mb-12">
                                    <header class="card-header">
                                        <input type="text" name="element[0][name]" class="form-control element_name" title="Please enter a Field Name." placeholder="Ex.: Color" required="" disabled="disabled">
                                    </header>
                                    <div class="card-body row">
                                        <div class="col-sm-4">
                                            <input type="text" name="element[0][value][]" class="form-control element_value" title="Please enter a Field Value." placeholder="Ex.: Red" required="" disabled="disabled">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="text" name="element[0][quan][]" class="form-control element_quan" title="Please enter a Field Quantity." placeholder="Ex.: 10" required="" disabled="disabled">
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn btn-default maddButton"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <div class="col-md-1">
                                <button type="button" class="btn btn-default removeButton" ><i class="fa fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="card-body single row hidden" id="m_template_element">
                            <div class="col-sm-4">
                                <input type="text" name="element[0][value][]" class="form-control element_value" title="Please enter a Field Value." placeholder="Ex.: Red" required="" disabled="disabled">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" name="element[0][quan][]" class="form-control element_quan" title="Please enter a Field Quantity." placeholder="Ex.: 10" required="" disabled="disabled">
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-default mremoveButton"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>

                    </div>
                    <script>
                    jQuery(document).ready(function() {

                        function reFreshIndex()
                        {
                            var father,child;
                            var total = parseInt(jQuery(".spec_element:not('.hidden')").length);
                            console.log("toatla="+total);
                            for(var i=1;i<=total;i++)
                            {
                                father=jQuery(".spec_element:nth-of-type("+i+"):not('.hidden')");
                                var l=father.attr("data-book-index");
                                console.log("father="+l);

                                var childCount=jQuery(father).find(".element_value").length;
                                console.log("childcount="+childCount);

                                jQuery(father).find(".element_name:eq("+0+")").attr("name","element["+(i-1)+"][name]");
                                jQuery(father).find(".element_name:eq("+0+")").removeAttr("disabled");
                                for(var j=0;j<=childCount;j++)
                                {
                                    jQuery(father).find(".element_value:eq("+j+")").attr("name","element["+(i-1)+"][value][]");
                                    jQuery(father).find(".element_value:eq("+j+")").removeAttr("disabled");
                                    jQuery(father).find(".element_quan:eq("+j+")").attr("name","element["+(i-1)+"][quan][]");
                                    jQuery(father).find(".element_quan:eq("+j+")").removeAttr("disabled");
                                    child= jQuery(father).find(".element_value:eq("+j+")").attr("name");
                                    console.log("child="+child);
                                }
                            }
                        }

                        reFreshIndex();
                        //var index = 0,mIndex = 0;
                        var index = jQuery(this).parents('.element_form').children('.spec_element').length;
                        console.log("start click event : index : "+index);

                        jQuery('#summary-form')
                            // Add button click handler
                            .on('click', '.addButton', function()
                            {
                                index++;
                                var $template = jQuery('#template_element'),
                                    $clone    = $template
                                        .clone()
                                        .removeClass('hidden')
                                        .removeAttr('id')
                                        .attr('data-book-index', index)
                                        .appendTo(".element_form");

                                // Update the name attributes

                                var len = jQuery(this).parents('.single_element').children('.card-body').length;
                                console.log(len);
                                console.log("sami "+jQuery(this).parents('.single_element .card-body').index());
                                var tag_index=$clone.attr('data-book-index');
                                $clone.find('[name="element[0][]"]').attr('name', 'element['+tag_index+']['+(len)+'][]').end();
                                $clone.find('[name="element[0][]"]').attr('name', 'element['+tag_index+']['+(len)+'][]').end();
                                var total=jQuery('input[name*="eelement[]"]').length;
                                jQuery('#etotal').val(total);
                                // Add new fields
                                // Note that we also pass the validator rules for new field as the third parameter
                                reFreshIndex();
                            })

                            // Remove button click handler
                            .on('click', '.removeButton', function()
                            {
                                //index--;
                                var $row  = jQuery(this).parents('.spec_element'),
                                    index = $row.attr('data-book-index');

                                // Remove element containing the fields
                                $row.remove();
                                var total=jQuery('input[name*="eelement[]"]').length;
                                jQuery('#etotal').val(total);

                                reFreshIndex();

                            })


                            // Add sub element button click handler
                            .on('click', '.maddButton', function()
                            {
                                //mIndex++;
                                var $template = jQuery('#m_template_element'),
                                    $clone    = $template
                                        .clone()
                                        .removeClass('hidden')
                                        .removeAttr('id')
                                        .attr('data-min-index', index)
                                        .appendTo( jQuery(this).parents('.single_element'));

                                // Update the name attributes
                                var len = jQuery(this).parents('.single_element').children('.card-body').length;
                                var tag_index=$clone.parents('.spec_element').attr('data-book-index');
                                console.log(len);
                                $clone.find('[name="element[0][]"]').attr('name', 'element['+tag_index+']['+(len-1)+'][]').end();
                                $clone.find('[name="element[0][]"]').attr('name', 'element['+tag_index+']['+(len-1)+'][]').end();
                                var total=jQuery('input[name*="eelement[]"]').length;
                                jQuery('#etotal').val(total);
                                // Add new fields
                                // Note that we also pass the validator rules for new field as the third parameter
                                reFreshIndex();
                            })

                            // Remove button click handler
                                .on('click', '.mremoveButton', function()
                                {
                                    //mIndex--;
                                    var $row  = jQuery(this).parents('.single'),
                                        index = $row.attr('data-min-index');

                                    // Remove element containing the fields
                                    $row.remove();
                                    var total=jQuery('input[name*="eelement[]"]').length;
                                    jQuery('#etotal').val(total);
                                    reFreshIndex();

                                })
                    });


                    </script>
                    <script>
                        $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                         }
                                    });
                        jQuery('#category_id').change(function(){
                            var cat_value= jQuery('#category_id').val();
                            var data='';
                            if(cat_value!='') {
                                jQuery('#header_element').attr('class', 'card-header');
                                jQuery('#body_element').attr('class', 'card-body');
                                $.ajax({type :'post',
                                url :"{{ route('admin_product_cat_element') }}",
                                data : {data1:cat_value},
                                success : function(result)
                                {
                                    var k=0;
                                    for ( var i in result['element'])
                                    {
                                        var id = result['element'][i].id;
                                        var name = result['element'][i].name;
                                        console.log(id);
                                        console.log(name);

                                        data=data+'<div class="form-group row">'+
                                                 '<label class="col-sm-3 control-label text-sm-right pt-2">'+name+'<span class="required">*</span></label>'+
                                                 '<div class="col-sm-9">'+
                                                     '<select id="'+name+'" name="subelement[]" data-plugin-selectTwo class="form-control populate placeholder" title="Please select a '+name+'">'+
                                                         '<option value="">Choose a Category</option>';
                                        var d=0;
                                        for ( var j in result['subelement'][name]) {
                                            console.log('sami'+j);
                                            var sid = result['subelement'][name][d].id;
                                            var sname = result['subelement'][name][d].name;
                                            console.log(sid);
                                            console.log(sname);

                                            data=data+'<option value="'+sid+'">'+sname+'</option>';
                                            d++;
                                        }

                                        data=data+'<input type="hidden" name="element_name[]" value="'+name+'">';
                                        data=data+'<input type="hidden" name="element_id[]" value="'+id+'">';
                                        data=data+'</select>'+
                                                '</div>'+
                                            '</div>';
                                        k++;
                                    }

//                                    jQuery('#body_element').html(data);//html(data);
                                },
                                error: function(data){
                                        //var errors = data.response();
                                        console.log(data);
                                        // Render the errors with js ...
                                      }
                                });
                            }
                            else
                            {
                                jQuery('#header_element').attr('class', 'card-header hidden');
                                jQuery('#body_element').attr('class', 'card-body hidden');
                            }
                        });
                    </script>


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

		<script src="{{URL::asset('back/vendor/owl.carousel/owl.carousel.js')}}"></script>


@endsection

@section('example')
    <!-- Examples -->
    <script src="{{URL::asset('back/js/examples/examples.datatables.default.js')}}"></script>
    <script src="{{URL::asset('back/js/examples/examples.datatables.row.with.details.js')}}"></script>
    <script src="{{URL::asset('back/js/examples/examples.datatables.tabletools.js')}}"></script>

    <script src="{{URL::asset('back/js/examples/examples.validation.js')}}"></script>

    <script src="{{URL::asset('back/js/examples/examples.treeview.js')}}"></script>

    <script src="{{URL::asset('back/js/examples/examples.lightbox.js')}}"></script>
@endsection