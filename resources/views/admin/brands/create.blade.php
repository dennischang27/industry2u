@extends('admin.layouts.app')

@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Add New Brand</h1>
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.brands.index') }}"> Back</a>
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
            <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:<span class="required">*</span></strong>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                   value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Description:<span class="required">*</span></strong>
                            <textarea class="form-control" style="height:150px" name="description"
                                      placeholder="Description">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div data-v-d3b0f5e4="" class="col-sm-2" aspect="1">
                        <div class="shopee-upload-wrapper shopee-upload-dragger">
                            <input type="file" name="file"  accept="image/*"
                                   multiple="multiple" aspect="1"
                                     class="shopee-upload__input">
                            <div data-v-63e0ed9c="" class="shopee-image-manager__upload__content">
                                <i data-v-63e0ed9c=""   class="shopee-icon">
                                    <svg viewBox="0 0 31 31" xmlns="http://www.w3.org/2000/svg">
                                        <g fill-rule="nonzero">
                                            <path
                                                d="M15 15V7.5a.5.5 0 1 1 1 0V15h7.5a.5.5 0 1 1 0 1H16v7.5a.5.5 0 1 1-1 0V16H7.5a.5.5 0 1 1 0-1H15z"></path>
                                            <path
                                                d="M15.5 31C6.94 31 0 24.06 0 15.5 0 6.94 6.94 0 15.5 0 24.06 0 31 6.94 31 15.5 31 24.06 24.06 31 15.5 31zm0-1C23.508 30 30 23.508 30 15.5S23.508 1 15.5 1 1 7.492 1 15.5 7.492 30 15.5 30z"></path>
                                        </g>
                                    </svg>
                                </i></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Logo:</strong>
                            <input type="file" id="logo" name="logo" class="form-control col-md-7 col-xs-12">
                            <small class="txt-desc">(Please Choose Brand Image)</small>
                            <label for="logo"></label>
                            <img id="previewImg" alt="" width="200" height="150">
                        </div>
                    </div>
                    <input type="hidden" name="slug" id="slug" class="form-control" placeholder="slug"
                           value="{{ old('slug') }}">
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
        $(document).ready(function () {
            $("#name").keyup(function () {
                var Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace('/\s/g', '-');
                $("#slug").val(Text);
            });

        });

        function loadPreview(input) {
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();

                reader.onload = function () {
                    $("#previewImg").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }

        $("#logo").change(function () {
            loadPreview(this);
        });
    </script>
@endsection
