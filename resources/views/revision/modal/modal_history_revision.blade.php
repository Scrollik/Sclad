<div class="modal fade" id="history_revisionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">История ревизий</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <input class="form-control mt-3" type="text" id="myInputOrderHistory" onkeyup="myFunction()" placeholder="Поиск">
                <table class="table-bordered table-responsive text-center mt-3">
                    <thead>
                    <tr>
                        <th scope="col">Дата</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody id="history_table">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

