@extends('admin.layouts.master')

@section('title', 'Category List Create')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>

                            <hr>

                            <form action="">
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if (Auth::user()->image == null)
                                            <img src="{{ asset('images/defaultUser.jpg') }}" alt="John Doe" class="shadow-sm" />
                                        @else
                                            <img src="{{ asset('admin/images/icon/avatar-01.jpg') }}" alt="John Doe" class="shadow-sm" />
                                        @endif

                                        <div class="mt-1">
                                            <input type="file" name="image" class="form-control">
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-dark text-white w-100" type="submit">
                                                Update
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter name..." value="{{ old('name', Auth::user()->name) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="email" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter email..." value="{{ old('email', Auth::user()->email) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter phone..." value="{{ old('phone', Auth::user()->phone) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control" placeholder="Enter address..." rows="1">{{ old('address', Auth::user()->address) }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" value="{{ Auth::user()->role }}" name="role" type="text" class="form-control" aria-required="true" aria-invalid="false" disabled>
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
