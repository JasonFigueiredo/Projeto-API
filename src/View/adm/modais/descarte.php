<!-- Modal Excluir -->
<div class="modal fade" id="modal-descarte" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-default">
      <div class="modal-header">
        <h5 class="modal-title">Confirmação de descarte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
          <div class="form-group">
            <label>Deseja descartar o registro? <span id="nome_descarte"></span></label>
          </div>
          <label>Data de descarte:</label>
           <input type="date" class="form-control obg" id="data_descarte" name="data_descarte">
        </div>
        <div class="form-group">
          <label>Motivo do descarte:</label>
          <textarea maxlength="150" class="form-control obg" id="motivo_descarte" name="motivo_descarte" rows="3" placeholder="Descreva o motivo do descarte" onkeyup="countChars(this)"></textarea>
          <small id="charCount" class="form-text text-muted">150 caracteres restantes</small>
        </div>

        <input type="hidden" id="id_descarte" name="id_descarte">
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" name="btn_descarte" onclick="Descartar('formDesc')">Descartar</button>
      </div>
    </div>
  </div>
</div>