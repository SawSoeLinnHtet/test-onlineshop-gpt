@extends('layouts.front-end')
@section('content')
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-6">
                      <img class="card-img-top mb-5 mb-md-0" src="{{ asset('images/black-hoodie-isolated-transparent-background-png_1073071-1121.avif') }}" alt="{{ $item->name }}" style="width: auto; height: 500px;"/>
                    </div>
                    <div class="col-md-6">
                        <!-- <div class="small mb-1">SKU: BST-498</div> -->
                        <h1 class="display-5 fw-bolder">{{$item->name}}</h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">$45.00</span>
                            <span>{{$item->price}}</span>
                        </div>
                        <p class="lead">{{$item->description}}</p>
                        <div class="d-flex">
                            <form action="{{ route('cart.add', $item->id) }}" method="POST" class="mt-3">
                              @csrf
                              <div class="input-group d-flex flex-row">
                                <input type="number" name="quantity" value="1" min="1" class="form-control p-3">
                                <button type="submit" class="btn btn-success ms-2 btn-add-to-cart">
                                    Add to Cart
                                </button>
                              </div>
                            </form>
                        </div>
                    </div>  
                </div>
            </div>
        </section>
        <!-- Related items section-->
        <section class="py-5 bg-light">
          <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related Products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

              @forelse($relatedItems as $prod)
                <div class="col mb-5">
                  <div class="card h-100">
                    <img 
                      class="card-img-top" 
                      src="{{ asset('storage/'.$prod->image) }}" 
                      alt="{{ $prod->name }}"
                    />
                    <div class="card-body p-4">
                      <div class="text-center">
                        <h5 class="fw-bolder">{{ $prod->name }}</h5>
                        <span>{{ number_format($prod->price,2) }} MMK</span>
                      </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                      <div class="text-center">
                        <a 
                          href="{{ route('shop.product', $prod->id) }}" 
                          class="btn btn-outline-dark mt-auto"
                        >
                          View Product
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              @empty
                <p class="text-center">No related products found.</p>
              @endforelse

            </div>
          </div>
        </section>

@endsection
