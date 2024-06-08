@extends('admin.layouts.master')

@section('title', 'Product Details')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="ms-2">
                                {{-- <a href="{{ route('product#list') }}" class="text-decoration-none"> --}}
                                    <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                {{-- </a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Product Details</h3>
                            </div>
                            @if (session('updateSuccess'))
                                <div class="">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('updateSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            <hr>

                            <div class="row">

                                <div class="col-3 offset-1">
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="John Doe" />
                                </div>

                                <div class="col-7 offset-1">
                                    <h3>{{ $product->name }}</h3>
                                    <div class="row">
                                        <span class="my-3 col me-1 btn btn-dark text-white"> <i class="fa-solid fa-money-bill-1-wave me-2 fs-4"></i> {{ $product->price }} Kyats</span>
                                        <span class="my-3 col me-1 btn btn-dark text-white"> <i class="fa-solid fa-clock me-2 fs-4"></i> {{ $product->waiting_time }} mins</span>
                                        <span class="my-3 col me-1 btn btn-dark text-white"> <i class="fa-solid fa-eye me-2 fs-4"></i> {{ $product->view_count }}</span>
                                        <span class="my-3 col me-1 btn btn-dark text-white"> <i class="fa-solid fa-clone me-2 fs-4"></i> {{ $product->category_name }}</span>
                                    </div>
                                    <div class="my-3"> <i class="fa-solid fa-file-lines me-2 fs-4"></i> Details</div>
                                    <p>{{ $product->description }}</p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
