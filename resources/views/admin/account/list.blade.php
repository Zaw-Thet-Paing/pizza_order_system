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
                        <h2 class="title-1">Admin List</h2>

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
                    <form action="{{ route('admin#list') }}" method="GET">
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

            @if (session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('deleteSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <div class="row my-2">
                <div class="col-3 bg-white shadow-sm p-2 mx-3 text-center">
                    <h3>Total - {{ count($admin) }}</h3>
                </div>
            </div>

                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th class="fs-5">Image</th>
                                <th class="fs-5">Name</th>
                                <th class="fs-5">Email</th>
                                <th class="fs-5">Gender</th>
                                <th class="fs-5">Phone</th>
                                <th class="fs-5">Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $a)
                            <tr class="spacer"></tr>
                                <tr class="tr-shadow">
                                    <td class="col-2">
                                        @if ($a->image == NULL)
                                            @if ($a->gender == "male")
                                                <img src="{{ asset('images/profile-default-male.jpg') }}" class="img-thumbnail shadow-sm">
                                            @else
                                                <img src="{{ asset('images/profile-default-female.jpg') }}" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.$a->image) }}" class="img-thumbnail shadow-sm">
                                        @endif
                                    </td>
                                    <td>{{ $a->name }}</td>
                                    <td>{{ $a->email }}</td>
                                    <td>{{ $a->gender }}</td>
                                    <td>{{ $a->phone }}</td>
                                    <td>{{ $a->address }}</td>
                                    <td>
                                        @if ($a->id != Auth::user()->id)
                                            <div class="table-data-feature">
                                                <a href="{{ route('admin#changeRole', $a->id) }}" class="me-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                                        <i class="fa-solid fa-person-circle-minus"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('admin#delete', $a->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $admin->links() }}
                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>

                </div>

            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection
