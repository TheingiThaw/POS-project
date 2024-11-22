@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <div id="content">

        <div class="container">
            <div class="row">
                <div class="col-8 offset-2 card p-3 shadow-sm rounded">

                    <form action="{{ route('product#update', $product->id) }}" method="post" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="oldPhoto" value="{{ $product->image }}">

                        <div class="card-body">
                            <div class="mb-3">
                                <img class="img-profile mb-1 w-50" id="output"
                                    src="{{ asset("productImages/{$product->image}") }}">
                                <input type="file" name="image" id="" class="form-control mt-1 "
                                    onchange="loadFile(event)">
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ old('name', $product->name) }}"
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
                                        <select name="categoryId" id=""
                                            class="form-control @error('categoryId')
                                    invalid
                                @enderror">
                                            @if (count($categories) != 0)
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                        @error('categoryId')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" name="price" value="{{ old('price', $product->price) }}"
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
                                        <input type="text" name="stock" value="{{ old('stock', $product->stock) }}"
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
                                <textarea name="description" cols="30" rows="10" class="form-control " placeholder="Enter Password...">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="submit" value="Update Product"
                                    class=" btn btn-primary w-100 rounded shadow-sm">
                            </div>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>
@endsection
