@extends('layouts.admin')

@section('title','Category List Page | Meropasal')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Category List</div>
                    <div class="ibox-tools">

                    </div>
                </div>
                <div class="ibox-body">

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Category Title</th>
                            <th>Parent</th>
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
                                        {{$info->parent_info['title']}}
                                    </td>
                                    <td>
                                        @if($info->image != null)
                                            @if(file_exists(public_path().'/uploads/category/Thumb-'.$info->image))
                                                <img src="{{ asset('uploads/category/Thumb-'.$info->image) }}" style="max-width: 150px" alt="{{ $info->title }}" class="img img-thumbnail img-fluid">
                                            @elseif(file_exists(public_path().'/uploads/category/'.$info->image))
                                                <img src="{{ asset('uploads/category/'.$info->image) }}" style="max-width: 150px" alt="{{ $info->title }}" class="img img-thumbnail img-fluid">
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
                                        <a href="{{ route('category.edit', $info->id) }}" class="btn btn-success btn-sm float-left btn-rounded">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        {{Form::open(['url'=>route('category.destroy',$info->id), 'class'=>'form', 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) }}
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

                    {{ $data->links() }}
                </div>
            </div>
        </div>

    </div>

@endsection
