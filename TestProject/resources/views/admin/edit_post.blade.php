@include('admin.header')
<link href="{{url('summernote/summernote-lite.min.css')}}" rel="stylesheet" />
@include('admin.sidebar')

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                <h2>{{$page_title}} </h2>
                </div>
            </div>
            <div class="container-fluid col-lg-12" >
                <form method="POST" enctype="multipart/form-data">

                    @if (count($errors->all())>0)
                        <div class="alert alert-danger text-center">
                            @foreach ($errors->all() as $error )
                            {{$error}}<br>
                            @endforeach
                        </div>
                    @endif
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label" autofocus>Post Title</label>
                        <div class="col-sm-10">
                            <input id="title" type="text" class="form-control" placeholder="Title" name="title" value="{{$row->title}}" ><br>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="file" class="col-sm-2 col-form-label">Featured image</label>
                        <div class="col-sm-10">
                            <input id="file" type="file" class="form-control"  name="file" ><br>
                            <img src="{{url('uploads/'.$row->image)}}" style="width:200px;"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label">Post Category</label>
                        <div class="col-sm-10">
                            <select id="category_id" name="category_id" class="form-control">
                                <option value="{{$row->category_id}}">{{$category->category}}</option>
                            </select>
                        </div>
                    </div>

                    @csrf
                    <h4>Post Content</h4>
                    <textarea id="summernote" name=content>{{$row->content}}</textarea>
                    <input class="btn btn-primary " type="submit" value="Save">
                    <a href="{{url('admin/posts')}}">
                        <input class="btn btn-success " type="button" style="float: right; margin-top:0" value="Back">
                    </a>
                </form>

            </div>
            <hr />


        </div>

    </div>

</div>

@include('admin.footer')
<script src="{{url('summernote/summernote-lite.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({height:300});
    });
</script>
