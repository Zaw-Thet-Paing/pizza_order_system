@extends('admin.layouts.master')

@section('title', 'Product List')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Product List</h2>

                    </div>
                </div>
                <div class="table-data__tool-right">
                    <a href="{{ route('product#createPage') }}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>Add Pizza
                        </button>
                    </a>
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        CSV download
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-3">
                    <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                </div>
                <div class="col-3 offset-6 mb-3">
                    <form action="{{ route('product#list') }}" method="GET">
                        @csrf
                        <div class="d-flex">
                            <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                            <button class="btn bg-dark text-white" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- <div class="col-4 offset-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Insert Success
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div> --}}

            @if (session('productCreated'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('productCreated') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('productDeleted'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('productDeleted') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('updatedSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('updatedSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <div class="row my-2">
                <div class="col-3 bg-white shadow-sm p-2 mx-3 text-center">
                    <h3>Total - {{ $products->total() }}</h3>
                </div>
            </div>

            @if (count($products) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th class="fs-5">Image</th>
                                <th class="fs-5">Name</th>
                                <th class="fs-5">Price</th>
                                <th class="fs-5">Category</th>
                                <th class="fs-5">View Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="spacer"></tr>
                                <tr class="tr-shadow">
                                    <td class="col-2">
                                        <img src="{{ asset('storage/'.$product->image) }}" alt="" class="img-thumbnail shadow-sm">
                                    </td>
                                    <td class="col-3">{{ $product->name }}</td>
                                    <td class="col-2">{{ $product->price }}</td>
                                    <td class="col-2">{{ $product->category_id }}</td>
                                    <td class="col-2"> <i class="fa-solid fa-eye"></i> {{ $product->view_count }}</td>
                                    <td class="col-2">
                                        <div class="table-data-feature">
                                            <a href="{{ route('product#edit', $product->id) }}" class="me-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                            <a href="" class="me-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('product#delete', $product->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $products->links() }}
                    </div>

                </div>
            @else
                <h3 class="text-secondary text-center mt-5">There is no products here</h3>
            @endif



            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection
