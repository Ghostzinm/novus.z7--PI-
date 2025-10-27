<!-- Modal -->
<div class="modal fade" id="forgotModal" tabindex="-1" aria-labelledby="forgotModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="forgotForm" method="post" action="send_reset.php">
        <div class="modal-header">
          <h5 class="modal-title" id="forgotModalLabel">Recuperar senha</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <p>Digite seu e-mail para receber o link de redefinição de senha:</p>
          <div class="mb-3">
            <label for="emailForgot" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="emailForgot" name="email" required>
          </div>
          <div id="forgotMessage" class="text-success"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Enviar link</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>
