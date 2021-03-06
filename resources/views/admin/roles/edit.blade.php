@extends('admin.layouts.app')

@section('pagetitle')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Role - {{ $role->name }}</h1>
    <!-- End Page Heading -->
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.users.roles.index') }}"> Back</a>
            </div>
        </div>
        <div class="card-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                {!! Form::model($role, ['method' => 'PATCH','route' => ['admin.users.roles.update', $role->id]]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>Department:</strong>
							<select title="Please Select User Department" name="department"
								  class="@error('role_id') is-invalid @enderror form-control select2" id="department" style="color:#6e707e;height:40px;">
								<option value="">Department</option>
								@if ($departments)
									@foreach($departments as $d)
										@if (old('department') == $d->id)
											<option value="{{$d->id}}" selected> {{$d->name}} </option>
										@elseif ($role->department_id == $d->id)
											<option value="{{$d->id}}" selected> {{$d->name}} </option>
										@else
											<option value="{{$d->id}}" /> {{$d->name}} </option>
										@endif
									@endforeach
								@endif
							</select>
						</div>
					</div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Is Buyer:</strong>
                            <input class="tgl tgl-skewed" id="toggle-event2" type="checkbox" name="is_buyer"  {{ ($role->is_buyer? 'checked' : '')  }}>
                            <label class="tgl-btn" data-tg-off="No" data-tg-on="Yes" for="toggle-event2"></label>
                            <small class="txt-desc">(If enable than Role can be select by Buyer )</small>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Is Seller:</strong>
                            <input class="tgl tgl-skewed" id="toggle-event2" type="checkbox" name="is_seller" {{ ($role->is_seller? 'checked' : '')  }}>
                            <label class="tgl-btn" data-tg-off="No" data-tg-on="Yes" for="toggle-event2"></label>
                            <small class="txt-desc">(If enable than Role can be select by Seller )</small>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            <br/>
                            @foreach($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                    {{ $value->name }}</label>
                                <br/>
                            @endforeach
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
