<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $driver->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('phone_number') }}
            {{ Form::text('phone_number', $driver->phone_number, ['class' => 'form-control' . ($errors->has('phone_number') ? ' is-invalid' : ''), 'placeholder' => 'Phone Number']) }}
            {!! $errors->first('phone_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $driver->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('car_info') }}
            {{ Form::text('car_info', $driver->car_info, ['class' => 'form-control' . ($errors->has('car_info') ? ' is-invalid' : ''), 'placeholder' => 'Car Info']) }}
            {!! $errors->first('car_info', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('car_reg_info') }}
            {{ Form::text('car_reg_info', $driver->car_reg_info, ['class' => 'form-control' . ($errors->has('car_reg_info') ? ' is-invalid' : ''), 'placeholder' => 'Car Reg Info']) }}
            {!! $errors->first('car_reg_info', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>