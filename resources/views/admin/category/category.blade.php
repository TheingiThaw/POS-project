@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category List</h1>
        </div>

        <div class="">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body shadow">
                            <form action="{{ route('category#create') }}" method="post" class="p-3 rounded">
                                @csrf
                                <input type="text" name="categoryName" value=""
                                    class=" form-control @error('categoryName')
                                        invalid
                                    @enderror "
                                    placeholder="Category Name...">
                                @error('categoryName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <input type="submit" value="Create" class="btn btn-outline-primary mt-3">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <table class="table table-hover shadow-sm ">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Created Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($categories) != 0)
                                @foreach ($categories as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->created_at->format('j-F-Y') }}</td>
                                        <td>
                                            <a href="{{ route('category#edit', $item->id) }}"
                                                class="btn btn-sm btn-outline-secondary">
                                                Edit </a>
                                            <a href="{{ route('category#delete', $item->id) }}"
                                                class="btn btn-sm btn-outline-danger">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <h3 class="text-muted">
                                    There is no data
                                </h3>
                            @endif

                        </tbody>
                    </table>

                    <span class=" d-flex justify-content-end"></span>

                </div>

            </div>
        </div>

    </div>

@endsection
