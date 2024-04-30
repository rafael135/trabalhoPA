@extends('layouts.layout')

@section('content')

<div class="produtosback">
<div class="cards">
<form>
  <div class="form-row">
    <div class="nomeeletronico">
      <input type="text" class="form-control" placeholder="Nome Eletrodomestico">
    </div>
    <div class="watts">
      <input type="text" class="form-control" placeholder="Watts">
    </div>
  <div class="horas">
      <input type="datetime-local" class="form-control" placeholder="horas"/>
  </div>
  <div class="add">
    <button type="" class="btn btn-primary">Adicionar</button>
  </div>
  <div class="excluir">
    <button type="" class="btn btn-danger">Excluir</button>
  </div>
</form>
</div>
</div>

<! -- Formulario De produto  -- >

<div class="container-lg">
    <div class="table-responsive">
        <div class="table-wrapper">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Watts</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>      
                </tbody>
            </table>
        </div>
    </div>
</div>     
 @endsection