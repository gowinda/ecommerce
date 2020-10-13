@extends('layouts.admin')

@section('title','Slider '.(isset($data) ? 'Update' : 'Add').' | Meropasal')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Slider {{ isset($data) ? 'Update' : 'Add' }} Form</div>
                    <div class="ibox-tools">

                    </div>
                </div>
                <div class="ibox-body">
                    @if(isset($data))
                        {{Form::open(['url'=>route('slider.update', $data->id),'class'=>'form','files'=>true])}}
                        @method('patch')
                    @else
                        {{Form::open(['url'=>route('slider.store'),'class'=>'form','files'=>true])}}
                    @endif
                        <div class="form-group row">
                            {{Form::label('title', 'Title: ',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::text('title',@$data->title,['class'=>'form-control form-control-sm','id'=>'title', 'require'=>true, 'placeholder'=>'Enter slider title...' ])}}
                                    @error('title')
                                <spam class="alert-danger">{{ $message }}</spam>
                                @enderror
                            </div>
                        </div>

                    <div class="form-group row">
                        {{Form::label('link', 'Link: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{Form::url('link',@$data->link,['class'=>'form-control form-control-sm','id'=>'link', 'require'=>false, 'placeholder'=>'Enter slider link...' ])}}
                            @error('link')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
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
                            {{ Form::file('image',[ 'id'=>'image','required'=>(isset($data) ? false : true), 'accept'=>'image/&']) }}
                            @error('image')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                        @if(isset($data))
                            <div class="col-sm-4">
                                <img src="{{ asset('uploads/slider/Thumb-'.$data->image) }}" alt="{{ $data->title }}" class="img img-fluid img-thumbnail">
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
