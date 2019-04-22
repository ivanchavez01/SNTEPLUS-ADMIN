@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Nuevo negocio

                <a href="{{url('business')}}" class="float-right">Regresar</a>
            </div>
            <div class="card-body">
                <form action="{{url('business')}}" method="POST" enctype="multipart/form-data">
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
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <textarea class="form-control" name="address" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Logotipo</label>
                        <input type="file" name="logo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="number" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Localidad</label>
                        <select name="municipality_id" class="form-control">
                            @foreach($municipalities as $municipality)
                                <option value="{{$municipality->id}}">{{$municipality->municipio}}</option>
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