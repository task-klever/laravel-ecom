@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Video</h1>

    <form action="{{ url('admin/video-gallery/update/'.$video->id) }}" method="post">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Edit Video</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.video.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Existing Video Thumbnail</label>
                            <div>
                                <div class="iframe-container-300">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video->video_youtube }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Video (YouTube Id) *</label>
                            <input type="text" name="video_youtube" class="form-control" value="{{ $video->video_youtube }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="">Caption</label>
                            <input type="text" name="video_caption" class="form-control" value="{{ $video->video_caption }}">
                        </div>
                        <div class="form-group">
                            <label for="">Order</label>
                            <input type="text" name="video_order" class="form-control" value="{{ $video->video_order }}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>
    </form>

@endsection
