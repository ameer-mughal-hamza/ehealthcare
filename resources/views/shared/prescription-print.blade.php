@extends('master-admin')
@section('title', $title)

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-content p-xl">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Doctor Details:</h5>
                            <address><strong>{{ $doctor->name }}</strong>
                                <br>
                                <p>{!! $address !!}</p>
                                <abbr title="Phone">P:</abbr> {{ $mobile }}
                            </address>
                        </div>

                        <div class="col-sm-6 text-right">
                            <span>Patient Details:</span>
                            <address>
                                <strong>{{ $patient->name }}</strong><br>
                            </address>
                            <p>
                                <span><strong>Date: </strong>{{ $date }}</span><br/>
                            </p>
                        </div>
                    </div>

                    <div class="table-responsive m-t">
                        <table class="table invoice-table">
                            <thead>
                            <tr>
                                <th>Medicine Name</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($medicine as $med)
                                <tr>
                                    <td>
                                        <div>
                                            <h2>{{ $med->name }}</h2>
                                        </div>
                                        <p>{{ $med->description ?? ''  }}</p>
                                    </td>
                                    <td>{{ $med->quantity }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="well m-t"><strong>Comments</strong>
                        {{ $prescription->remarks }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('admin-js')
    <script type="text/javascript">
        window.print();
    </script>
@endsection
