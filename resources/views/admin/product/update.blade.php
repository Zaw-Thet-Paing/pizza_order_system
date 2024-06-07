@extends('admin.layouts.master')

@section('title', 'Update Product')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="ms-2">
                                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Product</h3>
                            </div>

                            <hr>

                            <form action="{{ route('product#update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <img src="{{ asset('storage/'.$product->image) }}" alt="John Doe" class="shadow-sm" />

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
                                            <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter name..." value="{{ old('name', $product->name) }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter description..." rows="1">{{ old('description', $product->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="category_id" class="form-control">
                                                <option value="">Choose category...</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif >{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="price" type="text" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter price..." value="{{ old('price', $product->price) }}">
                                            @error('price')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="waiting_time" type="text" class="form-control @error('waiting_time') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter waiting_time..." value="{{ old('waiting_time', $product->waiting_time) }}">
                                            @error('waiting_time')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">View Count</label>
                                            <input id="cc-pament" name="view_count" type="text" class="form-control @error('view_count') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter view_count..." value="{{ old('view_count', $product->view_count) }}" disabled>
                                            @error('view_count')
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
