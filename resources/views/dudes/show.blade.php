@extends('layouts.app')

@section('title', isset( $dude->title ) ? $dude->title : 'Adventure' )

@section('content')

   <div class="dude col-lg-6 offset-lg-3">
       @can('edit-dude', $dude)
           <div class="edit-links text-right">
               <a href="{{ route('edit.dude', $dude->slug) }}">
                   <i class="fas fa-edit" title="edit"></i>
               </a>

               <a href="{{ route('delete.dude', $dude->slug) }}">
                   <i class="far fa-trash-alt" title="delete"></i>
               </a>

           </div>
       @endcan
        <h4 class="mb-3">
            <a href="{{ url('dudes/' . $dude->slug) }}">{{ $dude->title }}</a>
        </h4>
        <p>
            {!! $dude->save_text !!}
        </p>

        <p>
            <small style="font-style: italic">
                by <a href="{{ route('show.user', $dude->user->id) }}">{{  $dude->user->name  }}</a>
            </small>

        </p>

       @if ( $dude->tags )
               <p class="tags">
                   @foreach($dude->tags as $tag)
                       <a href="{{ route('show.tag', $tag->id) }}" class="btn btn-warning btn-xs">
                           <small>{{ $tag->tag }}</small>
                       </a>
                   @endforeach
               </p>
       @endif
   </div>

    <section id="comments" class="mt-3">
        @auth()
            <form action="{{ url('/comments') }}" method="POST" class="add-comment-form col-lg-6 offset-lg-3">
                @csrf


                <textarea name="text" placeholder="insert your comment" required="" class="form-control" id="comment-area"              rows="3"></textarea>

                <button class="btn btn-secondary mt-3" type="submit">Add comment</button>

                <input type="hidden" name="dude_id" value="{{ $dude->id }}">

            </form>
        @endauth

        <ol class="comments-list mt-3">

            @foreach( $dude->comments as $comment )
            <li class="col-lg-6 offset-lg-3">

                        {{ $comment->text }}
                @can('edit-comment', $comment) {{-- editacne linky iba pre autora prispevku --}}


                    <a href="{{ url('comment/' . $comment->id . '/delete') }}"  title="Delete" ><i                            class="fa fa-times"></i></a>

                <a href="" title="Edit" data-toggle="modal" data-target="#edit-comment"><i class="fas fa-pen"></i></a>

                @endcan <br>

              <small style="font-style: italic"> -- {{ $comment->user->name }} </small>
                <time datetime="{{ $comment->created_at->toW3cString() }}" class="text-muted">
                    {{ $comment->created_at->diffForHumans() }}
                </time>


            </li>
            @endforeach

        </ol>


            <!-- Modal -->
            <div class="modal fade" id="edit-comment" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCommentModalLabel">Edit comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if ( isset( $comment ))
                                <form action="{{ route('update.comment', $comment->id) }}" method="POST" class="add-comment-form ">
                                    @csrf
                                    @method('PUT')


                                    <textarea name="text" placeholder="insert your comment" required="" class="form-control" id="comment-area"              rows="3">{{ $comment->text }}</textarea>

                                    <button class="btn btn-block btn-secondary mt-3" type="submit">Save</button>

                                    <input type="hidden" name="dude_id" value="{{ $dude->id }}">

                                </form>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

    </section>

@endsection
