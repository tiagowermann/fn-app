
<x-base.header/> 
<main>
    <h1>Dados do Usuario</h1>
    <form class="input-headers-dash" method="post" action="/painel/editar">
        @csrf
        <div>
          <label>Descrção</label>
          <input type="hidden" name="id" value="{{$id}}"/>
          <input type="text" name="desc" value="{{$desc}}"/>
        </div>
        <div>
            <label>valor</label>
            <input type="text" name="val" value="{{$val}}"/>
        </div>
        <div class="input-radio">
            <label for="html">Entrada</label>
            <input {{$type? 'checked':'' }}  type="radio" id="html" name="radio" value="1">
          </div>
          <div class="input-radio">
            <label for="css">Saida</label>
            <input {{$type? '':'checked' }} type="radio" id="css" name="radio" value="0">
          </div>
       
        <input class="buttons" type="submit" value="Atualizar"/>
     </form>
     
</main>
<!-- header-->
<x-base.footer/>
<!-- /header-->
</body>
</html>
