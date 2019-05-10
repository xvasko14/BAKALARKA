@extends('layouts.mainLayout.main_layout')

@section('content')

 <div class="container" style="max-width:90%;">
  <div class="row">


   <div class="panel panel-default">
    <h1 align="center">{{ __('message.LeagueTable') }}</h1>

    <div class="panel-heading">
     <div class="">

      <table id="rooms-table" class="table  table-striped table-dark " border=1 width="400">
       <thead>
       <tr>
        <th>{{ __('message.teamname') }}</th>
        <th>{{ __('message.Matches') }}</th>
        <th>{{ __('message.teamscored') }}</th>
        <th>{{ __('message.teamget') }}</th>
        <th>{{ __('message.teamwin') }}</th>
        <th>{{ __('message.teamdraw') }}</th>
        <th>{{ __('message.teamlose') }}</th>
        <th>{{ __('message.teampoints') }}</th>
       </tr>
       </thead>
       <tbody>
       @foreach($teams as $key => $data)
        <tr>
         <td>{{$data->name}}</td>
         <td>{{$data->match}}</td>
         <td>{{$data->goals}}</td>
         <td>{{$data->goalsoponent}}</td>
         <td>{{$data->win}}</td>
         <td>{{$data->draw}}</td>
         <td>{{$data->lose}}</td>
         <td>{{$data->score}}</td>

        </tr>
       @endforeach
       </tbody>
      </table>

     </div>
    </div>
   </div>

  </div>
 </div>
 <script>
  var table = document.getElementsByTagName('table')[0],
          rows = table.getElementsByTagName('tr'),
          text = 'textContent' in document ? 'textContent' : 'innerText';

  for (var i = 0, len = rows.length; i < len; i++){
   rows[i].children[0][text] = i + '.' + rows[i].children[0][text];
  }
 </script>


@endsection