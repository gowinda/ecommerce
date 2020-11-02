@extends('layouts.admin')

@section('title','Page List  | Meropasal')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Page List</div>
                    <div class="ibox-tools">

                    </div>
                </div>
                <div class="ibox-body">

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Page Title</th>
                            <th>Summary</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Updated By</th>
                            <th width="91px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data)
                            @foreach($data as $key => $info)
                                <tr>
                                    <td>{{ $info->title }}</td>
                                    <td>
                                        {{$info->summary}}
                                    </td>
                                    <td>
                                        @if($info->image != null)
                                            @if(file_exists(public_path().'/uploads/page/Thumb-'.$info->image))
                                                <img src="{{ asset('uploads/page/Thumb-'.$info->image) }}" style="max-width: 150px" alt="{{ $info->title }}" class="img img-thumbnail img-fluid">
                                            @elseif(file_exists(public_path().'/uploads/page/'.$info->image))
                                                <img src="{{ asset('uploads/page/'.$info->image) }}" style="max-width: 150px" alt="{{ $info->title }}" class="img img-thumbnail img-fluid">
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
                                    <td>{{ $info->user_info['name'] }}</td>
                                    <td>
                                        <a href="{{ route('page.edit', $info->id) }}" class="btn btn-success btn-sm float-left btn-rounded">
                                            <i class="fa fa-edit"></i>
                                        </a>

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
