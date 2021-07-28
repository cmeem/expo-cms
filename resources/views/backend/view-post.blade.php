<div>
    {{ $post->id }}<br>
    {{ $post->admin_id }}<br>
    {{ $post->admin_username }}<br>
    {{ $post->admin_status }}<br>
    {{ $post->created_at->format('Y-M-D') }}<br>
    {{ $post->views_count }}<br>
    {{ $post->likes_count }}<br>
    {{ $post->comments_count }}<br>
    {{ $post->category }}<br>
    @if($post->tags)
    @foreach (json_decode($post->tags) as $tag )
         <span href="{{ $tag }}" class="btn btn-blue-200 btn-sm">{{ $tag }}</span>
    @endforeach
    @else
    No Tags
    @endif <br>
    @if($post->attachments)
    {{ count(json_decode($post->attachments)) }}<br>
    @foreach (json_decode($post->attachments) as $attachment )
         <a href="{{ $attachment }}" class="">{{ $attachment }}</a><br><hr>
    @endforeach
    @else
    No Attachments
    @endif
    {{ print($post->content) }}
</div>
