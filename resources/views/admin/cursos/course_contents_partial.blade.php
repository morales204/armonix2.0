@foreach($courseContents as $content)
    <div class="card my-3 shadow-sm" style="border-left: 5px solid #007bff;">
        <div class="card-body">
            <h5 class="card-title">{{ $content->title }}</h5>
            <p class="card-text">{{ $content->content }}</p>
        </div>
    </div>
@endforeach