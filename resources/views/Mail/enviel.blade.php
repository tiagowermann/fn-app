<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        Ola {{$user}}<br/>
        @if($resul->entry)
            Este aqui e o total de entradas que você teve {{$resul->entry}}
        @endif
        @if($resul->exit)
            Este aqui e o total de saidas que você teve {{$resul->exit}}
        @endif
           
    </div>
</body>
</html>