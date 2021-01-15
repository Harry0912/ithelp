@extends('layouts/article')

@section('main')
    <h1 class="font-thin text-4xl">文章 > 編輯文章</h1>

    @if($errors->any())
        <div class="errors p-3 bg-red-500 text-red-100 font-thin rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- <form action="{{ route('articles.update', $article) }}" method="post"> -->
        @csrf
        <!-- @method('patch') -->
        <input id="userId" type="hidden" value="{{ $article->id }}">
        <div class="field my-2">
            <label for="">標題 : </label>
            <input type="text" value="{{ $article->title }}" name="title" class="border border-gray-300 p-2">
        </div>
        <div class="field my-2">
            <label for="">內文 : </label>
            <textarea name="content" cols="30" rows="10" class="border border-gray-300 p-2">{{ $article->content }}</textarea>
        </div>
        <!-- <div class="actions">
            <button type="submit" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300">更新文章</button>
        </div>
    </form> -->
        <div>
            <button onClick="update()">更新文章</button>
        </div>
@endsection
<script>
    function update() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var title = $('input[name="title"]').val();
        var content = $('textarea[name="content"]').val();
        var id = $('#userId').val();
        $.ajax({
            type:'HEAD',
            url:"{{ route('articles.update', $article) }}",
            data:{title:title, content:content},
            success:function() {
                document.location.href="/";
            }
        });
    }
</script>