<div class="card" id="app">
    <div class="card-body">

        <!-- Comments -->

        <div class="comment mb-3">
            <div class="row">
                <div class="col-auto">

                    <!-- Avatar -->
                    <a class="avatar" href="profile-posts.html">
                        <img src="assets/img/avatars/profiles/avatar-2.jpg" alt="..." class="avatar-img rounded-circle">
                    </a>

                </div>
                <div class="col ml--2">

                    <!-- Body -->
                    <div class="comment-body">

                        <div class="row">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="comment-title">
                                    Ab Hadley
                                </h5>

                            </div>
                            <div class="col-auto">

                                <!-- Time -->
                                <time class="comment-time">
                                    👍 2 | 11:12
                                </time>

                            </div>
                        </div> <!-- / .row -->

                        <!-- Text -->
                        <p class="comment-text">
                            Looking good Dianna! I like the image grid on the left, but it feels like a lot to process and doesn't really <em>show</em> me what the product does? I think using a short looping video or something similar demo'ing the product might be better?
                        </p>

                    </div>

                </div>
            </div> <!-- / .row -->
        </div>


        <!-- Divider -->
        <hr>

        <!-- Form -->
            @auth()
            <div class="row align-items-start">
                <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar">
                        <img src="{{auth()->user()->icon}}" alt="..." class="avatar-img rounded-circle">
                    </div>

                </div>
                <div class="col ml--2">

                    <div id="editormd">
                        <textarea style="display:none;"></textarea>
                    </div>
                    <button class="btn btn-primary">发表评论</button>

                </div>
            </div> <!-- / .row -->
            @else
            <p class="text-muted text-center">请 <a href="{{route('login',['from'=>url()->full()])}}">登录</a> 后评论</p>
            @endauth
    </div>
</div>
@push('js')
    <script>
        require(['hdjs','vue'],function(hdjs,Vue){
            new Vue({
                el:'#app',
                data:{},
                methods:{

                },
                mounted(){
                    hdjs.editormd("editormd", {
                        width: '100%',
                        height: 300,
                        toolbarIcons : function() {
                            return [
                                "undo","redo","|",
                                "bold", "del", "italic", "quote","|",
                                "list-ul", "list-ol", "hr", "|",
                                "link", "hdimage", "code-block", "|",
                                "watch", "preview", "fullscreen"
                            ]
                        },
                        //后台上传地址，默认为 hdjs配置项window.hdjs.uploader
                        server:'',
                        //editor.md库位置
                        path: "{{asset('org/hdjs')}}/package/editor.md/lib/"
                    });
                }
            });
        })
    </script>
@endpush
