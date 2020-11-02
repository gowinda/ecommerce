@extends('layouts.admin')

@section('title','Slider List Page | Meropasal')

@section('content')

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Slider List</div>
                    <div class="ibox-tools">

                    </div>
                </div>
                <div class="ibox-body">

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Slider Title</th>
                            <th>Link</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Added By</th>
                            <th width="91px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($data)
                                @foreach($data as $key => $info)
                                <tr>
                                    <td>{{ $info->title }}</td>
                                    <td>
                                        <a href="{{ $info->link }}" target="_slider">{{ $info->link }}</a>
                                    </td>
                                    <td>
                                        @if($info->image != null)
                                            @if(file_exists(public_path().'/uploads/slider/Thumb-'.$info->image))
                                                <img src="{{ asset('uploads/slider/Thumb-'.$info->image) }}" style="max-width: 150px" alt="{{ $info->title }}" class="img img-thumbnail img-fluid">
                                           @elseif(file_exists(public_path().'/uploads/slider/'.$info->image))
                                                <img src="{{ asset('uploads/slider/'.$info->image) }}" style="max-width: 150px" alt="{{ $info->title }}" class="img img-thumbnail img-fluid">
                                        @else
                                            No Image found.
                                        @endif
                                        @else
                                            No Image Uploaded
                                            @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ ($info->status == 'active') ? 'success' : 'danger' }}">
                                            {{ ($info->status == 'active' ? 'Published' : 'Un-published') }}
                                        </span>
                                    </td>
                                    <td>{{ $info->created_by['name'] }}</td>
                                    <td>
                                        <a href="{{ route('slider.edit', $info->id) }}" class="btn btn-success btn-sm float-left btn-rounded">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        {{Form::open(['url'=>route('slider.destroy',$info->id), 'class'=>'form', 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) }}
                                        @method('delete')
                                       <button type="submit" class="btn btn-danger btn-sm btn-rounded float-right">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        {{Form::close()}}
                                    </td>


                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
