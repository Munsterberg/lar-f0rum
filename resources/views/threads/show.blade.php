@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">
                            {{ $thread->owner->name }}
                        </a>
                        posted:
                        <strong>{{ $thread->title }}</strong>
                    </div>
                    <div class="panel-body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach ($thread->replies as $reply)
                    @include ('threads.reply')
                @endforeach
            </div>
        </div>

        @if (auth()->check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form action="{{ $thread->path() . '/replies' }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea class="form-control" name="body" id="body" placeholder="Add a comment"
                                      required></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Add Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to comment.</p>
        @endif
    </div>
@endsection