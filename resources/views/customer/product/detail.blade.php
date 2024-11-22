@extends('customer.layouts.master')

@section('content')
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <a href="{{ route('user#home') }}"> Home </a> <i class=" mx-1 mb-4 fa-solid fa-greater-than"></i> Details
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ asset('productImages/' . $product->image) }}" class="img-fluid rounded"
                                        alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold">{{ $product->name }}</h4>
                            <span class="text-danger mb-3">({{ $product->stock }} items left ! )</span>
                            <p class="mb-3">Category: {{ $product->category_name }}</p>
                            <h5 class="fw-bold mb-3"> {{ $product->price }} mmk</h5>
                            <div class="d-flex mb-4">
                                <span class=" ">
                                    @for ($i = 1; $i <= $ratings; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                    @for ($j = $ratings + 1; $j <= 5; $j++)
                                        <i class="fa-regular fa-star"></i>
                                    @endfor
                                </span>

                                <span class=" ms-4">
                                    {{-- <i class="fa-solid fa-eye"></i> --}}
                                </span>

                            </div>
                            <p class="mb-4">{{ Str::words($product->description, 15, '....') }}</p>
                            <form action="{{ route('user#addToCart') }}" method="post">
                                @csrf
                                <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="productId" value="{{ $product->id }}">

                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="count"
                                        class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>


                                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                                        class="fa-solid fa-star me-2 text-secondary"></i> Rate this product</button>
                            </form>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Rate this product
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('product#rate') }}" method="post">
                                            @csrf
                                            <div class="modal-body">

                                                <input type="hidden" name="productId" value="{{ $product->id }}">

                                                <div class="rating-css">
                                                    <div class="star-icon">
                                                        @if ($userRating)
                                                            @for ($i = 1; $i <= $ratings; $i++)
                                                                <input type="radio" value="{{ $i }}"
                                                                    name="productRating" checked
                                                                    id="rating{{ $i }}">
                                                                <label for="rating{{ $i }}"
                                                                    class="fa fa-star"></label>
                                                            @endfor
                                                            @for ($j = $ratings + 1; $j <= 5; $j++)
                                                                <input type="radio" value="{{ $j }}"
                                                                    name="productRating" id="rating{{ $j }}">
                                                                <label for="rating{{ $j }}"
                                                                    class="fa fa-star"></label>
                                                            @endfor
                                                        @else
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <input type="radio" value="{{ $i }}"
                                                                    name="productRating" id="rating{{ $i }}"
                                                                    @if ($i === 1) checked @endif>
                                                                <label for="rating{{ $i }}"
                                                                    class="fa fa-star"></label>
                                                            @endfor
                                                        @endif

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Rating</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-about" aria-controls="nav-about"
                                        aria-selected="true">Description</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Customer Comments <span
                                            class=" btn btn-sm btn-secondary rounted shadow-sm">{{ count($comments) }}</span>

                                    </button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab">
                                    <p>{{ $product->description }}</p>
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">

                                    @if (count($comments) != 0)
                                        @foreach ($comments as $comment)
                                            <div class="d-flex">
                                                <img src="{{ asset($comment->userImage ? 'profileImages/' . $comment->userImage : 'defaultImage/profileImg.png') }}"
                                                    class="img-fluid rounded-circle p-3"
                                                    style="width: 100px; height: 100px;">
                                                <div class="">
                                                    <p class="" style="font-size: 14px;">
                                                        {{ $comment->name }}
                                                    </p>
                                                    <div class="d-flex justify-content-between">
                                                        <h5>{{ $comment->comment }}</h5>

                                                    </div>
                                                    <p>{{ $comment->created_at->format('j-F-Y') }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    @endif


                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et
                                        tempor
                                        sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <hr>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                                        labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('product#comment') }}" method="post">
                            @csrf
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <h4 class="mb-5 fw-bold">
                                Leave a Comments

                            </h4>

                            <div class="row g-1">
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded ">
                                        <textarea name="comment" id="" class="form-control border-0 shadow-sm" cols="30" rows="8"
                                            placeholder="Your Review *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <button type="submit"
                                            class="btn border border-secondary text-primary rounded-pill px-4 py-3">
                                            Post
                                            Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">


                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="{{ asset('product/' . $product->image) }}" style="height: 250px"
                                class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">{{ $product->category_name }}</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>{{ $product->name }}</h4>
                            <p>{{ Str::words($product->description, 15, '...') }}</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold">{{ $product->price }} mmk</p>
                                <a href="#"
                                    class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection
