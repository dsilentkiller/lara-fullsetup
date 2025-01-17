@extends('layouts.admin-app')
@section('content')
    <section class="content">
        {{-- {{ Breadcrumbs::render('banner.create') }} --}}

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header" style="padding: 0px;">
                            <div class="card-title">New banner Setup</div>
                            <div>
                                <a class="btn btn-primary float-right" data-toggle="collapse" href="#collapseExample"
                                    role="button" aria-expanded="false" aria-controls="collapseExample">+ Create New</a>
                            </div>
                        </div>
                        <div class="card-body @if (!isset($banner)) collapse @endif" id="collapseExample">
                            <div class="container">
                                @if (isset($banner))
                                    <form class="form-inline" action="{{ route('banner.update', $banner) }}"
                                        method="post" enctype="multipart/form-data">
                                        {{ method_field('PATCH') }}
                                    @else
                                        <form class="form-inline" action="{{ route('banner.store') }}" method="post"
                                            enctype="multipart/form-data">
                                @endif
                                @csrf
                                {{-- title --}}
                                <div class="form-group m-2">
                                    <label for="staticEmail2" class="sr-only">Title</label>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ old('title', @$banner->title) }}" placeholder="Enter title">
                                    @error('title')
                                        <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- slug --}}
                                <div class="form-group m-2">
                                    <label for="title" class="sr-only">Slug</label>
                                    <input type="text" name="slug" class="form-control"
                                        value="{{ old('slug', @$banner->slug) }}" placeholder="Enter slug">
                                    @error('slug')
                                        <span> {{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- image --}}

                                <div class="form-group mx-sm-3 m-2">
                                    <label for="inputPassword2" class="sr-only">Choose Image</label>
                                    <input type="file" name="image" placeholder="choose an image">
                                    @error('image')
                                        <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success m-2">
                                    @if (isset($banner))
                                        Update
                                    @else
                                        Add
                                    @endif
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">banner List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Banner</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th colspan="3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($banners) && count($banners) > 0)
                                        @foreach ($banners as $banner)
                                            <tr>
                                                <td>{{ $n++ }}</td>
                                                <td>
                                                    <a href="{{ asset('uploads/banners/thumbnail/' . $banner->image) }}"><img
                                                            src="{{ asset('uploads/banners/thumbnail/' . $banner->image) }}"
                                                            height="80" width="150"></a>
                                                </td>
                                                <td>{{ $banner->title }}</td>
                                                <td>{{ $banner->price }}</td>
                                                <td>View</td>
                                                <td><a href="{{ route('banner.edit', $banner) }}">Edit</a></td>
                                                <td>
                                                    <form action="{{ route('banner.destroy', $banner) }}" method="post">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn btn-link">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">
                                                <center>No Record Found</center>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
