@extends('layouts.admin')
@section('title', '文章分类')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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

                    <div class="col-xs-4 col-xs-offset-4" id="cate-error" style="color:red"></div>

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
                                <a class="cate-edit">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a class="cate-save" style="display:none;">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </a>
                                &nbsp
                                <a class="demo3 cate-trash" title="" >
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>  
                                <a class="cate-cancel" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>              
                            </td>
                        </tr>
                        <?php endforeach?>
                        <tr class="" style="display:none">
                            
                            <td class="id" style="display:none;"></td>
                            <td class="alias"><input class="form-control"></td>
                            <td class="name"><input class="form-control"></td>
                            <td>
                                <a class="cate-edit" style="display:none;">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                <a class="cate-save" onclick="">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </a>
                                &nbsp
                                <a class="demo3 cate-trash" success="" title=""  style="display:none;">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>  
                                <a class="cate-cancel" success="" >
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a id="newcate" class="btn btn-primary">添加分类</a>
            </div>

        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{URL::asset('ass_back/js/blogcates.js')}}"></script>

@endsection