@extends('layouts.app')

@section('template_title')
    Driver
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Driver') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('drivers.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Name</th>
										<th>Phone Number</th>
										<th>Status</th>
										<th>Car Info</th>
										<th>Car Reg Info</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($drivers as $driver)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $driver->name }}</td>
											<td>{{ $driver->phone_number }}</td>
											<td>
                                                @if ($driver->status == 1)
                                                    <a href="{{ route('changeStatus',$driver->id) }}" class="btn btn-success" role="button" aria-pressed="true">On line</a>
                                                @else
                                                    <a href="{{ route('changeStatus',$driver->id) }}" class="btn btn-danger" role="button" aria-pressed="true">Off line</a>
                                                @endif
                                            </td>
											<td>{{ $driver->car_info }}</td>
											<td>{{ $driver->car_reg_info }}</td>

                                            <td>
                                                <form action="{{ route('drivers.destroy',$driver->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('drivers.show',$driver->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('drivers.edit',$driver->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $drivers->links() !!}
            </div>
        </div>
    </div>
@endsection
