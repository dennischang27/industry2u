@extends('admin.layouts.app')

@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Product Category - {{ $productcategory->name }}</h1>
    <!-- End Page Heading -->
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 form-group ">
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.productcategories.index') }}"> Back</a>
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
            <form action="{{ route('admin.productcategories.update',$productcategory->id) }}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" value="{{ $productcategory->name }}" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Image:</strong>
                            <div>
                                @if(isset($productcategory->logo))
                                    <img src="{{ asset('storage/categories/'.$productcategory->image) }}" width="100" height="100">
                                @else
                                    <img src=" {{ asset('images/noimage.jpg') }}" width="100" height="100">
                                @endif
                            </div>
                            <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12">
                            <small class="txt-desc">(Please Choose Brand Image To Replace)</small>
                        </div>
                    </div>
                    <input type="hidden" name="slug" id="slug" class="form-control" placeholder="slug" value="{{ $productcategory->slug }}">

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#name").keyup(function(){
                var Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace('/\s/g','-');
                $("#slug").val(Text);
            });
        });
    </script>
@endsection
