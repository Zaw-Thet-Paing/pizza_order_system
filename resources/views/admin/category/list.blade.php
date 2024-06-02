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
                    <a href="category.html">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>Add Category
                        </button>
                    </a>
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        CSV download
                    </button>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Created Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tr-shadow">
                            <td>1</td>
                            <td>Samsung S8 Black</td>
                            <td>2018-09-27 02:12</td>
                            <td>
                                CRUD
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                        <tr class="tr-shadow">
                            <td>2</td>
                            <td>Samsung S8 Black</td>
                            <td>2018-09-27 02:12</td>
                            <td>
                                CRUD
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection
