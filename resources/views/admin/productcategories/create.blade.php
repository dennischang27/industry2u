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
    </style>
@endsection
@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Add New Product Category</h1>
    <!-- End Page Heading -->
@endsection
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
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
            <form action="{{ route('admin.ecommerce.productcategories.store') }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text"  name="name" id="name"  class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Parent Category:</strong>
                            <select id="parent_id" name="parent_id" class="form-control select2" title="Please select product category">
                                <option {{ old('parent_id') ? '' : 'selected' }} value="">None</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == old('parent_id')?'selected' : ''}}>{{ $category->name }}</option>

                                    @if(count($category->subCategories))
                                        @foreach($category->subCategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ $subcategory->id == old('parent_id')?'selected' : ''}}>{{ $category->name }} > {{ $subcategory->name }}  </option>
                                            @if(count($subcategory->subCategories))
                                                @foreach($subcategory->subCategories as $subsubcategory)
                                                    <option value="{{ $subsubcategory->id }}" {{ $subsubcategory->id == old('parent_id')?'selected' : ''}}>{{ $category->name }} > {{ $subcategory->name }} >{{ $subsubcategory->name }}  </option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Image:</strong>
                            <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12">
                            <small class="txt-desc">(Please Choose Category Image)</small>
                        </div>
                    </div>
                    <input type="hidden" name="slug" id="slug" class="form-control" placeholder="slug" value="{{ old('slug') }}">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')

    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>

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
