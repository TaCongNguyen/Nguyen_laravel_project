@include('admin.header')
<link href="{{url('summernote/summernote-lite.min.css')}}" rel="stylesheet" />
@include('admin.sidebar')

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{$page_title}} </h2>
                    <a href="{{url('register')}}">
                        <button class="btn btn-primary btn-sm" style="float: right"><i class="fa fa-plus"></i>Add user</button>
                    </a>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr><th>User name</th><th>Email</th><th>Date</th><th>Action</th></tr>
                </thead>
                <tbody>
                    @if ($rows)
                        @foreach ( $rows as $row )
                            <tr><td>{{$row->name}}</td><td>{{$row->email}}</td><td>{{$row->created_at}}</td>
                                <td>
                                    <a href="{{url('admin/categories/edit/'.$row->id)}}"><button class="btn btn-sm btn-success"><i class="fa fa-edit"></i>Edit</button></a>
                                    <a href="{{url('admin/categories/delete/'.$row->id)}}"><button class="btn btn-sm btn-danger"><i class="fa fa-trash-times"></i>Delete</button></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <hr />


        </div>

    </div>

</div>

@include('admin.footer')
