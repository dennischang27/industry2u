@extends('admin.layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <style>

        .select2-selection__rendered {
            line-height: 37px !important;
        }
        .select2-container .select2-selection--single {
            height: 37px !important;
        }
        .select2-container  {
            margin-bottom: 15px;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
        .custom-well {
            color: #fff;
            background: #3c8dbc;
            border: 1px solid #3c8dbc
        }
        .swatches-container .header {
            display:flex;
            flex-direction:row;
            font-weight:700;
            background-color: #3694d3;
            color:#fff
        }
        .swatches-container .header>* {
            float:left;
            padding:10px;
            text-align:center
        }
        .swatches-container .header:before {
            content:"#";
            display:inline-block;
            width:50px;
            text-align:center;
            line-height:40px
        }
        .swatches-container .header .swatch-slug,
        .swatches-container .header .swatch-title,
        .swatches-container .header .swatch-min,
        .swatches-container .header .swatch-max,
        .swatches-container .header .swatch-value {
            flex:1
        }
        .swatches-container .header .action-item {
            width:80px
        }
        .swatches-container .swatches-list {
            float:left;
            list-style:none;
            margin:0 0 15px;
            padding:0;
            width:100%;
            counter-reset:swatches-list
        }
        .swatches-container .swatches-list li {
            padding-left:50px;
            display:flex;
            flex-direction:row;
            align-items:center;
            position:relative;
            counter-increment:swatches-list
        }
        .swatches-container .swatches-list li+li {
            margin-top:1px
        }
        .swatches-container .swatches-list li:nth-child(odd) {
            background-color:#f0f0f0
        }
        .swatches-container .swatches-list li:before {
            content:counter(swatches-list);
            width:50px;
            position:absolute;
            height:100%;
            top:0;
            left:0;
            cursor:move;
            background-color:#bbb;
            color:#fff;
            display:flex;
            align-items:center;
            justify-content:center
        }
        .swatches-container .swatches-list li>* {
            float:left;
            padding:10px;
            text-align:center
        }
        .swatches-container .swatches-list li .swatch-slug,
        .swatches-container .swatches-list li .swatch-min,
        .swatches-container .swatches-list li .swatch-max,
        .swatches-container .swatches-list li .swatch-title,
        .swatches-container .swatches-list li .swatch-value {
            flex:1
        }
        .swatches-container .swatches-list li .image-box-container img {
            border:1px solid #ccc;
            width:34px;
            height:34px
        }
        .swatches-container .swatches-list li .action-item {
            width:100px
        }
        .swatches-container .swatches-list .list-photo-hover-overlay {
            display:none
        }

    </style>

@endsection
@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Product Category - {{ $productcategory->name }}</h1>
    <!-- End Page Heading -->
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6" >
            <div class="card shadow mb-4">
                <div class="card-header form-group ">
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('admin.ecommerce.productcategories.index') }}"> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.ecommerce.productcategories.update',$productcategory->id) }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" id="name"  value="{{ $productcategory->name }}" class="form-control" placeholder="Name">

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Parent Category:</strong>
                                    <select id="parent_id" name="parent_id" class="form-control select2" title="Please select product category">
                                        <option value="">None</option>
                                        @foreach($categories as $category)
                                            @if($category->id !=$productcategory->id)
                                                <option value="{{ $category->id }}" {{ ($category->id == $productcategory->parent_id) ?'selected' : ''}}>{{ $category->name }}</option>

                                                @if(count($category->subCategories))
                                                    @foreach($category->subCategories as $subcategory)

                                                        @if($subcategory->id !=$productcategory->id)
                                                            <option value="{{ $subcategory->id }}" {{ $subcategory->id == old('parent_id')?'selected' : ''}}>{{ $category->name }} > {{ $subcategory->name }}  </option>
                                                            @if(count($subcategory->subCategories))
                                                                @foreach($subcategory->subCategories as $subsubcategory)
                                                                    @if($subsubcategory->id !=$productcategory->id)
                                                                    <option value="{{ $subsubcategory->id }}" {{ $subsubcategory->id == old('parent_id')?'selected' : ''}}>{{ $category->name }} > {{ $subcategory->name }} >{{ $subsubcategory->name }}  </option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Image:</strong>
                                    <div>
                                        @if(isset($productcategory->image))
                                            <img src="{{ asset('storage/categories/'.$productcategory->image) }}" width="100" height="100">
                                        @else
                                            <img src=" {{ asset('images/noimage.jpg') }}" width="100" height="100">
                                        @endif
                                    </div>
                                    <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12">
                                    <small class="txt-desc">(Please Choose Brand Image To Replace)</small>
                                </div>
                            </div>
                            <input type="hidden" name="slug" id="slug" class="form-control" value="{{ $productcategory->slug }}">

                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if(!count($productcategory->subCategories))
        <div class="col-12 col-sm-6"  id ="attributemeasurementdiv">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div>
                        <h6>
                            <span><strong> Recommended Attribute List</strong></span>
                        </h6>
                    </div>
                    <div class="swatches-container">
                        <div class="header clearfix">
                            <div class="swatch-title">
                                Name
                            </div>
                            <div class="action-item">Action</div>
                        </div>
                        <ul class="swatches-list">
                            @foreach($productcategory->comAttributes as $procatattributes)
                                <li data-id="0" class="clearfix">
                                    <div class="swatch-title">
                                        {{$procatattributes->Attributes->name}}
                                    </div>

                                    <div class="action-item">
                                        <a href="#deleteattibute{{$procatattributes->id}}" data-toggle="modal" class="font-red">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </li>
                                <!-- Modal for Delete-->
                                <div id="deleteattibute{{ $procatattributes->id }}" class="delete-modal modal fade" role="dialog">
                                    <div class="modal-dialog ">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <div class="delete-icon"></div>
                                            </div>
                                            <div class="modal-body text-center">
                                                <div class="display-none" id="resultdelete{{$procatattributes->id}}">
                                                </div>
                                                <input id="getDeleteValue{{$procatattributes->id}}" type="hidden" placeholder="Enter Name" class="form-control" name="name" value="{{$procatattributes->Attributes->name}}">
                                                <h4 class="modal-heading">Are You Sure ?</h4>
                                                <p>Do you really want to remove this Attribute {{$procatattributes->Attributes->name}} from recommended attribute list?</p>
                                            </div>
                                            <div class="modal-footer">


                                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                                <button type="submit" onclick="submitdelete('{{ $procatattributes->id }}')" class="btn btn-danger">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--END-->
                            @endforeach
                        </ul>
                        <a class="btn btn-md btn-primary" href="#valueadd" data-toggle="modal" >
                            <i class="fa fa-plus"></i> ADD
                        </a>
                        <!-- Modal for Add-->
                        <div id="valueadd" class="delete-modal modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Add Recommended Attributes for: <b> {{ $productcategory->name }}</b>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="display-none" id="resultnew">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Attribute:</label>
                                            <select id="getValueNew" name="getValueNew" class="form-control select2" title="Please select product category">
                                                @foreach($attributes as $attribute)
                                                    <option value="{{ $attribute->id }}" >{{ $attribute->name }}</option>

                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">Cancel</button>
                                        <button  onclick="submitnew('{{ $productcategory->id }}')" type="submit"  id="add" class="btn btn-primary">Add</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END-->
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection

