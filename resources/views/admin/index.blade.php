@extends('layouts.admin')
@section('title', 'Page Title')


@section('content')

        <h1>Hello, world!</h1>
        <h1>欢迎你使用后台!</h1>
        <hr>
        <h3>文章中心</h3>
        <?php foreach($blogs as $blog):?>
  		<p><?= $blog->title?></p>
  		<?php endforeach;?>
    
@endsection