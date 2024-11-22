@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class=" d-flex justify-content-between my-2">
            <a href="{{ route('user#list') }}"> <button class=" btn btn-sm btn-secondary  "> User List</button> </a>
            <div class="">
                <form action="{{ route('admin#list') }}" method="get">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="searchKey" value="" class=" form-control"
                            placeholder="Enter Search Key...">
                        <button type="submit" class=" btn bg-dark text-white"> <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover shadow-sm ">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Created Date</th>
                            <th> Platform</th>
                            <th>Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($admins) != 0)
                            @foreach ($admins as $admin)
                                <tr>
                                    <td><img src="{!! asset($admin->profile != null ? 'profileImages/' . $admin->profile : 'defaultImage/profileImg.png') !!}" alt="" class="img w-50"></td>
                                    <td>{{ $admin->name != null ? $admin->name : $admin->nickname }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->address != null ? $admin->address : 'N/A' }}</td>
                                    <td>{{ $admin->phone != null ? $admin->address : 'N/A' }}</td>
                                    <td><span
                                            class="btn btn-sm bg-danger text-white rounded shadow-sm">{{ $admin->role }}</span>
                                    </td>

                                    <td> {{ $admin->created_at ? $admin->created_at->format('j-F-Y') : 'N/A' }}</td>

                                    <td>
                                        {{ $admin->provider }}
                                    </td>
                                    <td class="d-flex">
                                        @if ($admin->role == 'admin')
                                            <button type="button" class="btn btn-outline-danger"
                                                onclick="confirmDelete({{ $admin->id }})">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center text-muted">There is no data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <span class="d-flex justify-content-end">{{ $admins->links() }}</span>


            </div>
        </div>
    </div>
@endsection

@section('js-script')
    <script>
        function confirmDelete($id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });

                    setInterval(() => {
                        location.href = 'product/delete' + $id;
                    }, 1000);
                }
            });
        }
    </script>
@endsection
