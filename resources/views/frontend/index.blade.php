@extends('layouts.frontend')
@section('title')
    Welcom To E-Shop
@endsection
@section('content')
    @include('layouts.inc.frontslider')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Features Products</h2>
                <div class="owl-carousel features-carousel owl-theme">

                    @foreach ($featuresProduct as $prod)
                        <div class="item">


                            <div class="card">
                                @if ($prod->image)
                                    <img src="{{ asset('assets/product/' . $prod->image) }}" alt="Product image" height="150"
                                        srcset="">
                                @else
                                    <h6 class="text-center">لا توجد صورة </h6>
                                @endif
                                <div class="card-body">
                                    <h5>{{ $prod->name }}</h5>
                                    <span class="float-start text-success">{{ $prod->selling_price }} $</span>
                                    <span class="float-end text-danger"><s>{{ $prod->original_price }}</s> $</span><br>
                                    <p> doc: {{substr($prod->description ,0,50) }}</p>
                                </div>
                            </div>
                        

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Trending Category</h2>
                <div class="owl-carousel features-carousel owl-theme">

                    @foreach ($trindengCategory as $cat)
                        <div class="item">
                            <a href="{{url('viewCategory/'.$cat->slug)}}">
                            <div class="card">
                                @if ($cat->image)
                                    <img src="{{ asset('assets/category/' . $cat->image) }}" alt="Image image" height="150"
                                        srcset="">
                                @else
                                    <h6 class="text-center">لا توجد صورة </h6>
                                @endif
                                <div class="card-body">
                                    <h5>{{ $cat->name }}</h5>

                                    <p>  {{substr($cat->description ,0,50) }}</p>
                                </div>
                            </div>
                        </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.features-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>
@endsection
