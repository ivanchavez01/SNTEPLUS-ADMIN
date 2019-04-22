@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Nuevo beneficio
                <a href="{{url('benefits')}}" class="float-right">Regresar</a>
            </div>
            <div class="card-body">
                <form action="{{url('benefits/save')}}" method="POST">
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
                        <label>Descripción</label>
                        <input type="text" name="description" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Descripción corta</label>
                        <input type="text" name="short_description" class="form-control">
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
                        <label>Tipo de servicio</label>
                        <select name="service_type_id" class="form-control">
                            @foreach($service_types as $service_type)
                            <option value="{{$service_type->id}}">{{$service_type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Negocio</label>
                        <select name="business_id" class="form-control">
                            @foreach($business as $b)
                                <option value="{{$b->id}}">{{$b->name}}</option>
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