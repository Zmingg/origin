<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理中心 >> @yield('title')</title>
    
@section('header')

    <link href="<?=URL::asset('ass_back/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=URL::asset('ass_back/font-awesome/css/font-awesome.css')?>" rel="stylesheet">

    <link href="<?=URL::asset('ass_back/css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">

    <link href="<?=URL::asset('ass_back/css/animate.css')?>" rel="stylesheet">
    <link href="<?=URL::asset('ass_back/css/style.css')?>" rel="stylesheet">
    
    <!-- Mainly scripts -->
    <script src="<?=URL::asset('ass_back/js/jquery-2.1.1.js')?>"></script>
    <script src="<?=URL::asset('ass_back/js/bootstrap.min.js')?>"></script>
    <script src="<?=URL::asset('ass_back/js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
    <script src="<?=URL::asset('ass_back/js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
    <script src="<?=URL::asset('ass_back/js/plugins/jeditable/jquery.jeditable.js')?>"></script>

    <script src="<?=URL::asset('ass_back/js/plugins/dataTables/datatables.min.js')?>"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=URL::asset('ass_back/js/inspinia.js')?>"></script>
    <script src="<?=URL::asset('ass_back/js/plugins/pace/pace.min.js')?>"></script>
@show 
    
</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?=URL::asset('ass_back')?>/img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="table_data_tables.html#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::guard('admin')->user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">管理员 <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">                   
                            <li><a href="">个人信息</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">登出</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li name="index">
                    <a href="<?=url('/admin/')?>"><i class="fa fa-th-large"></i>
                     <span class="nav-label">中心首页</span> 
                     <span class="fa arrow"></span>
                    </a>
                    <!-- <ul class="nav nav-second-level collapse">
                        <li><a href="">Dashboard v.1</a></li>
                        <li><a href="dashboard_2.html">Dashboard v.2</a></li>
                        <li><a href="dashboard_3.html">Dashboard v.3</a></li>
                        <li><a href="dashboard_4_1.html">Dashboard v.4</a></li>
                        <li><a href="dashboard_5.html">Dashboard v.5 <span class="label label-primary pull-right">NEW</span></a></li>
                    </ul> -->
                </li>
                
                <li class="">
                    <a href="#"><i class="fa fa-table"></i>
                     <span class="nav-label">内容管理</span>
                     <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li name="blog"><a href="<?=url('/admin/blog')?>">文章列表</a></li>  
                        <li name="blogcate"><a href="<?=url('/admin/blog/cate')?>">文章分类</a></li>
                    </ul>
                </li>
                <li>
                    <a href="table_data_tables.html#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">E-commerce</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="ecommerce_products_grid.html">Products grid</a></li>
                        <li><a href="ecommerce_product_list.html">Products list</a></li>
                        <li><a href="ecommerce_product.html">Product edit</a></li>
                        <li><a href="ecommerce_product_detail.html">Product detail</a></li>
                        <li><a href="ecommerce-cart.html">Cart</a></li>
                        <li><a href="ecommerce-orders.html">Orders</a></li>
                        <li><a href="ecommerce_payments.html">Credit Card form</a></li>
                    </ul>
                </li>
                <li>
                    <a href="table_data_tables.html#"><i class="fa fa-picture-o"></i> <span class="nav-label">Gallery</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="basic_gallery.html">Lightbox Gallery</a></li>
                        <li><a href="slick_carousel.html">Slick Carousel</a></li>
                        <li><a href="carousel.html">Bootstrap Carousel</a></li>

                    </ul>
                </li>
                <li>
                    <a href="table_data_tables.html#"><i class="fa fa-sitemap"></i> <span class="nav-label">Menu Levels </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="table_data_tables.html#">Third Level <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="table_data_tables.html#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="table_data_tables.html#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="table_data_tables.html#">Third Level Item</a>
                                </li>

                            </ul>
                        </li>
                        <li><a href="table_data_tables.html#">Second Level Item</a></li>
                        <li>
                            <a href="table_data_tables.html#">Second Level Item</a></li>
                        <li>
                            <a href="table_data_tables.html#">Second Level Item</a></li>
                    </ul>
                </li>
                <li>
                    <a href="css_animation.html"><i class="fa fa-magic"></i> <span class="nav-label">CSS Animations </span><span class="label label-info pull-right">62</span></a>
                </li>
                <li class="landing_link">
                    <a target="_blank" href="landing.html"><i class="fa fa-star"></i> <span class="nav-label">Landing Page</span> <span class="label label-warning pull-right">NEW</span></a>
                </li>
                <li class="special_link">
                    <a href="package.html"><i class="fa fa-database"></i> <span class="nav-label">Package</span></a>
                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " ><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to QCBlog Admin.</span>
                </li>
                
                <li>
                    <a href=""
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> 登出
                    </a>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>

        </nav>
        </div>

        @yield('content')
        
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2015
            </div>
        </div>

        </div>
        </div>



    

    <script type="text/javascript">
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                     }
                    }
                ]

            });
        });
    </script> 
    <script type="text/javascript">
        var ali = $('li[name={{$active_on}}]');
        ali.addClass('active');
        if (ali.parent().hasClass('nav-second-level')) {
            ali.parents('li').addClass('active');
        };
    </script>
    @yield('js')
</body>

</html>


