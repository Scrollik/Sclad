<div class="modal fade" id="confirmed_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Подтверждение удаления поставки</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form id="confrim_form" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-group">
                            <div class="alert alert-info" role="alert">
                                Поставка удаляется только из истории поставок(внесенные ранее материалы не вычитаются из таблицы сырого пиломатериала)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary " id="btn_register">Подтвердить удаление</button>
                </div>
            </form>
        </div>
    </div>
</div>
