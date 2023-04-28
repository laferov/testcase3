@extends('layouts.app')

@section('template_title')
    {{ $driver->name ?? "{{ __('Show') Driver" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Driver</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('drivers.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                            @if ($driver->status == 1)
                                <strong>Status:</strong> <a href="{{ route('changeStatus',$driver->id) }}" class="btn btn-success" role="button" aria-pressed="true">On line</a>
                            @else
                                <strong>Status:</strong> <a href="{{ route('changeStatus',$driver->id) }}" class="btn btn-danger" role="button" aria-pressed="true">Off line</a>
                            @endif
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $driver->name }}
                        </div>
                        <div class="form-group">
                            <strong>Phone Number:</strong>
                            {{ $driver->phone_number }}
                        </div>
                        <div class="form-group">
                            <strong>Car Info:</strong>
                            {{ $driver->car_info }}
                        </div>
                        <div class="form-group">
                            <strong>Car Reg Info:</strong>
                            {{ $driver->car_reg_info }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
