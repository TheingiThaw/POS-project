@extends('admin.layouts.master')

@section('content')
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">


            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Code Lab</span>
                    <img class="img-profile rounded-circle" src="">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>

                    <a class="dropdown-item" href="">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Add New Admin Account
                    </a>
                    <a class="dropdown-item" href="">
                        <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                        Admin List
                    </a>

                    <a class="dropdown-item" href="">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        User List
                    </a>


                    <a class="dropdown-item" href="">
                        <i class="fa-solid fa-lock fa-sm fa-fw mr-2 text-gray-400"></i></i></i>
                        Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <span class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                        <form action="" method="post">

                            <input type="submit" class="btn btn-dark text-white w-100" value="Logout">
                        </form>
                    </span>
                </div>
            </li>

        </ul>
    </nav>
    <!-- End of Topbar -->

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
                            <form action="{{ route('category#update', $category->id) }}" method="post" class="p-3 rounded">
                                @csrf
                                <input type="text" name="categoryName" value="{{ $category->name }}"
                                    class=" form-control @error('categoryName') is-invalid @enderror "
                                    placeholder="Category Name...">

                                <input type="submit" value="Update" class="btn btn-outline-primary mt-3">
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
                            </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at->format('j-F-Y') }}</td>
                            </tr>



                        </tbody>
                    </table>

                    {{-- <span class=" d-flex justify-content-end">{{ $category->links() }}</span> --}}

                </div>
            </div>
        </div>

    </div>
@endsection
