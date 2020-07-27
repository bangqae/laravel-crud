@extends('layouts.master')

@section('header')
<title>Post</title>
@endsection

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Post</h3>
                            <div class="right">

                            </div>
                        </div>
                        <div class="panel-body ">
                            <p class="demo-button">
                                <a href="{{ route('posts.add') }}" class="btn btn-primary">Add New Post</a>
                            </p>
                            <p class="demo-button">
                                <div class="table-responsive">
                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Title</th>
                                                <th>User</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        @foreach($posts as $post)

                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>
                                                <a href="{{ route('sites.singlepost', $post->slug) }}"
                                                    class="btn btn-info btn-sm" target="_blank">View</a>
                                                <a href={{ url("/post/{$post->id}/edit") }}
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <a href="#" class="btn btn-danger btn-sm delete"
                                                    post-id="{{ $post->id }}">Delete</a>
                                            </td>
                                        </tr>

                                        @endforeach
                                    </table>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
    $('.delete').click(function(){
        var post_id = $(this).attr('post-id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location = "/post/"+ post_id +"/delete";
            }
        });
    });
</script>
@stop
