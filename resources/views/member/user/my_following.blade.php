@extends('home.layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            @include('member.layouts.menu')
            <div class="col-sm-9">
                @if($followings->count()==0)
                    <p class="text-muted text-center p-5">暂无关注</p>
                @else
                    <div class="container-fluid">
                        <div class="row">
                                @foreach($followings as $following)
                                <div class="col-12 col-md-6 col-xl-4">
                                    <!-- Card -->
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <a href="{{route('member.user.show',$following)}}" class="avatar avatar-xl card-avatar ">
                                                <img src="{{$following->icon}}" class="avatar-img rounded-circle border border-white" alt="...">
                                            </a>

                                            <h2 class="card-title">
                                                <a href="{{route('member.user.show',$following)}}">{{$following->name}}</a>
                                            </h2>

                                            <p class="card-text">
                                          <span class="badge badge-soft-secondary">
                                            粉丝:{{$following->fans->count()}}
                                          </span>
                                                <span class="badge badge-soft-secondary">
                                            关注:{{$following->following->count()}}
                                          </span>
                                            </p>
                                            @auth()
                                                <a href="{{route('member.attention',@$following)}}" class="btn btn-block btn-sm btn-white">
                                            @if($following->fans->contains(auth()->user()))
                                                取消关注
                                                @else
                                                关注
                                            @endif
                                                </a>
                                            @endauth
                                        </div>
                                    </div>
                            {{$followings->links()}}
                                </div>
                            @endforeach
                        @endif
                        </div>

                    </div>

            </div>

        </div>
    </div>

@endsection