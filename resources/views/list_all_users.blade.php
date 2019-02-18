@extends('master')
    @section('content')

     <div class="container">
        <h2>Instagram Media Points</h2>

        <table class="table table-bordered">
          <thead>
            <tr>
             <th class="text-center">Name</th>
             <th class="text-center">Instagram Username</th>
             <th class="text-center">Total Points</th>
            </tr>
          </thead>
          <tbody>
             @foreach($points as $point)
                <tr>
                 <td>{{$point->name}}</td>
                 <td><a href="{{url('/')}}/{{$point->insta_username}}">{{$point->insta_username}}</a></td>
                 <td>{{$point->total_points}}</td>
                </tr>
             @endforeach
          </tbody>
        </table>
     </div>

    @endsection