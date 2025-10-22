<?php
$instagramHandle = 'novus.z7';
$emailContact = 'contato@novusz7.com';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sobre - novus.z7</title>
  <style>
    :root {
      --color-bg: #0f0f0f;
      --color-bg-card: rgba(20, 20, 20, 0.85);
      --color-primary: #00ff88;
      --color-primary-dark: #00cc6a;
      --color-secondary: #ff0055;
      --color-text: #ffffff;
      --color-text-muted: #aaaaaa;
      --color-border: rgba(255, 255, 255, 0.1);
      --shadow-neon: 0 0 15px var(--color-primary);
      --transition-default: 0.4s ease-in-out;
    }

    .novusz7 * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }

    body.novusz7-body {
      font-family: 'Poppins', sans-serif;
      color: var(--color-text);
      background: linear-gradient(180deg, rgba(0,255,136,0.03), rgba(0,0,0,0.9));
      margin: 0;
      padding: 0;
    }

    header.novusz7-header {
      padding: 20px 40px;
      background: var(--color-bg-card);
      border-bottom: 1px solid var(--color-border);
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: var(--shadow-neon);
    }
    .novusz7-header__title { color: var(--color-primary); font-size:1.6rem; margin:0; }

    main.novusz7-main { padding: 60px 20px; display:flex; justify-content:center; }
    .novusz7-container {
      max-width: 1000px;
      width: 100%;
      background-color: var(--color-bg-card);
      border-radius: 16px;
      padding: 40px;
      display:flex;
      flex-wrap:wrap;
      gap:40px;
      border:1px solid var(--color-border);
      box-shadow: var(--shadow-neon);
    }

    article.novusz7-about { flex:1 1 400px; }
    article.novusz7-about h1 { font-size:1.8rem; color: var(--color-primary); margin-bottom:10px; }
    article.novusz7-about p { line-height:1.6; margin-bottom:16px; color: var(--color-text-muted); }
    ul.novusz7-list { list-style:none; padding:0; margin:20px 0; }
    ul.novusz7-list li { background: rgba(255,255,255,0.03); border-radius:10px; border:1px solid var(--color-border); padding:12px 14px; margin-bottom:10px; color: var(--color-text-muted); font-size:0.95rem; }

    aside.novusz7-contact { flex:0 0 280px; display:flex; flex-direction:column; gap:12px; padding:20px; background:rgba(0,0,0,0.4); border-radius:12px; border:1px solid var(--color-border);}
    aside.novusz7-contact h2 { font-size:1rem; color: var(--color-primary); margin:0 0 8px 0;}
    .novusz7-btn { display:inline-block; text-decoration:none; padding:10px 16px; border-radius:8px; font-weight:600; border:1px solid transparent; transition: var(--transition-default); text-align:center;}
    .novusz7-btn--primary { color: var(--color-primary); border-color: rgba(0,255,136,0.3); background:transparent;}
    .novusz7-btn--primary:hover { box-shadow: var(--shadow-neon); transform: translateY(-3px);}
    .novusz7-btn--secondary { color: var(--color-secondary); border-color: rgba(255,0,85,0.3); background:transparent;}

    /* SEÇÕES DE EXPLICAÇÃO */
    .novusz7-topic { background: rgba(0,0,0,0.3); border:1px solid var(--color-border); border-radius:12px; padding:20px; margin-bottom:20px;}
    .novusz7-topic h3 { color: var(--color-primary); margin-bottom:8px; }
    .novusz7-topic p { color: var(--color-text-muted); line-height:1.5; }

    /* FOOTER */
    footer.novusz7-footer { padding:40px 20px 20px; background: var(--color-bg-card); border-top:1px solid var(--color-border); text-align:center; color: var(--color-text-muted);}
    footer.novusz7-footer ul { list-style:none; padding:0; margin:0 0 20px 0; display:flex; flex-wrap:wrap; justify-content:center; gap:20px;}
    footer.novusz7-footer a { color: var(--color-primary); text-decoration:none; transition: var(--transition-default);}
    footer.novusz7-footer a:hover { color: var(--color-secondary); text-shadow:0 0 8px var(--color-secondary);}
    footer.novusz7-footer small{ display:block; font-size:0.8rem; opacity:0.7;}

    @media(max-width:768px){ .novusz7-container{flex-direction:column;} aside.novusz7-contact{width:100%;} footer.novusz7-footer ul{gap:12px;} }
  </style>
