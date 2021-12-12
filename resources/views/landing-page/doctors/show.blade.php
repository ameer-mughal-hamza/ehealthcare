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
    <div id="app" class="row">
        <div class="row m-b-lg m-t-lg">
            <div class="col-md-6">
                <div class="profile-image">
                    <img src="img/a4.jpg" class="rounded-circle circle-border m-b-md" alt="profile">
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">
                                Alex Smith
                            </h2>
                            <h4>Founder of Groupeq</h4>
                            <small>
                                There are many variations of passages of Lorem Ipsum available, but the majority
                                have suffered alteration in some form Ipsum available.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <small>Ratings</small>
                <h2 class="no-margins">206 480</h2>
                <div id="sparkline1">
                    <canvas style="display: inline-block; width: 284.722px; height: 50px; vertical-align: top;"
                            width="284" height="50"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form class="ibox">
                <div class="text-center">
                    <textarea name="post"
                              placeholder="What's on your mind?" id="post" cols="30"
                              rows="5" class="form-control"
                              spellcheck="false"></textarea>
                </div>
                <div class="form-inline mt-3" style="display: flex; justify-content: space-between;">
                    <div class="form-group">
                        <select name="" id="" class="form-control">
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
                    <div class="social-comment">
                        <a href="" class="float-left">
                            <img alt="image" src="img/a1.jpg">
                        </a>
                        <div class="media-body">
                            <p>Andrew Williams</p>
                            Internet tend to repeat predefined chunks as necessary, making this the first true generator
                            on the Internet. It uses a dictionary of over 200 Latin words.
                            <br>
                            <b>Rating: 3</b> | 10.07.2014
                        </div>
                    </div>

                    <div class="social-comment">
                        <a href="" class="float-left">
                            <img alt="image" src="img/a2.jpg">
                        </a>
                        <div class="media-body">
                            <p>Andrew Williams</p>
                            Making this the first true generator on the Internet. It uses a dictionary of.
                            <br>
                            <b>Rating: 3</b> | 10.07.2014
                        </div>
                    </div>
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
        <div class="col-lg-4">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="rounded-circle" src="img/a2.jpg">


                    <h3 class="m-b-xs"><strong>John Smith</strong></h3>

                    <div class="font-bold">Graphics designer</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a href="" class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a href="" class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="rounded-circle" src="img/a2.jpg">


                    <h3 class="m-b-xs"><strong>John Smith</strong></h3>

                    <div class="font-bold">Graphics designer</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a href="" class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a href="" class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="contact-box center-version">

                <a href="profile.html">

                    <img alt="image" class="rounded-circle" src="img/a1.jpg">


                    <h3 class="m-b-xs"><strong>Alex Johnatan</strong></h3>

                    <div class="font-bold">CEO</div>
                    <address class="m-t-md">
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                </a>
                <div class="contact-box-footer">
                    <div class="m-t-xs btn-group">
                        <a href="" class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call </a>
                        <a href="" class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@include('landing-page.footer')
@endsection

@section('landing-js')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@endsection
