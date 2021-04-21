@extends('layouts.app')


@section('breadcrumbs')
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					<b class="h5">Sales Centre</b>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb justify-content-md-end" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <meta itemprop="position" content="1">
                            <a href="{{route("home")}}" itemprop="item" title="Home">
                                Home
                                <meta itemprop="name" content="Home">
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Products Managenent</li>
                        <li class="breadcrumb-item active">Upload Files</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css"  rel="stylesheet">
    <style type="text/css">

        .dropzone {
            text-rendering: optimizeLegibility;
            font-size: 16px;
            font-weight: 200;
            background: white;
            border-radius: 5px;
            border: 2px dashed rgb(0, 135, 247);
            border-image: none;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endsection


@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    @include('layouts.salesidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">
                        <div class="card">
                            <div class="card-header">
                                <h3>Upload Files</h3>
                                
                            </div>
                            <div class="card-body">

                                <div class="col-12 mt-5">
                                    @error('uploaded_file')
                                    <div class="alert alert-danger">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                            
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title text-center">Drop Files to upload (for imported products)</h4>
                                            <div id="dropzone">
                                                <form class="dropzone needsclick" id="file-upload" action="{{route('seller.products.uploadfile.process')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="dz-message needsclick">
                                                        Drop product image files and attachment here or click to upload .<br>
                                                        <span class="note needsclick">(Selected files need to match with the excel file naming.)</span>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <h4 class="header-title">File uploaded for imported products:</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>File Name</th>
                                                        <th width="280px">Action</th>
                                                    </tr>
                            
                                                    @foreach($files as $file)
                                                        <tr>
                                                            <td> {{$i++}}</td>
                                                            <td> {{basename($file)}}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletefile{{$i }}">Delete</button>
                                                                <div id="deletefile{{$i}}" class="delete-modal modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <div class="delete-icon"></div>
                                                                            </div>
                                                                            <div class="modal-body text-center">
                                                                                <h4 class="modal-heading">Are You Sure ?</h4>
                                                                                <p>Do you really want to delete this file {{ basename($file) }}? This process cannot be undone.</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <form method="get" action="{{route('seller.products.file.delete',basename($file))}}" class="pull-right">
                                                                                    {{csrf_field()}}
                                                                                    {{method_field("DELETE")}}
                                                                                    <input type="hidden" value="{{ basename($file) }}" name="file_name">
                                                                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                                                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                            
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('plugin_script')


    <script  src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
    <script>

        var dropzone = new Dropzone('#file-upload', {
            parallelUploads: 2,
            thumbnailHeight: 120,
            thumbnailWidth: 120,
            maxFilesize: 3,
            filesizeBase: 1000,
            init: function() {
                this.on('success', function(){
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                        window.setTimeout(function(){
                            location.reload();
                        }, 1200);
                    }
                });
            }

        });



    </script>
@endsection