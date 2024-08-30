<div class="modal fade" id="materials_amountModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактирование количества материала </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form action="{{route('sclad_of_raw.update')}}" method="POST" id="edit_amount_materials">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" id="id_raw" name="id">
                        <div class="form-group">
                            <label for="name" class="form-label">Количество материала:</label>
                            <input type="number"  class="form-control " id="amount_materials"  autofocus name="amount_material">
                            <span class="text-danger error-text amount_error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary ">Подтвердить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>

