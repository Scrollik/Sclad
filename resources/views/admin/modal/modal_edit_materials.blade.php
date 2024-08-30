<div class="modal fade" id="materialsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактирование материала </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form action="{{route('materials.update',$material->id)}}" method="POST" id="edit_materials">
                @csrf
                @isset($material)
                    @method('PUT')
                @endisset
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" id="id_materials" name="id">
                        <div class="form-group">
                            <label for="name" class="form-label">Название материала:</label>
                            <input type="text"  class="form-control " id="name_mat"  autofocus name="name_materials" value="">
                            <span class="text-danger error-text name_materials_error"></span>
                            <div class="input-group mb-3 mt-3">
                                <input id="materials_height" type="number" class="form-control" placeholder="Высота" name="height" >
                                <span class="text-danger error-text height_error"></span>
                                <span class="input-group-text">X</span>
                                <input id="materials_width" type="number" class="form-control" placeholder="Ширина" name="width">
                                <span class="text-danger error-text width_error"></span>
                            </div>
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
