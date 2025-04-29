<!-- Modal Excluir -->
<div class="modal fade" id="alterar-tipo" tabindex="-1" role="dialog" aria-labelledby="modalAlterarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alterar tipo de equipamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_alterar" name="id_alterar">
        <div class="form-group ">
          <label>Tipo de equipamento: 
            <input type="text" class="form-control obg" id="tipo_alterar" name="tipo_alterar" placeholder="Digite o novo tipo de equipamento" onkeypress="FocarCampoTravar(event, 'btn_alterar')" style="width: 300px;">
          </label>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" name="btn_alterar" onclick="AlterarTipoEquipamento('formAlt')">Alterar</button>
      </div>
    </div>
  </div>
</div>