@extends('admin.layouts.app')
@section('style')
    <style>
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
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Product Attribute- {{ $attribute->name }}</h1>
    </div>
    <!-- End Page Heading -->
@endsection

@section('content')
    <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-2">
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
                                <form action="{{ route('admin.ecommerce.attributes.update',$attribute->id) }}" class="col-12" method="POST"  enctype="multipart/form-data">

                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Name:</strong>
                                            <input type="text" name="name" id="name"  value="{{ $attribute->name }}" class="form-control" placeholder="Name">
                                            <input type="hidden" name="slug" id="slug"  value="{{ $attribute->slug }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for=""><strong>Is Numeric Only:</strong></label>
                                            <div class="form-control">
                                            <div class="onoffswitch">
                                                <input type="hidden" name="is_range" value="0">
                                                <input type="checkbox" name="is_range" class="onoffswitch-checkbox" data-target="#attributemeasurementdiv" id="is_range" value="1" @if ($attribute->is_range) checked @endif >
                                                <label class="onoffswitch-label" for="is_range">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>

                                </div>
                                </form>
                        </div>
                    </div>

                </div>
               <div class="col-12 "  id ="attributemeasurementdiv">
                   <div class="card shadow mb-4">
                       <div class="card-body">
                           <div>
                               <h6>
                                   <span><strong> Unit measurement list</strong></span>
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
                                   @foreach($attribute->attributemeasurement as $attributemeasurement)
                                       <li data-id="0" class="clearfix">
                                           <div class="swatch-title">
                                               {{$attributemeasurement->name}}
                                           </div>

                                           <div class="action-item">
                                               <a href="#valedit{{$attributemeasurement->id}}" data-toggle="modal" class="font-blue">
                                                   <i class="fa fa-pen"></i>
                                               </a>&nbsp;
                                               <a href="#deleteattibute{{$attributemeasurement->id}}" data-toggle="modal" class="font-red">
                                                   <i class="fa fa-trash"></i>
                                               </a>
                                           </div>
                                       </li>
                                       <!-- Modal for Edit-->
                                       <div id="valedit{{$attributemeasurement->id}}" class="delete-modal modal fade" role="dialog">
                                           <div class="modal-dialog modal-sm">
                                               <!-- Modal content-->
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       Edit Unit: <b> {{$attributemeasurement->name}}</b>
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   </div>
                                                   <div class="modal-body">
                                                       <div class="display-none" id="result{{$attributemeasurement->id}}">
                                                       </div>
                                                       <div class="form-group">
                                                           <label for="">Edit Unit:</label>
                                                           <input id="getValue{{$attributemeasurement->id}}" type="text" placeholder="Enter Name" class="form-control" name="name" value="{{$attributemeasurement->name}}">
                                                       </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">Cancel</button>
                                                       <button  onclick="submitupdate('{{ $attributemeasurement->id }}')" type="submit"  id="update" class="btn btn-primary">Update</button>

                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <!--END-->
                                       <!-- Modal for Delete-->
                                       <div id="deleteattibute{{ $attributemeasurement->id }}" class="delete-modal modal fade" role="dialog">
                                           <div class="modal-dialog modal-sm">
                                               <!-- Modal content-->
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                       <div class="delete-icon"></div>
                                                   </div>
                                                   <div class="modal-body text-center">
                                                       <div class="display-none" id="resultdelete{{$attributemeasurement->id}}">
                                                       </div>
                                                       <input id="getDeleteValue{{$attributemeasurement->id}}" type="hidden" placeholder="Enter Name" class="form-control" name="name" value="{{$attributemeasurement->name}}">
                                                       <h4 class="modal-heading">Are You Sure ?</h4>
                                                       <p>Do you really want to delete this Unit {{$attributemeasurement->name}}? This process cannot be undone.</p>
                                                   </div>
                                                   <div class="modal-footer">


                                                           <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                                           <button type="submit" onclick="submitdelete('{{ $attributemeasurement->id }}')" class="btn btn-danger">Yes</button>
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
                                   <div class="modal-dialog modal-sm">
                                       <!-- Modal content-->
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               Add Unit Measurement for: <b> {{ $attribute->name }}</b>
                                               <button type="button" class="close" data-dismiss="modal">&times;</button>
                                           </div>
                                           <div class="modal-body">
                                               <div class="display-none" id="resultnew">
                                               </div>
                                               <div class="form-group">
                                                   <label for="">Name:</label>
                                                   <input id="getValueNew" type="text" placeholder="Enter Name" class="form-control" name="name" value="">
                                               </div>
                                           </div>
                                           <div class="modal-footer">
                                               <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">Cancel</button>
                                               <button  onclick="submitnew('{{ $attribute->id }}')" type="submit"  id="update" class="btn btn-primary">Add</button>

                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <!--END-->
                           </div>
                       </div>
                   </div>
               </div>

    </div>
@endsection

@section('script')
    <script>

        var url = {!!json_encode( url('admin/attributes/attributemeasurements/update/') )!!};
        var newurl = {!!json_encode( url('admin/attributes/attributemeasurements/store/') )!!};
        var deleteurl = {!!json_encode( url('admin/attributes/attributemeasurements/delete/') )!!};
        $(document).ready(function() {
            $("#name").keyup(function(){
                var Text = $(this).val();
                Text=Text.toLowerCase().replace(/ /g,'_').replace(/[-]+/g, '-').replace(/[^\w-]+/g,'');
                $("#slug").val(Text);
            });
        });
        $(document).ready(function() {
            var checkBox = document.getElementById("is_range");
            var text = document.getElementById("attributemeasurementdiv");
            if(checkBox.checked) {
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
        });
        $(document).on('change', '.onoffswitch-checkbox', function() {
            var target = $(this.dataset.target);
            console.log(this.checked);
            if(this.checked) {
                target.show();
            } else {
                target.hide();
            }
        });

        function submitupdate(id){

            var v = $('#getValue'+id).val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'GET',
                data : {newval: v},
                url  : url+'/'+id,
                success : function(data){
                    $('#result'+id).html(data).slideDown(500);

                    window.setTimeout(function(){

                        location.reload();

                    }, 2500);

                }
            });

            setTimeout(function() {
                $('#result'+id).slideUp(500);
            }, 2000);
        }
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
        function submitnew(attrrid){

            var v = $('#getValueNew').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'GET',
                data : {newval: v},
                url  : newurl+'/'+attrrid,
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

    </script>
@endsection
