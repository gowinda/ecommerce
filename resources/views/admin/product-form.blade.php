@extends('layouts.admin')

@section('title','Product '.(isset($data) ? 'Update' : 'Add').' | Meropasal')
@section('styles')
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('scripts')
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $('#detail').summernote({
            height: 150
        });

        $('#cat_id').on('change', function (){
            let cat_id = $(this).val();
            let sub_cat_id = "{{ isset($data, $data->sub_cat_id) ? $data->sub_cat_id : null }}";
            $.ajax({
                url: "{{ route('get-child') }}",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    cat_id: cat_id
                },
                success:function (response){
                    if(typeof(response) != "object"){
                        response = $.parseJSON(response);
                    }

                    var html_option = "<option value='' selected>--Select Any One--</option>";

                    if(response.status){
                        $.each(response.data, function (key, value){
                            html_option += "<option value='"+key+"' ";
                            if(key == sub_cat_id){
                                html_option += ' selected ';
                            }
                            html_option += ">"+value+"</option>";
                        });
                        $('#sub_cat_div').removeClass('d-none')
                    }else {
                        $('#sub_cat_div').addClass('d-none')

                    }
                    $('#sub_cat_id').html(html_option);
                }
            });
        });

        $('#cat_id').change();
    </script>
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Product {{ isset($data) ? 'Update' : 'Add' }} Form</div>
                    <div class="ibox-tools">

                    </div>
                </div>
                <div class="ibox-body">
                    @if(isset($data))
                        {{Form::open(['url'=>route('product.update', $data->id),'class'=>'form','files'=>true])}}
                        @method('patch')
                    @else
                        {{Form::open(['url'=>route('product.store'),'class'=>'form','files'=>true])}}
                    @endif
                    <div class="form-group row">
                        {{Form::label('title', 'Title: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{Form::text('title',@$data->title,['class'=>'form-control form-control-sm','id'=>'title', 'require'=>true, 'placeholder'=>'Enter product title...' ])}}
                            @error('title')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('summary', 'Summary: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{Form::textarea('summary',@$data->summary,['class'=>'form-control form-control-sm','id'=>'summary', 'require'=>false, 'placeholder'=>'Enter Product Summary...', 'rows'=>5, 'style'=>'resize: none;' ])}}
                            @error('summary')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                    </div>
                        <div class="form-group row">
                            {{Form::label('detail', 'Detail Description: ',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::textarea('detail',@$data->detail,['class'=>'form-control form-control-sm','id'=>'detail', 'require'=>false, 'placeholder'=>'Enter Product Summary...', 'rows'=>5, 'style'=>'resize: none;' ])}}
                                @error('detail')
                                <spam class="alert-danger">{{ $message }}</spam>
                                @enderror
                            </div>
                        </div>

                    <div class="form-group row">
                        {{Form::label('cat_id', 'Category: ',['class'=>'col-sm-3'])}}
                        <div class="col-sm-9">
                            {{ Form::select('cat_id',$category, @$data->cat_id,['class'=>'form-control form-control-sm', 'id'=>'cat_id','required'=>false,'placeholder'=>'--Select Any one --']) }}
                            @error('cat_id')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                    </div>

                        <div class="form-group row d-none" id="sub_cat_div">
                            {{Form::label('sub_cat_id', 'Sub Category: ',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::select('sub_cat_id',[], @$data->sub_cat_id,['class'=>'form-control form-control-sm', 'id'=>'sub_cat_id','required'=>false,'placeholder'=>'--Select Any one --']) }}
                                @error('sub_cat_id')
                                <spam class="alert-danger">{{ $message }}</spam>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{Form::label('price', 'Price (NPR ): ',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::number('price',@$data->price,['class'=>'form-control form-control-sm','id'=>'price', 'require'=>true, 'placeholder'=>'Enter product price...', 'min'=>100])}}
                                @error('price')
                                <spam class="alert-danger">{{ $message }}</spam>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{Form::label('discount', 'Discount (% ): ',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::number('discount',@$data->discount,['class'=>'form-control form-control-sm','id'=>'discount', 'require'=>false, 'placeholder'=>'Enter product discount...', 'min'=>0, 'max'=>70])}}
                                @error('discount')
                                <spam class="alert-danger">{{ $message }}</spam>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{Form::label('brand', 'Brand: ',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::text('brand',@$data->brand,['class'=>'form-control form-control-sm','id'=>'brand', 'require'=>false, 'placeholder'=>'Enter product brand...'])}}
                                @error('brand')
                                <spam class="alert-danger">{{ $message }}</spam>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{Form::label('is_featured', 'Is Featured: ',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{Form::checkbox('is_featured',1, ((isset($data) && $data->is_fratured != null) ? false : true),['id'=>'is_featured'])}} yes
                                @error('is_featured')
                                <spam class="alert-danger">{{ $message }}</spam>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{Form::label('seller_id', 'Vendor: ',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::select('seller_id',$seller, @$data->seller_id,['class'=>'form-control form-control-sm', 'id'=>'seller_id','required'=>false,'placeholder'=>'--Select Any one --']) }}
                                @error('seller_id')
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
                            {{ Form::file('image[]',['multiple'=>true ,'id'=>'image','required'=>(isset($data) ? false : true), 'accept'=>'image/&']) }}
                            @error('image')
                            <spam class="alert-danger">{{ $message }}</spam>
                            @enderror
                        </div>
                    </div>

                        @if(isset($data) && $data->images->count() > 0)
                            <div class="form-group row">
                                @foreach($data->images as $image_info)
                                    <div class="col-2">
                                        <img src="{{ asset('uploads/product/Thumb-'.$image_info->image_name) }}" alt="" class="img img-thumbnail img-fluid">
                                        {{ Form::checkbox('del_image[]', $image_info->image_name, false) }} Delete
                                    </div>
                                @endforeach
                            </div>
                            @endif

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
