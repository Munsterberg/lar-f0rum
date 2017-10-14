<div class="panel panel-default">
    <div class="panel-heading">
        {{ $reply->owner->name }}
        {{ $reply->created_at->diffForHumans() }}
    </div>
    <div class="panel-body">
        {{ $reply->body }}
    </div>
</div>