@extends('master')
    @section('content')
        <h2>Total Points : {{$user_media->total_points}}</h2>
        <form action="{{url('send-email')}}" method="post">
            @csrf
            <input type="email" name="email" id="">
            <input type="hidden" name="email_path" value="{{$user_media->getMedia('instagram_images')->first()->getPath()}}">
            <button type="submit">Email Picture!</button>
        </form>
        <br/>
        <a href="{{$user_media->instagram_post_link}}">
            <img height="600" width="600" target="_blank" src="{{$user_media->getMedia('instagram_images')->first()->getFullUrl()}}" alt="" class="float-left"></a>
    @endsection