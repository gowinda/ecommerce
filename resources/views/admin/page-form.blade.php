@extends('layouts.admin')

@section('title','Page '.(isset($data) ? 'Update' : 'Add').' | Meropasal')
@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('scripts')
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $('#description').summernote({
            height: 150
        });
    </script>
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Page {{ isset($data) ? 'Update' : 'Add' }} Form</div>
                    <div class="ibox-tools">

                    </div>
                </div>
                <div class="ibox-body">
                        {{Form::open(['url'=>route('page.update', $data->id),'class'=>'form','files'=>true])}}
                        @method('patch')

                    <div class="form-group row">
                        {{Form::label('title', 'Title: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{Form::text('title',@$data->title,['class'=>'form-control form-control-sm','id'=>'title', 'require'=>true, 'placeholder'=>'Enter page title...' ])}}
                            @error('title')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('summary', 'Summary: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{Form::textarea('summary',@$data->summary,['class'=>'form-control form-control-sm','id'=>'summary', 'require'=>false, 'placeholder'=>'Enter Page Summary...', 'rows'=>5, 'style'=>'resize: none;' ])}}
                            @error('summary')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                    </div>

                        <div class="form-group row">
                            {{Form::label('description', 'Detail Description: ',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::textarea('description',@$data->description,['class'=>'form-control form-control-sm','id'=>'description', 'require'=>false, 'placeholder'=>'Enter Product Summary...', 'rows'=>5, 'style'=>'resize: none;' ])}}
                                @error('description')
                                <spam class="alert-danger">{{ $message }}</spam>
                                @enderror
                            </div>
                        </div>

                    <div class="form-group row ">
                        {{Form::label('status', 'Status: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{ Form::select('status',['active'=>'Published', 'inactive'=>'Un-published'], @$data->status,['class'=>'form-control form-control-sm', 'id'=>'status','required'=>true]) }}
                            @error('status')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('image', 'Image: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-4">
                            {{ Form::file('image',[ 'id'=>'image','required'=>(isset($data) ? false : true), 'accept'=>'image/*']) }}
                            @error('image')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                        @if(isset($data))
                            <div class="col-sm-4">
                                <img src="{{ asset('uploads/page/Thumb-'.$data->image) }}" alt="{{ $data->title }}" class="img img-fluid img-thumbnail">
                            </div>
                        @endif
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
