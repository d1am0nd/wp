@extends('master')

@section('content')
<div class="container content">
<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
    {!! Form::open(['action' => 'AccountsController@postUsernameEdit', 'class' => 'reg-page']) !!}
    <div class="reg-header">
        <h2>Change username</h2>
        <h3>From {{ Auth::user()->username }}</h3>
    </div>

    <div class="input-group" @if($errors->count() < 1) style="display:none" @endif>
        <label class="control-label small red" page-error="username">{{ $errors->first() }}</label>
    </div>
    <div class="input-group margin-bottom-20">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        {!! Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'New username']) !!}
    </div>

    <div class="row">
        <div class="col-md-12">
            <button class="btn-u" type="submit">Change</button>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <h4>Or keep this way.</h4>
            <a class="btn-u btn-u-blue" href="{{ action('AccountsController@getConfirmUsername') }}">Keep</a>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <strong>Recommendation!</strong>
            <p>Since you logged in with a social network you are allowed to change your username once.</p>
        </div>
    </div>

    {!! Form::close() !!}
</div>
</div>
@stop

@section('foot')
<script>

</script>
@stop