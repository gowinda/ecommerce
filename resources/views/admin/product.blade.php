@extends('layouts.admin')

@section('title','Product List Page | Meropasal')

@section('content')

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Product List</div>
                    <div class="ibox-tools">

                    </div>
                </div>
                <div class="ibox-body">

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Product Title</th>
                            <th>Category</th>
                            <th>Price(NRP. )</th>
                            <th>Discount(%)</th>
                            <th>Featured</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Seller</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data)
                            @foreach($data as $key => $info)
                                <tr>
                                    <td>{{ $info->title }}</td>
                                    <td>
                                        {{ $info->cat_info['title'] }}
                                        @if($info->sub_cat_id != null)
                                            <sub>
                                                <small>
                                                    {{ $info->sub_cat_info['title'] }}
                                                </small>
                                            </sub>
                                        @endif
                                    </td>

                                    <td>
                                        NPR. {{ number_format($info->price) }}
                                    </td>

                                    <td>
                                        @if($info->discount>0)
                                          {{ $info->discount."%" }}
                                        @else
                                            0%
                                        @endif

                                    </td>

                                    <td>
                                        {{($info->is_featured == 1) ? 'yes' : 'No'}}
                                    </td>

                                    <td>
                                        @if($info->images->count() > 0)
                                            @if(file_exists(public_path().'/uploads/product/Thumb-'.$info->images[0]->image_name))
                                                <img src="{{ asset('uploads/product/Thumb-'.$info->images[0]->image_name) }}" style="max-width: 150px" alt="{{ $info->title }}" class="img img-thumbnail img-fluid">
                                            @elseif(file_exists(public_path().'/uploads/product/'.$info->images[0]->image_name))
                                                <img src="{{ asset('uploads/product/'.$info->images[0]->image_name) }}" style="max-width: 150px" alt="{{ $info->title }}" class="img img-thumbnail img-fluid">
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
                                    <td>{{ $info->seller_info['name'] }}</td>
                                    <td>
                                        <a href="{{ route('product.edit', $info->id) }}" class="btn btn-success btn-sm float-left btn-rounded">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        {{Form::open(['url'=>route('product.destroy',$info->id), 'class'=>'form', 'onsubmit'=>'return confirm("Are you sure you want to delete?")']) }}
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
