<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models;
use App\Models\Post;

class AdminController extends Controller
{
    public function index(Request $req){
        $page_title="Dashboard";
        return view('admin.admin',['page_title'=>$page_title]);
    }
    /* Trang Post */
    public function posts(Request $req, $type='',$id=''){
        $page_title="Posts";
        switch($type){
            //add dữ liệu
            case 'add':
                if($req->method()=='POST'){
                    $post =new Post();
                    $validated=$req->validate([
                        'title'=>'required|string',
                        'file'=>'required|image',
                        'content'=>'required'
                    ]);

                    $path= $req->file('file')->store('/',['disk'=>'my_disk']);

                    $data['title']=$req->input('title');
                    $data['category_id']=1;
                    $data['image']=$path;
                    $data['content']=$req->input('content');
                    $data['created_at']=date("Y-m-d H:i:s");
                    $data['updated_at']=date("Y-m-d H:i:s");
                    $post->insert($data);


                }
                return view('admin.add_post',['page_title'=>'New Post']);
                break;
            // sửa dữ liệu
            case 'edit':
                $post =new Post();
                $row=$post->find($id);

                return view('admin.edit_post',[
                    'page_title'=>'Edit Post',
                    'row'=>$row,
                ]);
                break;
            //xoá dữ liệu
            case 'delete':
                return view('admin.posts',['page_title'=>'Delete Post']);
                break;

            default:
                //$post =new Post();
               // $rows=$post->all();
                $query="select posts.*,categories.category from posts join categories on posts.category_id=categories.id";
                $rows=DB::select($query);
                $data['rows']=$rows;
                $data['page_title']='Posts';

                return view('admin.posts',$data);
                break;
        }

    }
    /* End Trang Post */

    /* Trang Categories */
    public function categories(Request $req){
        $page_title="Categories";
        return view('admin.admin',['page_title'=>$page_title]);

    }
    /* End trang Categories */

    /* Trang user */
    public function users(Request $req){
        $page_title="Users";
        return view('admin.admin',['page_title'=>$page_title]);
    }
    /* End user */
    public function save(Request $req){
        $validate =$req->validate([
            'key'=>'required|string'
        ]);
        return view('view');
    }
}
