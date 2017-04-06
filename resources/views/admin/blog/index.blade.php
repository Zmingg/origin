@extends('layouts.admin')
@section('title', '文章列表')



@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>文章管理</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">首页</a>
            </li>
            <li>
                <a>内容管理</a>
            </li>
            <li class="active">
                <strong>文章列表</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>所有的文章列表</h5>
                
            </div>

            <div class="ibox-content">

            <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover dataTables-example"  >
                    <thead>
                    <tr>
                        <th>标题</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($blogs as $blog):?>
                    <tr class="">
                        <td><?=$blog->title?></td>
                        <td><?=$blog->created_at->format('Y-m-d H:i:s')?></td>
                        <td>
                            <a class="" href="/admin/blog/{{$blog->id}}/edit">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>&nbsp
                            <a class="demo3" bid="{{$blog->id}}" title="{{$blog->title}}">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>                
                        </td>
                    </tr>
                    <?php endforeach?> 
                    
                    </tbody>
                </table>
                
                <a onclick="" href="{{url('admin/blog/create')}}" class="btn btn-primary ">添加新文章</a>
            </div>
            </div>
        </div>
    </div>
    </div>
</div>
<script type="text/javascript" src="{{URL::asset('ass_back/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<link href="{{URL::asset('ass_back/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
<script type="text/javascript">
    
    $('.demo3').click(function () {
        var id = $(this).attr('bid');
        var title = $(this).attr('title');
        swal({
            title: "确定删除' "+title+" '?",
            text: "您将不能再找回这篇文章!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "是的,确认删除!",
            cancelButtonText:"让我再考虑一下…",  
            closeOnConfirm: false
        }, function () {
            $.ajax({
                type:"post",  
                url:"{{url('admin/blog')}}/"+id,  
                // traditional: true,  
                dataType:"text",  
                data:{_token:"{{ csrf_token() }}",_method:"delete"}
            }).done(function(data){
                swal("操作成功!", "已成功删除数据！", "success"); 
                window.location = "{{url('admin/blog')}}"; 
            }).fail(function(data){
                swal("OMG", "删除操作失败了!", "error");  
            });
        });
    });
</script>
@endsection

