@extends('master-landing')

@section('title', "E Health Care - Contact Us")

@section('landing-css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('nav')
    @include('landing-page.nav-no-scroll', ['cssClass' => 'navbar-scroll'])
@endsection

@section('content')
    <div class="container" style="margin-top: 75px;">
        <div id="app">
            <div class="row m-b-lg m-t-lg">
                <div class="col-md-6">
                    <div>
                        <h2 class="no-margins">
                            {{ $doctor->name }}
                        </h2>
                        @foreach($doctor->categories as $c)
                            <span class="label label-primary">{{ $c->name }}</span>
                        @endforeach
                        <p>
                            {{ $doctor->doctor->description }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <small>Ratings</small>
                    <h2 class="no-margins">{{ $reviews->count() }}</h2>
                    <div id="sparkline1">
                        <canvas style="display: inline-block; width: 284.722px; height: 50px; vertical-align: top;"
                                width="284" height="50"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form class="ibox" action="{{ route('submit_review') }}" method="POST">
                    @csrf
                    <div class="text-center">
                    <textarea name="description"
                              placeholder="Review"
                              maxlength="255" cols="30"
                              rows="5" class="form-control"
                              spellcheck="false"></textarea>
                    </div>
                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                    <div class="form-inline mt-3" style="display: flex; justify-content: space-between;">
                        <div class="form-group">
                            <select name="rating" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>

                <div class="social-feed-box">
                    <div class="social-footer">
                        @foreach($reviews as $review)
                            <div class="social-comment">
                                <div class="media-body">
                                    <h4>{{ $review->user->name }}</h4>
                                    <p>{{ $review->description }}</p>
                                    <b>Rating: {{ $review->rating }}</b> | {{ $review->created_at }}
                                </div>
                            </div>
                            @if(!$loop->last)
                                <hr>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1>Similar doctors</h1>
            </div>
        </div>
        <hr>
        <div class="row">
            @foreach($similar_doctors as $similar_doctor)
                <div class="col-lg-4">
                    <div class="contact-box center-version">
                        <a>
                            <img alt="image" class="rounded-circle" src="http://localhost:8000/img/landing/avatar2.jpg">
                            <h3 class="m-b-xs"><strong>{{ $similar_doctor->name }}</strong></h3>
                            <div class="font-bold">Graphics designer</div>
                            <address class="m-t-md">
                                <strong>Twitter, Inc.</strong><br>
                                {!! $similar_doctor->address->street . ", " . $similar_doctor->address->postal_code . " " . $similar_doctor->address->muncipility . ", <br>" . $similar_doctor->address->city . ", " . $similar_doctor->address->country !!}
                                <br><abbr title="Phone">P:</abbr> {{ $similar_doctor->doctor->mobile }}
                            </address>
                        </a>
                        <div class="contact-box-footer">
                            <div class="m-t-xs btn-group">
                                <a href="{{ url('/doctor/detail/'. $similar_doctor->id) }}"
                                   class="btn btn-xs btn-white">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('landing-page.footer')
@endsection

@section('landing-js')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@endsection
