@extends('layouts.app')

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
                    <li class="breadcrumb-item active">Invite User</li>
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
                                <h3>User Invitation</h3>
                            </div>
                            @if($errors->any())
                              <h6><div class="text-danger" style="margin-left:20px;">{{$errors->first('message')}}</div></h6>
                            @endif
                            <div class="card-body">
                                <form method="POST" action="{{ route("user.sendinvitation", $user) }}" accept-charset="UTF-8">
                                    @csrf
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    <div class="form-row" style="margin-bottom: 10px;">
                                          <div class="col-md-3">
                                              <label for="email">Date:</label>
                                          </div>
                                          <div class="col-md-9">
                                              {{date("Y-m-d")}}
                                          </div>
                                    </div>
                                    <div class="form-row" style="margin-bottom: 10px;">
                                          <div class="col-md-3">
                                              <label for="firstname">First Name: <small class="text-danger">*</small></label>
                                          </div>
                                          <div class="col-md-9">
                                              <input id="firstname" type="text" class="form-control" value="{{ old('firstname') }}" name="firstname" placeholder="Enter First Name" style="height:40px;">
                                              @if ($errors->has('firstname'))
                                                  <span class="text-danger">{{ $errors->first('firstname') }}</span>
                                              @endif
                                          </div>
                                    </div>
                                    <div class="form-row" style="margin-bottom: 10px;">
                                          <div class="col-md-3">
                                              <label for="lastname">Last Name: <small class="text-danger">*</small></label>
                                          </div>
                                          <div class="col-md-9">
                                              <input id="lastname" type="text" class="form-control" value="{{ old('lastname') }}" name="lastname" placeholder="Enter Last Name" style="height:40px;">
                                              @if ($errors->has('lastname'))
                                                  <span class="text-danger">{{ $errors->first('lastname') }}</span>
                                              @endif
                                          </div>
                                    </div>
                                    <div class="form-row" style="margin-bottom: 10px;">
                                          <div class="col-md-3">
                                              <label class="float-left">User Department: <small class="text-danger">*</small></label>
                                          </div>
                                          <div class="col-md-9">
                                              <select title="Please Select User Department" name="department"
                                                      class="@error('department') is-invalid @enderror form-control select2" id="department" style="color:#6e707e;height:40px;">
                                                  <option value="">Please Select User Department</option>
                                                  @foreach($departments as $s)
                                                      @if (old('department') == $s->id)
                                                        <option value="{{$s->id}}" selected> {{$s->name}} </option>
                                                      @else
                                                        <option value="{{$s->id}}" /> {{$s->name}} </option>
                                                      @endif
                                                  @endforeach
                                              </select>
                                              @if ($errors->has('department'))
                                                  <span class="text-danger">{{ $errors->first('department') }}</span>
                                              @endif
                                          </div>
                                    </div>
                                    <div class="form-row" style="margin-bottom: 10px;">
                                          <div class="col-md-3">
                                              <label class="float-left">User Designation: <small class="text-danger">*</small></label>
                                          </div>
                                          <div class="col-md-9">
                                              <select title="Please Select User Designation" name="designation"
                                                      class="@error('designation') is-invalid @enderror form-control select2" id="designation" style="color:#6e707e;height:40px;">
                                                  <option value="">Please Select User Designation</option>
                                                  @if ($designations)
                                                      @foreach($designations as $d)
                                                          @if (old('designation') == $d->id)
                                                            <option value="{{$d->id}}" selected> {{$d->name}} </option>
                                                          @else
                                                            <option value="{{$d->id}}" /> {{$d->name}} </option>
                                                          @endif
                                                      @endforeach
                                                  @endif
                                              </select>
                                              @if ($errors->has('designation'))
                                                  <span class="text-danger">{{ $errors->first('designation') }}</span>
                                              @endif
                                          </div>
                                    </div>
                                    <div class="form-row" style="margin-bottom: 10px;">
                                          <div class="col-md-3">
                                              <label for="email">User Email: <small class="text-danger">*</small></label>
                                          </div>
                                          <div class="col-md-9">
                                              <input id="email" type="text" class="form-control" value="{{ old('email') }}" name="email" placeholder="Enter User Email" style="height:40px;">
                                              @if ($errors->has('email'))
                                                  <span class="text-danger">{{ $errors->first('email') }}</span>
                                              @endif
                                          </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-fill-out btn-sm">Send Invitation</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $("#department").change(function(){
                var value = $(this).val();
                $.post( "{{ route('user.designation') }}", { departmentid: value }, function( data ) {
                    $('#designation').empty();
                    $('#designation').append('<option value="">Please Select User Designation</option>');
                    $.each( data, function( key, value ) {
                        $('#designation').append('<option value='+data[key].id+'>'+data[key].name+'</option>');
                    });
                });
            });
        });
    </script>
@endsection
