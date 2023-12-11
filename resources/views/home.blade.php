
    <x-base.header/> 
    <main>
     
      <div>
        <div class="title-header">Controller financeiro</div>
        <div class="header-value">
          <div class="header-value-box">
            <p>Entrada</p>
            @if($balance)
              <span>R${{$balance['entry']}}</span>
              @else
              <span>R$ 0</span>
            @endif
          </div>
          <div class="header-value-box">
            <p>Saida</p>
            @if ($balance)
             <span>R${{$balance['exit']}}</span>
            @else
             <span>R$ 0</span>
            @endif
           
          </div>
          <div class="header-value-box">
            <p>Total</p>
            @if($balance)
              <span>R$ {{$balance['entry'] - $balance['exit']}}</span>
              @else
              <span>R$ 0</span>
            @endif
            
          </div>
        </div>
      
        <div>
          @if(auth()->user())
          <form class="input-headers" method="post" action="/painel/form/">
            @csrf
            <div>
              <label>Descrição</label>
              <input type="text" name="description"/>
            </div>
            <div>
              <label>value</label>
              <input type="number" name="valor"/>
            </div>
            <div class="input-radio">
              <label for="html">Entrada</label>
              <input type="radio" id="html" name="radio" value="1">
            </div>
            <div class="input-radio">
              <label for="css">Saida</label>
              <input type="radio" id="css" name="radio" value="0">
            </div>
           
            <input class="buttons" type="submit" value="Adicionar"/>
         </form>
          
          @else
            <div class="input-headers">
              <p>Para pode ver ou criar sua finanças tem que fazer login ou criar uma conta</p>
            </div>
            
          @endif
        </div>
      </div>



      <div class="container-table">
        <table>
          <thead>
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($releases as $item)
            <tr>
              <td>{{$item->description}}</td>
              <td>{{number_format($item->value,2,".","" )}}</td>
              <td>{{$item->type == 0 ? 'Negativo':'Positivo'}}</td>
              <td>
                <div class="btnContainer">
                  <div>
                    <form method="get" action="/painel/editar">
                      @csrf
                        <input type='hidden' name="id" value="{{$item->id}}"/>
                        <input type='hidden' name="desc" value="{{$item->description}}"/>
                          <input type='hidden' name="val" value="{{$item->value}}"/>
                          <input type='hidden' name="type" value="{{$item->type}}"/>
                          <input class="btnEdt" type="submit" value="Editar"/>
                            
                    </form>
                  </div>
                  <div>
                    <form method="post" action="/painel/delete">
                      @csrf
                        <input type='hidden' name="id" value="{{$item->id}}"/>
                          <input type='hidden' name="values" value="{{$item->value}}"/>
                          <input type='hidden' name="type" value="{{$item->type}}"/>
                          <input class="btnDel" type="submit" value="Deletar"/>
                            
                    </form>
                  </div>
                </div>
                    
              </td>
            </tr>
            @endforeach
          
                
              
          </tbody>
        </table>
        
        <div class="email">
          @if($balance)
            @if($balance['entry'])
              <a href="/painel/relatorio/mail" class="btnEmail" >Enviar relatorio por email</a>
              @endif
          @endif
          
        </div>
          
      </div>
      
    </main>
    <!-- header-->
    <x-base.footer/>
    <!-- /header-->
  </body>
</html>
