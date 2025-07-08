<!-- Modal Excluir -->
<div class="modal fade" id="modal-descarte" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content gb-secondary">
      <div class="modal-header">
        <h5 class="modal-title">Confirmação de descarte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
          <label>Data de descarte</label>
          <input type="datetime-local" class="form-control obg" id="data_descarte" name="data_descarte" readonly>
          <!-- Comando para Mostrar data fixa -->
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const now = new Date();
              // Ajusta para o fuso horário local do computador
              const offset = now.getTimezoneOffset();
              const localDate = new Date(now.getTime() - (offset * 60000));
              // Formata para yyyy-MM-dd (apenas data)
              const formatted = localDate.toISOString().slice(0, 10);
              const input = document.getElementById('data_descarte');
              input.type = 'date';
              input.value = formatted;
            });
          </script>
        </div>
        <div class="form-group">
          <label>Motivo do descarte</label>
          <textarea maxlength="150" class="form-control obg" id="motivo_descarte" name="motivo_descarte" rows="3" placeholder="Descreva o motivo do descarte"></textarea>
        </div>

        <input type="hidden" id="id_descarte" name="id_descarte">
        <div class="form-group">
          <label>Deseja descartar o registro? <span id="nome_descarte"></span></label>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" name="btn_excluir" onclick="Excluir()">Descartar</button>
      </div>
    </div>
  </div>
</div>