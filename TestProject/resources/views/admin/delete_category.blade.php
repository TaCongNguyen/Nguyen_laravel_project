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
                @if ($row)
                <form method="POST" enctype="multipart/form-data">

                    @if (count($errors->all())>0)
                        <div class="alert alert-danger text-center">
                            @foreach ($errors->all() as $error )
                            {{$error}}<br>
                            @endforeach
                        </div>
                    @endif
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label" autofocus> Category Name</label>
                        <div class="col-sm-10">
                            <input id="category" type="text" class="form-control" placeholder="category" name="title" value="{{$row->category}}" disabled ><br>
                        </div>
                    </div>

                    @csrf

                    <input class="btn btn-danger " type="submit" value="Delete">
                    <a href="{{url('admin/categories')}}">
                        <input class="btn btn-success " type="button" style="float: right; margin-top:0" value="Back">
                    </a>
                </form>
                @else
                <br><div><h4>Sorry, 404 error!</div></h4><br>
                <a href="{{url('admin/categories')}}">
                    <input class="btn btn-success " type="button" style="float: right; margin-top:0" value="Back">
                </a>
                @endif
            </div>
            <hr />


        </div>

    </div>

</div>

@include('admin.footer')

