@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <!-- Header -->
        <div class="header mt-md-2">
            <div class="header-body">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Title -->
                        <h2 class="header-title">
                            栏目管理
                        </h2>

                    </div>

                </div> <!-- / .row -->
                <div class="row align-items-center">
                    <div class="col">

                        <!-- Nav -->
                        <ul class="nav nav-tabs nav-overflow header-tabs">
                            <li class="nav-item">
                                <a href="{{route('admin.category.index')}}" class="nav-link ">
                                    栏目列表
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.category.create')}}" class="nav-link active">
                                    添加栏目
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-auto">

                        <!-- Buttons -->
                        <a href="{{route('admin.category.create')}}" class="btn btn-white btn-sm">
                            添加栏目
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">


                <div class="card">
                    <div class="card-body">

                        <form method="post" action="{{route('admin.category.update',$category)}}">
@csrf @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputEmail1">栏目标题</label>
                                <input type="text" value="{{$category['title']}}" name="title" class="form-control" id="exampleInputEmail1" placeholder="">
                            </div>

                            <label for="exampleInputEmail1">栏目图标</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text  {{$category['icon']}}" id="icon"></span>
                                </div>
                                <input type="text"  name="icon" value="{{$category['icon']}}" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span class="input-group-text"  onclick="choose()" style="cursor: pointer">选择图标</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function choose() {
            require(['hdjs'], function (hdjs) {
                hdjs.font(function (icon) {
                    //alert(icon)
                    $('input[name=icon]').val(icon)
                    $('#icon').addClass(icon)
                })
            })
        }

    </script>

    @endpush
