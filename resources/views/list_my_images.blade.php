@extends('master')
@section('content')

    <div class="container">
        <h2>Instagram Media Points</h2>

        <table class="table">

            <tbody>
            @foreach($user_media as $media)

                <tr>
                    <td><a href="{{url('/')}}/{{$user_name}}/{{$media->id}}">
                            <img height="200" width="200" src="{{$media->getMedia('instagram_images')->first()->getFullUrl()}}" alt=""></a></td>
                    <td><a href="{{url('/')}}/{{$media->insta_username}}">{{$media->insta_username}}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection