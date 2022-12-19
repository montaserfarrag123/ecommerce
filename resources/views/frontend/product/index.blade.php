@extends('layouts.frontend')
@section('title')
{{$category->name}}
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h4 class="mb-0">
            collection / {{$category->name}} 
        </h4>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>{{$category->name}}</h2>
                @foreach ($product as $prod)
                    <div class="col-md-3 mb-3">
                        <a href="{{url('viewCategory/'.$category->slug.'/'.$prod->slug)}}">
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
                    </a>
                    </div>
                @endforeach
        </div>
    </div>
</div>
@endsection

