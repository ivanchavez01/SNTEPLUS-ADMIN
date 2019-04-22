@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Nuevo beneficio
                <a href="{{url('benefits')}}" class="float-right">Regresar</a>
            </div>
            <div class="card-body">
                <form action="{{url('benefits/update')}}" method="POST">
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
                    <input type="hidden" name="id" value="{{$benefit->id}}">
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="description" value="{{$benefit->description}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Descripción corta</label>
                        <input type="text" name="short_description" value="{{$benefit->short_description}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Localidad</label>
                        <select name="municipality_id" class="form-control">
                            @foreach($municipalities as $municipality)
                                @if($benefit->municipality_id == $municipality->id)
                                <option value="{{$municipality->id}}" selected>{{$municipality->municipio}}</option>
                                @else 
                                <option value="{{$municipality->id}}">{{$municipality->municipio}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipo de servicio</label>
                        <select name="service_type_id" class="form-control">
                            @foreach($service_types as $service_type)
                                @if($benefit->service_type_id == $service_type->id)
                                <option value="{{$service_type->id}}" selected>{{$service_type->name}}</option>
                                @else 
                                <option value="{{$service_type->id}}">{{$service_type->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Negocio</label>
                        <select name="business_id" class="form-control">
                            @foreach($business as $b)
                                @if($b->id == $benefit->business_id)
                                <option value="{{$b->id}}" selected>{{$b->name}}</option>
                                @else
                                <option value="{{$b->id}}">{{$b->name}}</option>
                                @endif
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