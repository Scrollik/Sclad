<div class="modal fade" id="confirm_dryerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Подтверждение завершения сушки </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form action="{{route('dryer.update',$dryer->id)}}" method="POST" id="confirm_dryer">
                @csrf
                @isset($dryer)
                    @method('PUT')
                @endisset
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" id="id_dryer" name="id" value="">
                        <div class="form-group" id="confirm_dryers_form">
                            <div class="alert alert-danger" role="alert">
                                Вы действительно хотите подтвердить сушку?
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary ">Подтвердить</button>
                </div>
            </form>
        </div>
    </div>
</div>

