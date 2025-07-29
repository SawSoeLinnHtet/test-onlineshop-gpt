@extends('layouts.front-end')
@section('content')

        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">One & All</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Anything need in one place</p>
                </div>
            </div>
        </header>
        <!-- Category section -->
         <section class="py-5">
          <div class="container px-4 mt-5 d-flex">
            <div style="width: 20%">
              <p class="mb-4">Browse by Category</p>
              <div class="row row-cols-1 row-cols-md-3 row-cols-xl-4">
                <div class="card card-body">
                  <form action="{{ route('shop.home')}}" method="GET">
                    @foreach($categories as $key => $category)
                      <div class="form-group d-flex align-items-center mb-3">
                        <input type="radio" name="category_id" id="category_{{$key}}" value="<input type="radio" name="" id=""><label class="ms-3" style="text-transform: capitalize" for="category_{{$key}}">{{ $category->name }}</label>
                      </div>
                    @endforeach
                  </form>
                </div>
              </div>
            </div>
            <div style="width: 80%">
              <h4 class="text-center">Hot Sales</h4>
              <div class="container px-4 px-lg-5 mt-5">
                  <div class="row gx-2 gx-lg-5 row-cols-3 row-cols-md-3 row-cols-xl-3 justify-content-center">
                  @foreach($items as $item)
                      <div class="col mb-5">
                          <div class="card p-2 h-100">
                              <!-- Sale badge-->
                              @if($item->discount > 0)
                              <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">{{ $item->discount }}%Off</div>
                              @endif
                              <!-- Product image-->
                              <img class="card-img-top" style="max-width: 100%; max-height: 250px;, margin:0 auto;" src="{{ $item->image }}" alt="{{ $item->name }}" />
                              <!-- Product details-->
                              <div class="card-body p-2">
                                  <div class="text-left">
                                      <!-- Product name-->
                                      <h5 class="fw-bolder">{{$item->name}}</h5>
                                      <!-- Product price-->
                                      @if($item->discount > 0 )
                                        <span class="text-secondary font-xs text-decoration-line-through">{{$item->price}}</span>
                                        <span class="text-info">{{$item->price - (($item->discount/100)* $item->price)}} MMK</span>
                                      @else
                                        {{$item->price}} MMK
                                      @endif
                                  </div>
                              </div>
                              <!-- Product actions-->
                              <div class="px-2 pt-0 border-top-0 bg-transparent">
                                  <div class="text-left">
                                    <a class="btn btn-outline-dark mt-auto" href="{{ route('shop.product', $item->id) }}">
                                      <i class="bi bi-bag-plus me-2"></i>Add To Cart
                                    </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  @endforeach
                  </div>
              </div>
            </div>
          </div>
        </section>
@endsection
