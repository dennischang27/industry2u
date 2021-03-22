@extends('layouts.app')

@section('style')
    <style>
        .profile-img{
            text-align: center;
        }
        .profile-img img{
            width: 30%;
            height: 30%;
        }
        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }
        label, .submit-btn{
            margin-top:25px;
        }
        .form-control, .form-control:focus {
            color: #6C757D;
        }
        #bankinfoform > .row{
            margin-bottom: 10px;
        }
        select{
            margin-top:15px;
        }
        .form-control.is-invalid{
            background-image: none;
        }
    </style>

@endsection

@section('breadcrumbs')
    <!-- breadcrumbs start here-->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
					<b class="h5">Management Centre</b>
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
                        <li class="breadcrumb-item active">Company Profile</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    @include('layouts.managementsidebar')
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="dashboard_content">
                        <div class="card">
                            <div class="card-header">
                                <h3>Reporting Line</h3>
                            </div>
                            <div class="card-body">
                                <form id="updatereportingform" novalidate class="form" method="post" enctype="multipart/form-data"
                                        action="{{route('user.reporting.update',$user->id)}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="float-left">{{ __('First Name') }}: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="float-left">{{ $user->first_name }}</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="float-left">{{ __('Last Name') }}: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="float-left">{{ $user->last_name }}</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="float-left">{{ __('Department') }}: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="float-left">{{ $user->departmentName->name }}</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="float-left">{{ __('User Designation') }}: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="float-left">{{ $user->designationName->name }}</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="float-left">{{ __('User Email') }}: </label>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="float-left">{{ $user->email }}</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="reporting">{{ __('Reporting Manager') }}:<small class="text-danger">*</small></label>
                                            </div>
                                            <div class="col-md-8">
                                            <select title="Please select reporting manager" required name="reporting"
                                                    class="@error('reporting') is-invalid @enderror form-control select2" id="reporting">
                                                <option value=""><span style="color:blue;">Please select reporting manager</span></option>
                                                @foreach($reportings as $s)
                                                    <option value="{{$s['id']}}" {{ old('reporting') == $s['id'] ? "selected" : "" }} {{ $user->user_reporting_id == $s['id'] ? "selected='selected'" : "" }}> {{$s['first_name']}} {{$s['last_name']}}</option>
                                                @endforeach
                                            </select>
                                            @error('reporting')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                    <div class="form-group text-right submit-btn">
                                        <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Update" />
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function reload_designation(value, selected=''){
            $.post( "{{ route('user.designation') }}", { departmentid: value }, function( data ) {
                $('#designation_id').empty();
                $('#designation_id').append('<option value="">Please Select Designation</option>');
                $.each( data, function( key, value ) {
                    if(selected){
                        if(selected == data[key].id){
                            $('#designation_id').append('<option value='+data[key].id+' selected>'+data[key].name+'</option>');
                        }else{
                            $('#designation_id').append('<option value='+data[key].id+'>'+data[key].name+'</option>');
                        }
                        
                    }else{
                        $('#designation_id').append('<option value='+data[key].id+'>'+data[key].name+'</option>');
                    }
                });
            });
        }
        $(function(){
            $("#department_id").change(function(){
                var value = $(this).val();
                reload_designation(value);
            });
        });
        $( document ).ready(function() {
            reload_designation({{$user->department_id}}, {{$user->designation_id}});
        });
    </script>
@endsection
