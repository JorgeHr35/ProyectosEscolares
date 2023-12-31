@extends('layouts.app')

@section('template_title')
    Proyecto
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Proyecto') }}
                            </span>
                             <div class="float-right">
                                <a href="{{ route('proyectos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nuevo proyecto') }}
                                </a>
                                <!-- En tu vista blade -->
                                <a href="{{ route('generate.pdf') }}" class="btn btn-danger btn-sm float-right">Generar PDF</a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <h2>Pendientes</h2>
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Materias</th>
                                        <th>Titulo</th>
                                        <th>Descripcion</th>
                                        <th>Fecha Entrega</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proyectosPendientes as $proyecto)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $proyecto->materia->nombre}}</td>
                                            <td>{{ $proyecto->titulo }}</td>
                                            <td>{{ $proyecto->descripcion }}</td>
                                            <td>{{ \Carbon\Carbon::parse($proyecto->fecha_entrega)->format('d/m/Y') }}</td>
                                            <td>{{ $proyecto->status }}</td>
                                            <td>
                                                <form action="{{ route('proyectos.destroy',$proyecto->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('proyectos.show',$proyecto->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('proyectos.edit',$proyecto->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <h2>Completados</h2>
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Materias</th>
                                        <th>Titulo</th>
                                        <th>Descripcion</th>
                                        <th>Fecha Entrega</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proyectosCompletados as $proyecto)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $proyecto->materia->nombre}}</td>
                                            <td>{{ $proyecto->titulo }}</td>
                                            <td>{{ $proyecto->descripcion }}</td>
                                            <td>{{ \Carbon\Carbon::parse($proyecto->fecha_entrega)->format('d/m/Y') }}</td>
                                            <td>{{ $proyecto->status }}</td>
                                            <td>
                                                <form action="{{ route('proyectos.destroy',$proyecto->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('proyectos.show',$proyecto->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('proyectos.edit',$proyecto->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                        

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                    
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $proyectosPendientes->links() !!}
            </div>
        </div>
    </div>
@endsection
