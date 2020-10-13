@extends('layouts.admin')

@section('title','Category '.(isset($data) ? 'Update' : 'Add').' | Meropasal')
@section('scripts')
    <script>
        $('#is_parent').on('change', function (){
            let is_checked = $(this).prop("checked");
            if(is_checked){
                $('#parent_id').val('');
                $('#parent_cat_div').addClass('d-none');
            }else{
                $('#parent_cat_div').removeClass('d-none');
            }
        });
    </script>
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Category {{ isset($data) ? 'Update' : 'Add' }} Form</div>
                    <div class="ibox-tools">

                    </div>
                </div>
                <div class="ibox-body">
                    @if(isset($data))
                        {{Form::open(['url'=>route('category.update', $data->id),'class'=>'form','files'=>true])}}
                        @method('patch')
                    @else
                        {{Form::open(['url'=>route('category.store'),'class'=>'form','files'=>true])}}
                    @endif
                    <div class="form-group row">
                        {{Form::label('title', 'Title: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{Form::text('title',@$data->title,['class'=>'form-control form-control-sm','id'=>'title', 'require'=>true, 'placeholder'=>'Enter category title...' ])}}
                            @error('title')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('summary', 'Summary: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{Form::textarea('summary',@$data->summary,['class'=>'form-control form-control-sm','id'=>'summary', 'require'=>false, 'placeholder'=>'Enter Category Summary...', 'rows'=>5, 'style'=>'resize: none;' ])}}
                            @error('summary')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('is_parent', 'Is parent: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                             {{Form::checkbox('is_parent',1, ((isset($data) && $data->parent_id != null) ? false : true),['id'=>'is_parent'])}} yes
                                @error('is_parent')
                                <spam class="alert-danger">{{ $message }}</spam>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row {{ ((isset($data) && $data->parent_id != null) ? '' : 'd-none') }}" id="parent_cat_div">
                            {{Form::label('parent_id', 'Parent Category: ',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::select('parent_id',$parent_cat, @$data->parent_id,['class'=>'form-control form-control-sm', 'id'=>'parent_id','required'=>false,'placeholder'=>'--Select Any one --']) }}
                                @error('parent_id')
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
                            {{ Form::file('image',[ 'id'=>'image','required'=>(isset($data) ? false : true), 'accept'=>'image/&']) }}
                            @error('image')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                        @if(isset($data))
                            <div class="col-sm-4">
                                <img src="{{ asset('uploads/category/Thumb-'.$data->image) }}" alt="{{ $data->title }}" class="img img-fluid img-thumbnail">
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
