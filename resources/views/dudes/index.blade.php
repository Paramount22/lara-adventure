@extends('layouts.app')

@section('content')

    <section>
        <div class="row">
            @forelse( $dudes as $dude )
                <article id="item-{{ $dude->id }}">
                    <h4>
                        <a href="{{ url('dudes/' . $dude->slug) }}">{{ $dude->title }}</a>
                    </h4>
                    <p>
                        {{ $dude->text }}
                    </p>

                    <p>
                        <small style="font-style: italic">
                            by <a href="{{ route('show.user', $dude->user->id) }}">{{ $dude->user->name }}</a>
                        </small>

                    </p>

                    <div class="comment">
                        <small>
                            @if( $dude->comments->count() < 1  )
                                <div class="no-comments">
                                    <a href="{{ url('dudes/' . $dude->slug) .'#comments' }}">no comments</a></div>
                            @else
                                <a href="{{ url('dudes/' . $dude->slug) .'#comments' }}" class="" >
                                    {{  $dude->comments->count() }}
                                    {{ str_plural('comment', $dude->comments->count()) }}

                                </a>
                            @endif
                        </small>
                    </div>




                </article>

            @empty
                <p> No dudes yet :-( </p>

            @endforelse
        </div>

    </section>

    <section class="info col-lg-5 offset-lg-3 mb-4">
        <p> Number of dudes:
            @foreach($totalDudes as $total)
             <strong>{{ $total->total }}</strong>
            @endforeach <br>

            Number of comments:
            @foreach($totalComments as $total)
                <strong>{{ $total->total }}</strong>
            @endforeach

        </p>

    </section>


@endsection




