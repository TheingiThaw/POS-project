@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <div id="content">

        <div class="container">
            <div class="row">
                <div class="col-8 offset-2 card p-3 shadow-sm rounded">

                    <form action="{{ route('product#create') }}" method="post" enctype="multipart/form-data">

                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <img class="img-profile mb-1 w-50" id="output">
                                <input type="file" accept="image/*" name="image"
                                    class="form-control mt-1 @error('image')
                                    invalid
                                @enderror"
                                    onchange="loadFile(event)">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control @error('name')
                                    invalid
                                @enderror"
                                            placeholder="Enter Name...">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Category Name</label>
                                        <select name="categoryId"
                                            class="form-control @error('category_name')
                                    invalid
                                @enderror">
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('categoryId') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" name="price" value="{{ old('price') }}"
                                            class="form-control @error('price')
                                    invalid
                                @enderror"
                                            placeholder="Enter Price...">
                                        @error('price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Stock</label>
                                        <input type="text" name="stock" value="{{ old('stock') }}"
                                            class="form-control @error('stock')
                                    invalid
                                @enderror"
                                            placeholder="Enter Stock...">
                                        @error('stock')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" cols="30" rows="10"
                                    class="form-control @error('description')
                                    invalid
            @enderror"
                                    placeholder="Enter Description...">{{ old('description') }}</textarea>

                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="submit" value="Create Product"
                                    class=" btn btn-primary w-100 rounded shadow-sm">
                            </div>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>
@endsection
