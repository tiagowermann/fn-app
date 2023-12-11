<h1>Relatorio</h1>

<div>
    <p>Entrada: R$ {{$banl->entry}}</p>
    <p>Saida: R$ {{$banl->exit}}</p>
    <p>Total: R$ {{$banl->entry - $banl->exit}}</p>
</div>
<div class="container-table">
    <table>
      <thead>
        <tr>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Tipo</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($releases as $item)
        <tr>
          <td>{{$item->description}}</td>
          <td>{{$item->value}}</td>
          <td>{{$item->type == 0 ? 'Negativo':'Positivo'}}</td>
          <td>
           
          </td>
        </tr>
        @endforeach
      
            
          
      </tbody>
    </table>
