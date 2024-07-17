@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pullleft">
                <h2>Edit User</h2>
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                    </div>
                
            </div>
        </div>
    </div>


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


    <form action="{{ route('users.note') }}" method="POST">
        @csrf
        <div class="row">
           <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>First Name:</strong>
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="text" name="firstname" value="{{ $user->firstname }}" class="form-control" placeholder="First Name">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Last Name:</strong>
                    <input type="text" name="lastname" value="{{ $user->lastname }}" class="form-control" placeholder="Last Name">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>DOB:</strong>
                    <input type="date" name="dob" value="{{ $user->dob }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Mobile:</strong>
                    <input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control" placeholder="Mobile">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Address:</strong>
                    <textarea class="form-control" name="address" id="" cols="30" rows="10">{{ $user->address }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>City:</strong>
                    <input type="text" name="city" value="{{ $user->city }}" class="form-control" placeholder="City">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>State:</strong>
                    <input type="text" name="state" value="{{ $user->state }}" class="form-control" placeholder="State">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Pincode:</strong>
                    <input type="text" name="pincode" value="{{ $user->pincode }}" class="form-control" placeholder="Pincode">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Username:</strong>
                    <input type="text" name="username" value="{{ $user->username }}" class="form-control" placeholder="Username">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Password:</strong>
                    <input type="password" name="password" class="form-control"
                        placeholder="Password">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    <input type="password" name="confirm-password" class="form-control"
                        placeholder="Confirm Password">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Role:</strong>
                    <select class="form-control multiple" multiple name="roles[]">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

@endsection
