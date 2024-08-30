{{--    Модальное окно регистрации нового пользователя--}}
<div class="modal fade" id="show_tableModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1>Состав ревезии</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form id="confirm_form" action="" method="POST" >
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <table class="table" id="revision_table">
                        <tbody>
                        <tr>

                            <th>
                                Название пиломатериала
                            </th>
                            <th>
                                Было
                            </th>
                            <th>
                                Стало
                            </th>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary " id="btn_register">Подтвердить ревизию</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--    Конец Модальное окно регистрации нового пользователя--}}
