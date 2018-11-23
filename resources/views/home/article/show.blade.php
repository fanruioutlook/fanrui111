@extends('home.layouts.master')
@section('content')
    <div class="container">
        <div class="row edu-topic-show mt-3">
            <div class="col-12 col-xl-9">
                <div class="card card-body p-5">
                    <div class="row">
                        <div class="col text-right">
                            <a href="http://www.houdunren.com/common/favorite?model=EduTopic&amp;id=60" class="btn btn-xs">
                                <i class="fa fa-heart-o" aria-hidden="true"></i> 收藏</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <h2 class="mb-4">
                            {{$article['title']}}
                            </h2>
                            <p class="text-muted mb-1 text-muted small">
                                <a href="{{route('member.user.show',$article->user)}}" class="text-secondary">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                </a><a href="{{route('member.user.show',$article->user)}}" class="text-secondary">{{$article->user->name}}</a>

                                <i class="fa fa-clock-o ml-2" aria-hidden="true"></i>
                                {{$article->created_at->diffForHumans()}}

                                <a href="{{route('home.article.index',['category'=>$article->category->id])}}" class="text-secondary">
                                    <i class="fa fa-folder-o ml-2" aria-hidden="true"></i>
                                    {{$article->category->title}}
                                </a>

                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="markdown editormd-html" id="content">
                                <textarea name="content" id="" hidden cols="30" rows="10">{{$article->content}} </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                @include('home.layouts.comment')
            </div>
            <div class="col-12 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            <a href="{{route('member.user.show',$article->user)}}" class="text-secondary">
                            {{$article->user->name}}
                            </a>
                        </div>
                    </div>
                    <div class="card-block text-center p-5">
                        <div class="avatar avatar-xl">
                            <a href="{{route('member.user.show',$article->user)}}">
                                <img src="{{$article->user->icon}}" alt="..." class="avatar-img rounded-circle">
                            </a>
                        </div>
                    </div>
                    @auth()
                    <div class="card-footer text-muted">
                        @can('isNotMine',$article->user)
                        <a class="btn btn-white btn-block btn-xs" href="{{route('member.attention',$article->user)}}">
                            @if($article->user->fans->contains(auth()->user()))
                            取消关注
                                @else
                                <i class="fa fa-plus" aria-hidden="true"></i> 关注
                                @endif
                        </a>
                            @endcan
                    </div>
                        @endauth
                </div>
            </div>
        </div>
    </div>
@endsection

