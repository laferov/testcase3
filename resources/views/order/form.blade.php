<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('from') }}
            {{ Form::number('from_x', 1,['class' => 'form-control w-25','placeholder' => 'from_x', 'min' => 0, 'max' => 1000]) }}
            {{ Form::number('from_y', 1,['class' => 'form-control w-25','placeholder' => 'from_y', 'min' => 0, 'max' => 1000]) }}

            {{-- {{ Form::text('from_y', 'from_y', ['class' => 'form-control' . ($errors->has('from') ? ' is-invalid' : ''), 'placeholder' => 'From']) }}
            {!! $errors->first('from', '<div class="invalid-feedback">:message</div>') !!} --}}
        </div>
        <div class="form-group">
            {{ Form::label('to') }}
            {{ Form::number('to_x', 1,['class' => 'form-control w-25','placeholder' => 'to_x', 'min' => 0, 'max' => 1000]) }}
            {{ Form::number('to_y', 1,['class' => 'form-control w-25','placeholder' => 'to_y', 'min' => 0, 'max' => 1000]) }}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>