@section('script')

    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>

        var newurl = {!!json_encode( url('admin/productcategories/attributes/store/') )!!};
        var deleteurl = {!!json_encode( url('admin/productcategories/attributes/delete/') )!!};
        function submitdelete(id){

            var v = $('#getDeleteValue'+id).val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'GET',
                data : {newval: v},
                url  : deleteurl+'/'+id,
                success : function(data){
                    $('#resultdelete'+id).html(data).slideDown(500);

                    window.setTimeout(function(){

                        location.reload();

                    }, 1500);

                }
            });

            setTimeout(function() {
                $('#resultdelete'+id).slideUp(500);
            }, 2000);
        }
        function submitnew(id){

            var v = $('#getValueNew').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'GET',
                data : {newval: v},
                url  : newurl+'/'+id,
                success : function(data){
                    $('#resultnew').html(data).slideDown(500);

                    window.setTimeout(function(){

                        location.reload();

                    }, 2500);

                }
            });

            setTimeout(function() {
                $('#resultnew').slideUp(500);
            }, 2000);
        }

        $('.select2').select2({
            allowClear: true,
            width: '100%'
        });
        $(document).ready(function() {
            $("#name").keyup(function(){
                var Text = $(this).val();
                Text=Text.toLowerCase().replace(/ /g,'_').replace(/[-]+/g, '-').replace(/[^\w-]+/g,'');
                $("#slug").val(Text);
            });
        });

    </script>
@endsection
