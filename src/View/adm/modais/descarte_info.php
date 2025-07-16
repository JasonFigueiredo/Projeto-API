<!-- Modal Excluir -->
<div class="modal fade" id="modal-descarteinfo" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-secondary">
      <div class="modal-header">
        <h5 class="modal-title">Dados do descarte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group">
          <div class="form-group">
            <label>Dados do equipamento: <span id="nome_descarte_info"></span></label>
          </div>
          <label>Data de descarte:</label>
           <input disabled type="date" class="form-control" id="data_descarte_info" name="data_descarte_info">
        </div>
        <div class="form-group">
          <label>Motivo do descarte:</label>
          <textarea disabled class="form-control" id="motivo_info" name="motivo_info" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>