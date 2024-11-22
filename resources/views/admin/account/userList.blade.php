@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class=" d-flex justify-content-between my-2">
            <a href="{{ route('admin#list') }}"> <button class=" btn btn-sm btn-secondary  "> Admin List</button> </a>
            <div class="">
                <form action="{{ route('user#list') }}" method="get">
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
                        @if (count($users) != 0)
                            @foreach ($users as $user)
                                <tr>
                                    <td><img src="{{ asset($user->profile != null ? 'profileImages/' . $user->profile : 'defaultImage/profileImg.png') }}"
                                            alt="" class="img w-50"></td>
                                    <td>{{ $user->name != null ? $user->name : $user->nickname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->address != null ? $user->address : 'N/A' }}</td>
                                    <td>{{ $user->phone != null ? $user->phone : 'N/A' }}</td>
                                    <td><span
                                            class="btn btn-sm bg-danger text-white rounded shadow-sm">{{ $user->role }}</span>
                                    </td>
                                    <td>{{ $user->created_at ? $user->created_at->format('j-F-Y') : 'N/A' }}</td>
                                    <td>
                                        @if ($user->provider == 'google')
                                            <i class="fa-brands fa-google"></i>
                                        @elseif ($user->provider == 'github')
                                            <i class="fa-brands fa-github"></i>
                                        @else
                                            {{ $user->provider }}
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        @if ($user->role == 'user')
                                            <button type="button" class="btn btn-outline-danger"
                                                onclick="confirmDelete({{ $user->id }})">
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

                <span class="d-flex justify-content-end">{{ $users->links() }}</span>


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
                        location.href = 'account/delete' + $id;
                    }, 1000);
                }
            });
        }
    </script>
@endsection
