@extends('layouts.master')

@section('header')
<title>Edit Post</title>
@endsection

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Post {{ $post->title }}</h3>
                        </div>
                        <div class="panel-body ">
                            <div class="row">
                                <form action="{{ route('posts.update', $post->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    {{-- @method('patch') --}}
                                    @csrf
                                    <div class="col-md-8"> {{-- form --}}
                                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                            <label for="">Title</label>
                                            <input name="title" type="text" class="form-control" id=""
                                                aria-describedby="emailHelp" placeholder="Title"
                                                value="{{ $post->title }}">
                                            @if($errors->has('title'))
                                            <span class="help-block">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="">Content</label>
                                            <textarea name="content" class="form-control" id="content"
                                                rows="2">{{ $post->content }}</textarea>
                                        </div>

                                    </div>

                                    <div class="col-md-4" style="padding-bottom:15px;"> {{-- thumbnail --}}
                                        <label for="">Thumbnail</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                    class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="thumbnail"
                                                value="{{ $post->thumbnail }}">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:300px;">
                                            <img src="{{ $post->thumbnail }}" style="height: 15rem;">
                                        </div>
                                    </div>

                                    <div class=" col-md-12"> {{-- button --}}
                                        <a href={{ url("/posts") }} class="btn btn-secondary">Back</a>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script src={{ url("/vendor/laravel-filemanager/js/stand-alone-button.js") }}></script>
<script>
    // CKEditor
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
    
    // Filemanager
    $(document).ready(function() {
        $('#lfm').filemanager('image');
    });
</script>
@stop
