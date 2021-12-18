@foreach($result as $r)
    <div class="contact-box">
        <a class="row" href="{{ url('/doctor-detail/') . $r->id }}">
            <div class="col-4">
                <div class="text-center">
                    <img alt="image" class="rounded-circle m-t-xs img-fluid"
                         src="{{ url('img/landing/avatar2.jpg') }}">
                    <div class="m-t-xs font-bold"> </div>
                </div>
            </div>
            <div class="col-8">
                <h3><strong>{{ $r->first_name . ' ' . $r->last_name}}</strong></h3>
                <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                <address>
                    <strong>Twitter, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    <abbr title="Phone">P:</abbr> (123) 456-7890
                </address>
            </div>
        </a>
    </div>
@endforeach
