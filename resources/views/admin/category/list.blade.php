@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Category List</h2>

                    </div>
                </div>
                <div class="table-data__tool-right">
                    <a href="{{ route('category#createPage') }}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>Add Category
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
                    <form action="{{ route('category#list') }}" method="GET">
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

            @if (session('createSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('createSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('deleteSuccess') }}
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
                    <h3>Total - {{ $categories->total() }}</h3>
                </div>
            </div>

            @if (count($categories) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th class="fs-5">ID</th>
                                <th class="col-6 fs-5">Category Name</th>
                                <th class="fs-5">Created Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr class="spacer"></tr>
                                <tr class="tr-shadow">
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa fa-eye"></i>
                                            </button> --}}
                                            <a href="{{ route('category#edit', $category->id) }}" class="me-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('category#delete', $category->id) }}">
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
                        {{ $categories->links() }}
                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>

                </div>
            @else
                <h3 class="text-secondary text-center mt-5">Ther is no Category Here!</h3>
            @endif

            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection
