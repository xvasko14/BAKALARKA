@extends('layouts.adminLayout.admin_design')
@section('obsah')


<div id="content">
     <div id="content-header">
             <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>
 <div class="container" style="max-width:90%;">
        <div class="row">

            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <h1 align="center">Zoznam Timov</h1>

                    <div class="panel-heading">
                        <div class="">
                            <div class="panel-body">
                                
                                <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                    <thead>
                                        <tr>
                                            <th>Tim</th>
                                            <th>Editácie</th>
                                            <th>Vymazanie</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teams as $teams)
                                        <tr>
                                            <th>{{ $teams->name}}</th>
                                            <th> <center><a class='btn-floating  waves-effect blue darken-4' href="{{route('admin.team.update',$teams->id)}}"><i class='material-icons'>edit</i></a></center> </th>
                                            <th> <center><a class='btn-floating  waves-effect blue darken-4' href="{{route('admin.team.delete',$teams->id)}}"><i class='material-icons'>delete</i></a></center> </th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
   </div> 
</div> 

@endsection