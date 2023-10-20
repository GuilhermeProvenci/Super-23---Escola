<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bem-Vindo ao Nosso Sistema</title>
  <link rel="stylesheet" type="text/css" href="../css_avulsos/welcome.css">

</head>

<body>
  <header>
    <nav>
      <div class="logo">Super23</div>
      <ul>
        <li><a href="#">Início</a></li>
        <li><a href="#">Recursos</a></li>
        <li><a href="#">Sobre Nós</a></li>
        <li><a href="#">Contato</a></li>
      </ul>
    </nav>
  </header>
  <section class="hero">
    <div class="container">
      <div class="hero-text">
        <h1>Bem-Vindo ao Nosso Sistema</h1>
        <p>Explore todas as funcionalidades incríveis que oferecemos.</p>
        <a href="login.php" class="btn">Fazer Login</a>
      </div>
    </div>
  </section>
  <section class="features">
    <div class="container">
      <h2>Recursos do Sistema</h2>
      <div class="feature">
        <div class="feature-icon"><i class="fas fa-users"></i></div>
        <h3>Gerenciamento de Usuários</h3>
        <p>Gerencie facilmente os usuários do seu sistema.</p>
      </div>
      <div class="feature">
        <div class="feature-icon"><i class="fas fa-cog"></i></div>
        <h3>Configurações Personalizadas</h3>
        <p>Personalize as configurações de acordo com suas necessidades.</p>
      </div>
      <div class="feature">
        <div class="feature-icon"><i class="fas fa-chart-bar"></i></div>
        <h3>Relatórios e Estatísticas</h3>
        <p>Acesse relatórios e estatísticas para tomar decisões informadas.</p>
      </div>
    </div>
  </section>
  <footer>
    <div class="container">
      <p>&copy;
        <?php echo date("Y"); ?> Seu Nome ou Empresa. Todos os direitos reservados.
      </p>
    </div>
  </footer>
</body>

</html>