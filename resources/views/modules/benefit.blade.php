@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Beneficios

            <a href="{{url('benefits/create')}}" class="btn btn-success btn-sm float-right">
                <i class="fa fa-plus"></i>
                Guardar
            </a>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <td>ID</td>
                    <td>Descripción</td>
                    <td>Negocio</td>
                    <td>Tipo Servicio</td>
                    <td>Ubicación</td>
                    <td>Opciones</td>
                </tr>
                @foreach($benefits as $benefit)
                <tr>
                    <td>{{$benefit->id}}</td>
                    <td>{{$benefit->short_description}}</td>
                    <td>{{$benefit->business->name}}</td>
                    <td>{{$benefit->serviceType->name}}</td>
                    <td>{{$benefit->municipality->municipio}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opciones
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{url('benefits/'.$benefit->id.'/edit')}}">Editar</a>
                                <a class="dropdown-item" href="{{url('benefits/'.$benefit->id.'/delete')}}">Eliminar</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        {{ $benefits->links() }}
    </div>
</div>

@push("scripts")
<script>
$(document).ready(() => {
    $('.dropdown-toggle').dropdown();
})
</script>
@endpush

@endsection
 