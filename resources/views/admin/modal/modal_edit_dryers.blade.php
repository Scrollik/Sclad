<div class="modal fade" id="dryersModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактирование сушилки </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form action="{{route('dryers.update',$dryer->id)}}" method="POST" id="edit_dryers">
                @csrf
                @isset($dryer)
                    @method('PUT')
                @endisset
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" id="id_dryers" name="id">
                        <div class="form-group">
                            <label for="name" class="form-label">Название сушилки:</label>
                            <input type="text"  class="form-control " id="name_dry"  autofocus name="dryers_name" >
                            <span class="text-danger error-text name_dryers_error"></span>
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
<?php
