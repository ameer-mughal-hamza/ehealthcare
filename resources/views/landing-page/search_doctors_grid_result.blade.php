@foreach($result as $r)
    <div class="col-lg-4">
        <div class="contact-box center-version">
            <a href="{{ url('/doctor-find/1') }}">
                <img
                    alt="image"
                    class="rounded-circle"
                    src="{{ url('img/landing/avatar2.jpg') }}"
                />
                <h3 class="m-b-xs"><strong>{{ $r->first_name . ' ' . $r->last_name}}</strong></h3>
                <div class="font-bold">Graphics designer</div>
                <address class="m-t-md">
                    <strong>Twitter, Inc.</strong><br/>
                    795 Folsom Ave, Suite 600<br/>
                    San Francisco, CA 94107<br/>
                    <abbr title="Phone">P:</abbr> (123) 456-7890
                </address>
            </a>
            <div class="contact-box-footer">
                <div class="m-t-xs btn-group">
                    <a href="" class="btn btn-xs btn-white"><i class="fa fa-phone"></i> Call</a>
                    <a href="" class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Email</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
