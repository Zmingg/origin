@extends('layouts.admin')
@section('title', '新增文章')

@section('header')
    @parent
    <!-- Image cropper -->
    <link href="{{URL::asset('ass_back/css/plugins/cropper/cropper.min.css')}}" rel="stylesheet">
    
@endsection

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Data Tables</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>
                <a>Tables</a>
            </li>
            <li class="active">
                <strong>Data Tables</strong>
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
                            <h5>完整的文章信息 <small>>> 请正确填入以下所有选项信息</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="form_basic.html#">Config option 1</a>
                                    </li>
                                    <li><a href="form_basic.html#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form method="post" class="form-horizontal" action="/admin/blog">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">标题 Title</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">摘要 Abstract</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="3" name="abstract"></textarea>
                                        <!-- <input type="text" class="form-control">  -->
                                        <span class="help-block m-b-none">简单描述您的文章内容，不超过100字。</span>
                                    </div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label">分类 Category</label>

                                    <div class="col-sm-10">
                                      <select class="form-control m-b" name="cate_id">
                                        <?php foreach ($cates as $cate) :?>
                                        <option value="{{$cate->id}}">{{$cate->name}}</option>
                                        <?php endforeach?>
                                      </select>

                                        <!-- <div class="col-lg-4 m-l-n">
                                            <select class="form-control" multiple="">
                                                <option>option 1</option>
                                                <option>option 2</option>
                                                <option>option 3</option>
                                                <option>option 4</option>
                                            </select>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                
                                
                                <!-- <div class="form-group"><label class="col-sm-2 control-label">Control sizing</label> -->

                                    <!-- <div class="col-sm-10"> -->
                                      <!-- <input type="text" placeholder=".input-lg" class="form-control input-lg m-b"> -->
                                        <!-- <input type="text" placeholder="Default input" class="form-control m-b">  -->
                                        <!-- <input type="text" placeholder=".input-sm" class="form-control input-sm"> -->
                                    <!-- </div> -->
                                <!-- </div> -->
                                <!-- <div class="hr-line-dashed"></div> -->

                                <!-- <div class="form-group">
                                    <label class="col-sm-2 control-label">Column sizing</label>

                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-md-2"><input type="text" placeholder=".col-md-2" class="form-control"></div>
                                            <div class="col-md-3"><input type="text" placeholder=".col-md-3" class="form-control"></div>
                                            <div class="col-md-4"><input type="text" placeholder=".col-md-4" class="form-control"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div> -->

                                <div class="form-group">
                                  <label class="col-sm-2 control-label">标签 Tags</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="tags" name="tags" type="text" ></input>
                                        <span class="help-block m-b-none">多个标签之间用','分开</span>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                  <label class="col-sm-2 control-label">正文内容 Content</label>


                                    <div class="col-sm-10">
                                        <!-- <div class="row"> -->
                                            <script id="content" name="content" type="text/plain" style="width:100%">
                                            </script>
                                        <!-- </div> -->
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">上传缩略图文件</label>
                                    <div class="col-sm-10">
              
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="image-crop">
                                                                <img src="{{URL::asset('ass_back/img/thumb_default.jpg')}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h4>预览效果</h4>
                                                            <div class="row">
                                                                <div class="img-preview img-preview-sm">
                                                                    <img src="{{URL::asset('ass_back/img/thumb_default.jpg')}}">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                              <div class="col-md-10">
                                                                <input name="thumb_src" id="thumb_src" type="hidden" readonly class="form-control" value="">
                                                                <input name="thumb_code" id="thumb_code" type="hidden" readonly class="form-control" value="">
                                                              </div>
                                                            </div>
                                                            <br>
                                                            
                                                            <div class="btn-group">
                                                                <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                                                    <input type="file" accept="image/*" name="file" id="inputImage" class="hide">
                                                                    打开新图片
                                                                </label>
                                                                <label title="Donload image" id="save" class="btn btn-primary">保存</label>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                     
                                    
                                    </div> 
                                </div>
                                

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        
                                        <button class="btn btn-primary" type="submit">确认新增</button>
                                        <button class="btn btn-white" type="submit">取消</button>
                                    </div>
                                </div>
                                
                                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<!-- UE -->
<script type="text/javascript" src="{{URL::asset('ueditor/ueditor.config.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('ueditor/ueditor.all.js')}}"></script>
<script type="text/javascript">
    var ue = UE.getEditor('content');
</script>
<!-- CROP -->
<script src="{{URL::asset('ass_back/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{URL::asset('ass_back/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{URL::asset('ass_back/js/plugins/cropper/cropper.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var $image = $(".image-crop > img")
        $($image).cropper({
            aspectRatio: 16/9,
            // preview: ".img-preview",
            done: function(data) {
                // Output the result data for cropping image.
                // console.log(data);
            }
        });

        var $inputImage = $("#inputImage");
        if (window.FileReader) {
            $inputImage.change(function() {
                var fileReader = new FileReader(),
                        files = this.files,
                        file;

                if (!files.length) {
                    return;
                }

                file = files[0];


                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function () {
                        $inputImage.val("");
                        $image.cropper("reset", true).cropper("replace", this.result);
                    };
                } else {
                    showMessage("Please choose an image file.");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }

        $("#save").click(function() {
            var new_code = $($image).cropper('getDataURL',{width: 320,height: 180});
            $.ajax('/admin/image/path', {
                method: "get",
                success: function (data) {
                    console.log(data);
                    $('#thumb_src').val(data);
                    $('#thumb_code').val(new_code);
                    $('.img-preview > img').attr('src',new_code);
                },
                error: function () {
                    console.log('Upload error');
                }
            });

        });


        

        

        // $("#download").click(function() {
        //     console.log($image.cropper("getData"));
        //             alert('111');
           
        // });
    });
</script>
@endsection


