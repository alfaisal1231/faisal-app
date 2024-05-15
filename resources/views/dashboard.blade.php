@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>Hello, {{ auth()->user()->name }}</h1>
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="row px-4 mx-auto mt-5">

                        <div class="p-6 m-14 bg-white rounded shadow">
                            {!! $chart->container() !!}
                        </div>
                        <div class="row">
                            <div class="col">
                                        <h5 style="text-align: center">Total Transaction</h5>
                                        <h1 style="text-align: center">{{ $cBooking }}</h1>
                            </div>
                            <div class="col">
                                        <h5 style="text-align: center">Total User</h5>
                                        <h1 style="text-align: center">{{ $cUser }}</h1>
                            </div>
                            <div class="col">
                                        <h5 style="text-align: center">Total Facilitas</h5>
                                        <h1 style="text-align: center">{{ $cFacility }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
@endsection