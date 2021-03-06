@extends('layouts.blog-post')



@section('content')



    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo ? $post->photo->file :"/images/placeholder.gif"}}" alt="">

    <hr>

    <!-- Post Content -->

    <p>{{$post->body}}</p>

    <hr>


    @if(Session::has('comment_created'))

            <p class="alert alert-success">{{session('comment_created')}}</p>


       @endif

    <!-- Blog Comments -->


    @if(Auth::check())

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
    

            {!! Form::open(['method'=>'POST', 'action'=> 'PostCommentsController@store']) !!}


                <input type="hidden" name="post_id" value="{{$post->id}}">


                <div class="form-group">
                    {!! Form::label('body', 'Body:') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>3])!!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Submit comment', ['class'=>'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}


        </div>


    @endif

    <hr>

    <!-- Posted Comments -->



    @if(count($comments) > 0)


        @foreach($comments as $comment)

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img height="64" class="media-object" src="{{$comment->photo ? $comment->photo : "/images/male-placeholder-image.jpeg"}}" alt="user photo">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                    <p>{{$comment->body}}</p>
                    <small role="button" style="color: blue"  class="toggle-reply">Reply</small>


                    <div class="comment-reply-container">
                        
                        <div class="comment-reply col-sm-6">
                                {!! Form::open(['method'=>'POST', 'action'=> 'CommentRepliesController@createReply']) !!}
                                    <div class="form-group">

                                        <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                        {!! Form::label('', '') !!}
                                        {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>1])!!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::submit('Reply', ['class'=>'btn btn-primary']) !!}
                                    </div>
                                {!! Form::close() !!}
                        </div>
                
            
                @if(count($comment->replies) > 0)

                    @foreach($comment->replies as $reply)

                            @if($reply->is_active == 1)

                                <!-- Nested Comment -->
                                <div id="nested-comment" class="media">
                                    <a class="pull-left" href="#">
                                        <img height="64" class="media-object" src="{{$reply->photo ? $reply->photo : "/images/male-placeholder-image.jpeg"}}" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            {{$reply->author}}
                                            <small>{{$reply->created_at->diffForHumans()}}</small>
                                        </h4>
                                        <p>{{$reply->body}}</p>
                                    </div>
                                </div>

                                <!-- End Nested Comment -->
                            @endif

                    @endforeach

                @endif
            </div>

            </div>
        </div>
    
         @endforeach
    
    @endif

    
@endsection


@section('scripts')

    <script>

    $(document).ready(function(){
        $(".toggle-reply").click(function(){
            $(".comment-reply-container").slideToggle();
        });
    });

    </script>



@endsection

