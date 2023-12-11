<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&family=Open+Sans:ital@0;1&family=Oswald:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/style.css" />
    <title>Minhas Finaças</title>
  </head>

  <body>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
          href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&family=Open+Sans:ital@0;1&family=Oswald:wght@400;700&display=swap"
          rel="stylesheet"
        />
        <link rel="stylesheet" href="../assets/style.css" />
        <title>Minhas Finaças</title>
      </head>
    
      <body>
<header>
    <div class="header-area">
      <a href="/" class="header-area-left">Minhas Finanças</a>
      
      <div class="header-area-right">
        <div class="nav-heade">
          @if(!$user)
            <a href="/painel/login" class="my-account">
              <img src="assets/icons/userIcon.png" />
                Fazer login
            </a>
            @else
          
            <a href="/dashboard" class="my-account">
              <img src="assets/icons/configIcon.png" />
                Dashborad
            </a>
            
          @endif
          
          @if($user)
            <a class="my-account-logout" href="/painel/logout">
              <img src="assets/icons/logoutIcon.png" />
              Sair
          </a>
          @endif
          
        </div>
      </div>
    </div>
  </header>