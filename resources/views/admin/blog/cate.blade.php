@extends('layouts.admin')
@section('title', '文章分类')



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
                <strong>文章分类</strong>
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
                

                <table class="table table-striped table-bordered table-hover"  >
                    <div id="edit-error" style="color:red;"></div>
                    <thead>
                    <tr>
                        <th class="col-xs-4">别名(EN)</th>
                        <th class="col-xs-4">分类名</th>
                        <th class="col-xs-2">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cates as $cate):?>
                        <tr class="">
                            <td class="id" style="display:none;">{{$cate->id}}</td>
                            <td class="alias">{{$cate->alias}}</td>
                            <td class="name">{{$cate->name}}</td>
                            <td>
                                <a class="table-edit" >
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a class="table-save" style="display:none;">
                                    <span class="glyphicon glyphicon-save"></span>
                                </a>
                                &nbsp
                                <a class="demo3" success="" title="">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>                
                            </td>
                        </tr>
                        <?php endforeach?> 
                        <!-- <tr class="">
                            <form>
                            <td class="id" style="display:none;"></td>
                            <td class="alias"><input class="form-control"></td>
                            <td class="name"><input></td>
                            <td>
                                <a class="table-edit" >
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a class="table-save" style="display:none;">
                                    <span class="glyphicon glyphicon-save"></span>
                                </a>
                                &nbsp
                                <a class="demo3" success="" title="">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>                
                            </td>
                            </form>
                        </tr> -->
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('.table-edit').click(function(){
            var std = $(this).parent();
            $('tbody tr').each(function(){
                if ($(this).find('.table-save').is(':visible')) {
                    var ttr = $(this);
                    var id = $(this).children('.id').html();
                    $.post('{{url("admin/blog/cate/re")}}',{id:id,_token:'{{csrf_token()}}'},
                        function(msg) {
                            ttr.find('.alias').html(msg.alias);
                            ttr.find('.name').html(msg.name);
                            ttr.find('.table-save,.table-edit').toggle();
                        }
                    );
                };
            });
            std.siblings('.alias,.name').each(function(){
                $(this).html("<input class='form-control input-sm' style='border:none;' value='"+$(this).html()+"''>");
            });
            std.children('.table-edit,.table-save').toggle();
        });
        $('.table-save').click(function(){
            var std = $(this).parent();
            var id = std.siblings('.id').html();
            var alias = std.siblings('.alias').children().val();
            var name = std.siblings('.name').children().val();
            $.ajax({
                type:'post',
                url:'{{url("admin/blog/cate/up")}}',
                data:{_token:'{{csrf_token()}}',id:id,alias:alias,name:name},
                success:function(){
                    std.siblings('.alias,.name').each(function(){
                        $(this).html($(this).children().val());
                    });
                    std.children('.table-edit,.table-save').toggle();
                    $('#edit-error').html('');
                },
                error:function(msg){              
                    $.each(msg.responseJSON,function(k,v){
                        $('#edit-error').html('Error: '+v);
                        std.siblings('.'+k).find('input').css('background','#fbc2c4');
                    });
                }
            });

            
        });
    });

</script>
@endsection