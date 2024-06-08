@extends('admin.layouts.master')

@section('title', 'Category List Create')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin#list') }}">
                                <div class="ms-2">
                                    <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                </div>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>

                            <hr>

                            <form action="{{ route('admin#change', $account->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">

                                        @if ($account->image == NULL)
                                            @if ($account->gender == "male")
                                                <img src="{{ asset('images/profile-default-male.jpg') }}" class="img-thumbnail shadow-sm">
                                            @else
                                                <img src="{{ asset('images/profile-default-female.jpg') }}" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.$account->image) }}" class="img-thumbnail shadow-sm">
                                        @endif

                                        <div class="mt-1">
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" disabled>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-dark text-white w-100" type="submit">
                                                Change Role
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row col-6">

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if ($account->role == 'admin') selected @endif>Admin</option>
                                                <option value="user" @if ($account->role == 'user') selected @endif>User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter name..." value="{{ old('name', $account->name) }}" disabled>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter email..." value="{{ old('email', $account->email) }}" disabled>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control @error('gender') is-invalid @enderror" disabled>
                                                <option value="">Choose gender...</option>
                                                <option value="male" @if ($account->gender == 'male') selected @endif >Male</option>
                                                <option value="female" @if ($account->gender == 'female') selected @endif >Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter phone..." value="{{ old('phone', $account->phone) }}" disabled>
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter address..." rows="1" disabled>{{ old('address', $account->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
