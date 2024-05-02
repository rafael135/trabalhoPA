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
    <button type="" class="btn btn-danger">Limpar</button>
  </div>
</form>
</div>
</div>

<! -- Formulario De produto  -- >

<main class="table" id="customers_table">   
    <h1>WATTSWEB</h1> 
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th> Nome</th>
                        <th> Watts</th>
                        <th> Data</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                           <button class="btn btn-dark">limpar</button>
                        </td>
                        <td> <button class="btn btn-danger">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                           <button class="btn btn-dark">limpar</button>
                        </td>
                        <td> <button class="btn btn-danger">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                           <button class="btn btn-dark">limpar</button>
                        </td>
                        <td> <button class="btn btn-danger">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                           <button class="btn btn-dark">limpar</button>
                        </td>
                        <td> <button class="btn btn-danger">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                           <button class="btn btn-dark">limpar</button>
                        </td>
                        <td> <button class="btn btn-danger">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                           <button class="btn btn-dark">limpar</button>
                        </td>
                        <td> <button class="btn btn-danger">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                           <button class="btn btn-dark">limpar</button>
                        </td>
                        <td> <button class="btn btn-danger">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                           <button class="btn btn-dark">limpar</button>
                        </td>
                        <td> <button class="btn btn-danger">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                           <button class="btn btn-dark">limpar</button>
                        </td>
                        <td> <button class="btn btn-danger">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                           <button class="btn btn-dark">limpar</button>
                        </td>
                        <td> <button class="btn btn-danger">Excluir</button></td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                           <button class="btn btn-dark">limpar</button>
                        </td>
                        <td> <button class="btn btn-danger">Excluir</button></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
 @endsection