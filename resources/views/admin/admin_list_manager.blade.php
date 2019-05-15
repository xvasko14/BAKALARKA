@extends('layouts.adminLayout.admin_design')
@section('obsah')

  


<div id="content">
     <div id="content-header">
             <div id="breadcrumb"> <a href="{{ url('/admin') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
        </div>
 <div class="container" style="max-width:90%; ">
        <div class="row">

            <form action="{{ route('admin.managers.list')}}" method="get">
                @if (session('insert'))
                    <div class="alert alert-success">
                        {{ session('insert') }}
                    </div>
                    <br>
                @endif
                @if (session('deleted'))
                    <div class="alert alert-success">
                        {{ session('deleted') }}
                    </div>
                    <br>
                @endif
                @if (session('updated'))
                    <div class="alert alert-success">
                        {{ session('updated') }}
                    </div>
                    <br>
                @endif
                <div class="form-group">
                    {{ csrf_field()}}
                    <input type="text" class="form-control" name="search" placeholder="{{ __('message.Player') }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">{{ __('message.search') }}</button>
                </div>
            </form>
            <div class="col-md-11 col-md-offset-2">
                <div class="panel panel-default">
                    <h1 align="center">Zoznam trénerov</h1>

                    <div class="panel-heading">
                        <div class="">
                            <div class="panel-body">
                                
                                <table id="rooms-table" class="table table-bordered table-striped table-condensed" border=1 width="400">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Meno</th>      
                                            <th>Editácie</th>
                                            <th>Vymazanie</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($managers as $manager)
                                        <tr>
                                            <th>{{ $manager->id}}</th> 
                                            <th>{{ $manager->name}}</th>
                                            <th> <center><a class='btn-floating  waves-effect blue darken-4' href="{{route('admin.manager.update',$manager->id)}}"><i class='material-icons'>edit</i></a></center> </th>
                                            <th> <center><a class='btn-floating  waves-effect blue darken-4' href="{{route('admin.manager.delete',$manager->id)}}"><i class='material-icons'>delete</i></a></center> </th>
                                        </tr>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <span>{{ $managers->links() }}</span>
                                
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
   </div> 
</div> 

@endsection