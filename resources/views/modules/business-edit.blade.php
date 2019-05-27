@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Nuevo negocio

                <a href="{{url('business')}}" class="float-right">Regresar</a>
            </div>
            <div class="card-body">
                <form action="{{url('business/'.$business->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" value="{{$business->name}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <textarea class="form-control" name="address" rows="4">{{$business->address}}</textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label>Latitude</label>
                            <input class="form-control" value="{{$business->lat}}" name="lat" />
                        </div>
                        <div class="form-group col-md-2">
                            <label>Longitude</label>
                            <input class="form-control" value="{{$business->long}}" name="long" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Logotipo</label>
                        <input type="file" name="logo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="number" value="{{$business->phone}}" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Localidad</label>
                        <select name="municipality_id" class="form-control">
                            @foreach($municipalities as $municipality)
                                <option value="{{$municipality->id}}" @if($municipality->id == $business->municipality_id) selected="selected" @endif>{{$municipality->municipio}}</option>
                            @endforeach
                        </select>
                    </div>
                   

                    <div class="form-group">
                        <button class="btn btn-primary float-right">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection