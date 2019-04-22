@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Empresas

            <a href="{{url('business/create')}}" class="btn btn-success btn-sm float-right">
                <i class="fa fa-plus"></i>
                Nuevo
            </a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Negocio</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Logo</th>
                    <th>Municipio</th>
                    <th></th>
                </thead>
                @foreach($business as $b)
                <tr>
                    <td>{{$b->id}}</td>
                    <td>{{$b->name}}</td>
                    <td>{{$b->address}}</td>
                    <td>{{$b->phone}}</td>
                    <td><img src="{{url('storage/'.$b->logo)}}"></td>
                    <td>{{$b->municipality->municipio}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Opciones
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{url('business/'.$b->id.'/edit')}}">Editar</a>
                                <a class="dropdown-item btn-delete" href="{{url('business/'.$b->id)}}">Eliminar</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    {{$business->links()}}
</div>

@push("scripts")
<script>
$(document).ready(() => {
    $('.dropdown-toggle').dropdown();
    $(".btn-delete").click(function(e) {
        e.preventDefault();
        if(confirm("Esta seguro de eliminar este negocio?")) {
            axios.delete($(this).attr("href"))
            .then((res) => {
                window.location.reload();
            })
        }
    })
})
</script>
@endpush

@endsection
 