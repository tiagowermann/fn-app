

    <x-base.header/> 

    <div class="conatiner_dash">
        <div class="body_dash">
                <div 
                    class="dash_cont"
                    style="background-color: rgb(21, 21, 245)"
                >
                    <p>Entradas</p>
                    <div class="dash_resul">
                        <span>R$ {{number_format($balance->entry,2,".","" )}}</span>
                    </div>
                    <div class="dash_container_icon">
                       <div class="dash_icon">
                        <a href="/painel/relatorio/mail/entry">
                            <img src="assets/icons/email.png" alt="">
                        </a>
                       </div>
                    </div>
                </div>
                <div 
                    class="dash_cont"
                    style="background-color: rgb(243, 26, 26)"
                >
                    <p>Saidas</p>
                    <div class="dash_resul">
                        <span>R$ {{number_format($balance->exit,2,".","" )}}</span>
                    </div>
                    <div class="dash_container_icon">
                        <div class="dash_icon">
                            <a href="/painel/relatorio/mail/exit">
                                <img src="assets/icons/email.png" alt="">
                            </a>
                        </div>
                     </div>
                    
                </div>

              
        </div>
        <section>

        <div class="dash_chart">
            <canvas id="myChart"></canvas>
        </div>
            <div class="input-headers-dash">
              <h1>Dados do Usuario</h1>
              <form  method="post" action="/dashboard/form/user">
                @csrf
                <div>
                  <label>Nome</label>
                  <input type="text" name="name" value="{{$user->name}}"/>
                </div>
                <div>
                    <label>E-mail</label>
                    <input type="text" name="email" value="{{$user->email}}"/>
                  </div>
               
                <input class="buttons" type="submit" value="Atualizar"/>
             </form>
            </div>
           
             
        </section>

        
    </div>

    
  

  <x-base.footer/>

  <script>
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Entrada', 'Saida'],
        datasets: [{
          label: 'relatorio',
          data: [{{$balance->entry}}, {{$balance->exit}}],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

