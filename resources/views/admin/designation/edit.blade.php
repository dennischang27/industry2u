@extends('admin.layouts.app')

@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Designation - {{ $designation->name }}</h1>
    <!-- End Page Heading -->
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.users.designation.index') }}"> Back</a>
            </div>
        </div>
        <div class="card-body">
                {!! Form::model($designation, ['method' => 'PATCH','route' => ['admin.users.designation.update', $designation->id]]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name: <small class="text-danger">*</small></strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Department: <small class="text-danger">*</small></strong>
                            <select title="Please Select User Department" name="department"
                                    class="@error('role_id') is-invalid @enderror form-control select2" id="department" style="height:40px;">
                                <option style="color:gray" value="">Please Select User Department</option>
                                @foreach($roles as $s)
                                    @if (old('department') == $s->id)
                                      <option value="{{$s->id}}" selected> {{$s->name}} </option>
                                    @else
                                        @if ($designation->roles_id == $s->id)
                                            @if ($errors->has('department'))
                                                <option value="{{$s->id}}"> {{$s->name}}</option>
                                            @else
                                                <option value="{{$s->id}}" selected> {{$s->name}}</option>
                                            @endif
                                        @else
                                            <option value="{{$s->id}}" /> {{$s->name}} </option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('department'))
                                <span class="text-danger">{{ $errors->first('department') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}
        </div>
    </div>

@endsection
