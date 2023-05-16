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
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                   
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Status:</strong>
                            @if ($driver->status == 1)
                                <a href="{{ route('changeStatus',$driver->id) }}" class="btn btn-success" role="button" aria-pressed="true">On line</a>
                                <br>
                                @php
                                    $pos = json_decode($driver->driver_pos,true);
                                @endphp
                            <strong>Driver Coordinates:</strong> {{ $pos['x'] }}, {{ $pos['y'] }}
                                <form method= "POST" action="{{ route('changeDriverPos',$driver->id) }}">
                                    @csrf
                                    <div class="mb-3 w-25">
                                        <label for="pos_x" class="form-label">X</label>
                                        <input type="number" min="0" max="1000" class="form-control" id="pos_x" name="pos_x">
                                    </div>
                                    <div class="mb-3 w-25">
                                        <label for="pos_y" class="form-label">Y</label>
                                        <input type="number" min="0" max="1000" class="form-control" id="pos_y" name="pos_y">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            @else
                                <a href="{{ route('changeStatus',$driver->id) }}" class="btn btn-danger" role="button" aria-pressed="true">Off line</a>
                            @endif
                        </div>    
                        
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
