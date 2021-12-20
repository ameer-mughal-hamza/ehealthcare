@foreach($result as $r)
    <div class="contact-box">
        <a class="row" href="{{ url('/doctor-detail/' . $r->id) }}">
            <div class="col-4">
                <div class="text-center">
                    <img alt="image" class="rounded-circle m-t-xs img-fluid"
                         src="{{ url('img/landing/avatar2.jpg') }}">
                    <div class="m-t-xs font-bold"></div>
                </div>
            </div>
            <div class="col-8">
                <h3><strong>{{ $r->first_name . ' ' . $r->last_name}}</strong></h3>
                <p>
                    <i class="fa fa-map-marker"></i> {!! $r->address->street . ", " . $r->address->postal_code . " " . $r->address->muncipility . ", <br>" . $r->address->city . ", " . $r->address->country !!}
                    <br/></p>
                <address>
                    <abbr title="Phone">P:</abbr> {{ $r->doctor->mobile }}
                </address>
            </div>
        </a>
    </div>
@endforeach
