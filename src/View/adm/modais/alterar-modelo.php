<!-- Modal Excluir -->
<div class="modal fade" id="alterar-modelo" tabindex="-1" role="dialog" aria-labelledby="modalAlterarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alterar modelo do equipamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <input type="hidden" id="id_alterar" name="id_alterar">
        <div class="form-group ">
          <label>Modelo de equipamento: 
            <input type="text" class="form-control obg" id="modelo_alterar" name="modelo_alterar" placeholder="Digite o novo modelo de equipamento" onkeypress="FocarCampoTravar(event, 'btn_alterar')" style="width: 300px;">
          </label>
        </div>
      </div>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="modelo_alterar" name="btn_alterar" onclick="AlterarModeloEquipamento('formAlt')">Alterar</button>
      </div>
    </div>
  </div>
</div>