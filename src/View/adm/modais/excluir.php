<!-- Modal Excluir -->
<div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmação de remoção</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_excluir" name="id_excluir">
        <div class="form-group">
          <label>Deseja remover o registro: <span id="nome_excluir"></span>
          </label>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" name="btn_excluir" onclick="Excluir()">Remover</button>
      </div>
    </div>
  </div>
</div>