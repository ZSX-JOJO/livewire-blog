@extends('blog.layout',['title'=> $post->title,'desc' => $post->introduce])
@section('content')
    <div class="block md:flex break-all">
        <div class="md:w-3/4">
            <main>
                <article class="xl:divide-y xl:divide-gray-200 shadow-lg bg-white">
                    <header class="pt-5 xl:pb-2">
                        <div class="space-y-1 text-center">
                            <dl class="space-y-10">
                                <div>
                                    <dt class="sr-only">发布日期</dt>
                                    <dd class="text-base leading-6 font-medium text-gray-500">
                                        <time datetime="2020-08-25T13:00:00.000Z">{{ $post->created_at }}</time>
                                    </dd>
                                </div>
                            </dl>
                            <div>
                                <h1 class="text-2xl leading-9 font-extrabold text-gray-900 tracking-tight px-2 sm:leading-10 md:leading-14">{{ $post->title }}</h1>
                            </div>
                            <div class="mt-1">
                                <livewire:tag-list :tags="$post->tag"/>
                            </div>
                        </div>
                    </header>
                    <div class="divide-y xl:divide-y-0 divide-gray-200"
                         style="grid-template-rows:auto 1fr">
                        <div class="divide-y divide-gray-200 xl:pb-0">
                            <div class="prose max-w-none py-3 px-5">
                                {!! $post->content_str !!}
                            </div>
                        </div>

                    </div>
                </article>
                @if(Auth::check())
                    <livewire:add-comment :postId="$post->id" key="'add'.$post->id"/>
                @else
                    <div class="xl:divide-y xl:divide-gray-200 shadow-lg mt-5 py-5 bg-white flex flex-wrap justify-center px-3 lg:px-5">
                    <a class="hover:text-indigo-500" href="{{route('login')}}">登陆后方可评论！</a>
                    </div>
                @endif
                <livewire:show-comment :postId="$post->id" :parentId="0" :key="'show'.$post->id"/>
            </main>

        </div>
        <livewire:right-card/>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/showdown.js') }}"></script>
    <script type="text/javascript">
        function convert() {
            var text = document.getElementById("comment-composing-box").value;
            var converter = new showdown.Converter();
            var html = converter.makeHtml(text);
            document.getElementById("preview-box").style = html ? "display:block" : "display:none";
            document.getElementById("preview-box").innerHTML = html;
        }
    </script>
@endsection