</head>
<body class="novusz7-body">

  <header class="novusz7-header">
    <h1 class="novusz7-header__title">novus.z7</h1>
  </header>

  <main class="novusz7-main">
    <section class="novusz7-container">
      <article class="novusz7-about" aria-labelledby="sobre-titulo">
        <h1 id="sobre-titulo">Sobre a novus.z7</h1>
        <p>Roupas street com presença — sem precisar gritar.</p>
        <p>A <strong>novus.z7</strong> nasceu pra quem se veste com atitude, mas prefere que o estilo fale por si. Nosso objetivo é oferecer peças street autênticas, de alta qualidade, com um processo simples e direto — da escolha ao recebimento.</p>

        <ul class="novusz7-list">
          <li><strong>Estilo:</strong> peças exclusivas com identidade urbana.</li>
          <li><strong>Processo:</strong> você escolhe, finaliza e recebe o rastreio por e-mail.</li>
          <li><strong>Envio:</strong> entrega rápida e segura em todo o Brasil.</li>
        </ul>

        <p>☯🎭💭 A gente faz a roupa. Você faz o resto.</p>
      </article>

      <aside class="novusz7-contact" aria-labelledby="contato-titulo">
        <h2 id="contato-titulo">Fale com a gente</h2>
        <a class="novusz7-btn novusz7-btn--primary" href="https://instagram.com/<?php echo htmlspecialchars($instagramHandle); ?>" target="_blank">Instagram @<?php echo htmlspecialchars($instagramHandle); ?></a>
        <a class="novusz7-btn novusz7-btn--secondary" href="mailto:<?php echo htmlspecialchars($emailContact); ?>">E-mail: <?php echo htmlspecialchars($emailContact); ?></a>
      </aside>

      <!-- SEÇÕES DE EXPLICAÇÃO DOS TOPICOS -->
      <section id="suporte" class="novusz7-topic">
        <h3>Suporte</h3>
        <p>Nosso suporte está disponível para tirar dúvidas sobre produtos, pedidos e funcionalidades da loja. Entre em contato pelo Instagram ou e-mail que responderemos rapidamente.</p>
      </section>

      <section id="trocas" class="novusz7-topic">
        <h3>Trocas & Devoluções</h3>
        <p>Se algo não servir ou não atender suas expectativas, você pode solicitar troca ou devolução em até 7 dias após o recebimento. Garantimos processo rápido e seguro.</p>
      </section>

      <section id="frete" class="novusz7-topic">
        <h3>Frete & Entregas</h3>
        <p>Oferecemos frete com rastreio para todo o Brasil. O prazo varia de acordo com sua região, mas você receberá todas as atualizações do envio por e-mail.</p>
      </section>

      <section id="privacidade" class="novusz7-topic">
        <h3>Privacidade</h3>
        <p>Seus dados estão seguros conosco. Não compartilhamos informações pessoais com terceiros e usamos os dados apenas para processar pedidos e melhorar a experiência de compra.</p>
      </section>

    </section>
  </main>

  <footer class="novusz7-footer">
    <nav aria-label="Links institucionais">
      <ul>
        <li><a href="#suporte">Suporte</a></li>
        <li><a href="#trocas">Trocas & Devoluções</a></li>
        <li><a href="#frete">Frete & Entregas</a></li>
        <li><a href="#privacidade">Privacidade</a></li>
      </ul>
    </nav>
    <small>novus.z7 — o som de quem anda em silêncio.</small>
  </footer>

</body>
</html>
