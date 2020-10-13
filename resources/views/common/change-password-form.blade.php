@extends('layouts.'.auth()->user()->role)

@section('title','Change Password Form')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Change Password Form</div>
                </div>
                <div class="ibox-body">
                        {{Form::open(['url'=>route('save-password',auth()->user()->role),'class'=>'form'])}}

                    <div class="form-group row">
                        {{Form::label('old_password', 'Current Password: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{Form::password('old_password',['class'=>'form-control form-control-sm','id'=>'old_password', 'require'=>true, 'placeholder'=>'Enter Current Password...' ])}}
                            @error('old_password')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('password', 'New Password: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{Form::password('password',['class'=>'form-control form-control-sm','id'=>'password', 'require'=>true, 'placeholder'=>'Enter New Password...' ])}}
                            @error('password')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('password_confirmation', 'Confirm Password: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{Form::password('password_confirmation',['class'=>'form-control form-control-sm','id'=>'password_confirmation', 'require'=>true, 'placeholder'=>'Re-enter New Password...' ])}}
                        </div>
                    </div>



                    <div class="form-group row">
                        {{Form::label('', '',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{ Form::button('<i class="fa fa-trash"></i> Reset', ['class'=>'btn btn-danger btn-sm', 'type'=>'reset']) }}
                            {{ Form::button('<i class="fa fa-paper-plane"></i> Submit', ['class'=>'btn btn-success btn-sm', 'type'=>'submit']) }}
                        </div>
                    </div>

                    {{Form::close()}}

                </div>
            </div>
        </div>

    </div>

@endsection
