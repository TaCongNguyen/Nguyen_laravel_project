<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models;
use App\Models\Category;
use App\Models\Post;

class AdminController extends Controller
{
    public function index(Request $req){
        $page_title="Dashboard";
        return view('admin.admin',['page_title'=>$page_title]);
    }
    /* Trang Post */
    public function posts(Request $req, $type='',$id=''){

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
                    $data['category_id']=$req->input('category_id');
                    $data['image']=$path;
                    $data['content']=$req->input('content');
                    $data['created_at']=date("Y-m-d H:i:s");
                    $data['updated_at']=date("Y-m-d H:i:s");
                    $post->insert($data);
                    return redirect('admin/posts');

                }
                return view('admin.add_post',['page_title'=>'New Post']);
                break;
            // sửa dữ liệu
            case 'edit':
                $post =new Post();
                 if($req->method()=='POST'){

                    $validated=$req->validate([
                        'title'=>'required|string',
                        'file'=>'image',
                        'content'=>'required'
                    ]);
                    if($req->file('file'))
                    {
                        $oldrow=$post->find($id);
                        if(file_exists('uploads/'.$oldrow->image)){
                            unlink('uploads/'.$oldrow->image);
                        };
                        $path= $req->file('file')->store('/',['disk'=>'my_disk']);
                        $data['image']=$path;
                    }
                    $data['id']=$id;
                    $data['title']=$req->input('title');
                    $data['category_id']=$req->input('category_id');
                    $data['content']=$req->input('content');
                    $data['updated_at']=date("Y-m-d H:i:s");

                    $post->where('id',$id)->update($data);
                    return redirect('admin/posts/edit/'.$id);
                }
                $row=$post->find($id);
                $category= $row->category()->first();
                return view('admin.edit_post',[
                    'page_title'=>'Edit Post',
                    'row'=>$row,
                    'category'=>$category
                ]);
                break;
            //xoá dữ liệu
            case 'delete':
                $post =new Post();
                $row=$post->find($id);

                if($req->method()=='POST'){
                    $row->delete();
                   return redirect('admin/posts');
               }

               return view('admin.delete_post',[
                   'page_title'=>'Delete [post]',
                   'row'=>$row,

               ]);
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
    public function categories(Request $req, $type='',$id=''){
        switch($type){
            //add dữ liệu
            case 'add':
                if($req->method()=='POST'){
                    $category =new Category();
                    $validated=$req->validate([
                        'category'=>'required|string',

                    ]);

                    $data['category']=$req->input('category');
                    $data['created_at']=date("Y-m-d H:i:s");
                    $data['updated_at']=date("Y-m-d H:i:s");
                    $category->insert($data);
                    return redirect('admin/categories');

                }
                return view('admin.add_category',['page_title'=>'New category']);
                break;
            // sửa dữ liệu
            case 'edit':
                $category =new Category();
                 if($req->method()=='POST'){

                    $validated=$req->validate([
                        'category'=>'required|string',

                    ]);

                    $data['id']=$id;
                    $data['category']=$req->input('category');

                    $data['updated_at']=date("Y-m-d H:i:s");

                    $category->where('id',$id)->update($data);
                    return redirect('admin/categories/edit/'.$id);
                }
                $row=$category->find($id);

                return view('admin.edit_category',[
                    'page_title'=>'Edit category',
                    'row'=>$row,

                ]);
                break;
            //xoá dữ liệu
            case 'delete':
                $category =new Category();
                $row=$category->find($id);

                if($req->method()=='POST'){
                    $row->delete();
                   return redirect('admin/categories');
               }

               return view('admin.delete_category',[
                   'page_title'=>'Delete category',
                   'row'=>$row,

               ]);
               break;
            default:
                //$post =new Post();
               // $rows=$post->all();
                $query="select *from categories order by id desc";
                $rows=DB::select($query);
                $data['rows']=$rows;
                $data['page_title']='Categories';

                return view('admin.categories',$data);
                break;
        }
    }
    /* End trang Categories */

    /* Trang user */
    public function users(Request $req, $type='',$id=''){
        switch($type){
            //add dữ liệu
            case 'add':
                if($req->method()=='POST'){
                    $category =new Category();
                    $validated=$req->validate([
                        'category'=>'required|string',

                    ]);

                    $data['category']=$req->input('category');
                    $data['created_at']=date("Y-m-d H:i:s");
                    $data['updated_at']=date("Y-m-d H:i:s");
                    $category->insert($data);
                    return redirect('admin/categories');

                }
                return view('admin.add_category',['page_title'=>'New category']);
                break;
            // sửa dữ liệu
            case 'edit':
                $category =new Category();
                 if($req->method()=='POST'){

                    $validated=$req->validate([
                        'category'=>'required|string',

                    ]);

                    $data['id']=$id;
                    $data['category']=$req->input('category');

                    $data['updated_at']=date("Y-m-d H:i:s");

                    $category->where('id',$id)->update($data);
                    return redirect('admin/categories/edit/'.$id);
                }
                $row=$category->find($id);

                return view('admin.edit_category',[
                    'page_title'=>'Edit category',
                    'row'=>$row,

                ]);
                break;
            //xoá dữ liệu
            case 'delete':
                $category =new Category();
                $row=$category->find($id);

                if($req->method()=='POST'){
                    $row->delete();
                   return redirect('admin/categories');
               }

               return view('admin.delete_category',[
                   'page_title'=>'Delete category',
                   'row'=>$row,

               ]);
               break;
            default:

                $query="select *from users order by id desc";
                $rows=DB::select($query);
                $data['rows']=$rows;
                $data['page_title']='User';

                return view('admin.users',$data);
                break;
        }
    }
    /* End user */
    public function save(Request $req){
        $validate =$req->validate([
            'key'=>'required|string'
        ]);
        return view('view');
    }
}
