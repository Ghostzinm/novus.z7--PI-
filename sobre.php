<?php
$instagramHandle = 'novus.z7';
$emailContact = 'contato@novusz7.com';

include 'templates/header.php';
?>


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

<?php include 'templates/footer.php'; ?>