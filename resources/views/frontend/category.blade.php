@extends('layouts.frontend')
@section('title')
    category
@endsection
@section('content')

  <div class="py-5">
    <div class="container">
        <div class="row">
            <h2>All Category</h2>
            <div class="col-md-12">
                <div class="row">
                    @foreach ($category as $cat)

                    <div class="col-md-3 mb-3">
                        <a href="{{url('viewCategory/'.$cat->slug)}}">
                        <div class="card">
                            @if ($cat->image)
                                <img src="{{ asset('assets/category/' . $cat->image) }}" alt="Category image" height="220">
                            @else
                                <h6 class="text-center">لا توجد صورة </h6>
                            @endif
                            <div class="card-body">
                                <h5>{{ $cat->name }}</h5>
                                <p>
                                    {{ substr($cat->description , '0' , '50') }}
                                </p>
                            </div>
                        </div>
                    </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
  </div>

@endsection
