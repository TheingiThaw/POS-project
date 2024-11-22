@extends('customer.layouts.master')

@section('content')
    <div class="container-fluid py-5 mt-5">
        <form action="{{ route('contact#submit') }}" class="mt-5" method="post">
            @csrf

            <div class="w-25 m-auto">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text"
                        class="form-control @error('title')
                        is-invalid
                    @enderror"
                        id="title" name="title" value="{{ old('title') }}" placeholder="Enter title...">
                    @error('title')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control @error('message')
                        is-invalid
                    @enderror"
                        id="message" name="message" placeholder="Enter message..." rows="3">{{ old('message') }}</textarea>
                    @error('message')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="submit" value="Submit"
                        class="btn btn-sm btn-primary border-0 border-secondary rounded-pill py-2 px-4 text-white">
                </div>
            </div>

        </form>
    </div>
@endsection
