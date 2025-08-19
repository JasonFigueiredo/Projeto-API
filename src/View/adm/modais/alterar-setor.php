<!-- Modal Alterar Setor -->
<div class="modal fade" id="modal-alterar" tabindex="-1" role="dialog" aria-labelledby="modalAlterarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alterar Setor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_alterar" name="id_alterar">
        <div class="form-group">
          <label>Nome do Setor: 
            <input type="text" maxlength="45" class="form-control obg" id="nome_alterar" name="nome_alterar" placeholder="Digite o novo nome do setor" onkeypress="FocarCampoTravar(event, 'btn_alterar')" style="width: 300px;">
          </label>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" name="btn_alterar" onclick="Alterar()">Alterar</button>
      </div>
    </div>
  </div>
</div>
