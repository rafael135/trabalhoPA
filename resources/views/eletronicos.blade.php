@extends('layouts.layout')

@section('content')
    <script>
        var exports = {};
    </script>

    <!-- Create Modal -->
    <div class="modal fade" id="addDeviceModal" tabindex="-1" aria-labelledby="addDeviceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addDeviceModalLabel">Adicionar Novo Eletrônico</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAddDevice" class="d-flex flex-column gap-2" method="POST">
                        @csrf
                        <input type="hidden" name="rememberToken" id="rememberToken"
                            value="{{ $loggedUser->remember_token }}" />

                        <div>
                            <label for="brand" class="form-label">Marca</label>
                            <input type="text" class="form-control" name="brand" id="brand" placeholder="Marca">
                        </div>

                        <div>
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nome">
                        </div>

                        <div>
                            <label for="consumptionPerHour" class="form-label">Consumo por Hora(em W)</label>
                            <input type="number" class="form-control" name="consumptionPerHour" id="consumptionPerHour"
                                placeholder="Consumo por Hora">
                        </div>

                        <div>
                            <label for="hoursPerDay" class="form-label">Uso diário(em horas)</label>
                            <input type="number" min="1" max="24" class="form-control" name="hoursPerDay"
                                id="hoursPerDay" placeholder="Marca">
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Adicionar</button>
                        

                    </form>
                    <button id="addDeviceModalBtnClose" type="button" class="btn-close d-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>


    <!-- Update Modal -->
    <div class="modal fade" id="updateDeviceModal" tabindex="-1" aria-labelledby="updateDeviceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateDeviceModalLabel">Atualizar Eletrônico</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="updateModalStatus" class="position-absolute">
                        <div class="spinner-grow" style="color: #3A3781;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <form id="formUpdateDevice" class="d-flex flex-column gap-2" method="POST">
                        @csrf
                        <input type="hidden" name="rememberToken" id="rememberToken"
                            value="{{ $loggedUser->remember_token }}" />

                        <div>
                            <label for="brand" class="form-label">Marca</label>
                            <input type="text" class="form-control" name="brand" id="brand" placeholder="Marca">
                        </div>

                        <div>
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nome">
                        </div>

                        <div>
                            <label for="consumptionPerHour" class="form-label">Consumo por Hora(em W)</label>
                            <input type="number" class="form-control" name="consumptionPerHour" id="consumptionPerHour"
                                placeholder="Consumo por Hora">
                        </div>

                        <div>
                            <label for="hoursPerDay" class="form-label">Uso diário(em horas)</label>
                            <input type="number" min="1" max="24" class="form-control" name="hoursPerDay"
                                id="hoursPerDay" placeholder="Marca">
                        </div>

                        <button type="submit" class="btn btn-primary mt-2">Atualizar</button>

                    </form>
                    <button id="updateDeviceModalBtnClose" type="button" class="btn-close d-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <button type="button" id="updateDeviceBtn" class="btn btn-primary d-none" data-bs-toggle="modal"
        data-bs-target="#updateDeviceModal">Update</button>

    <main class="container">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#addDeviceModal">Adicionar</button>

        <div id="devices" class="d-flex flex-column">
            <div id="devices-head" class="d-flex">
                <div class="">
                    Marca
                </div>
                <div class="">
                    Nome
                </div>
                <div class="">
                    Consumo por hora(W)
                </div>
                <div class="">
                    Uso diário
                </div>
                <div class="">
                    Ações
                </div>
            </div>



            <div id="devices-body" class="d-flex flex-column">
                <div class="device-status">
                    <div class="spinner-grow" style="color: #3A3781;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <div class="device-item" id="device-template">
                    <div id="item-brand" class="device-brand"></div>
                    <div id="item-name" class="device-name"></div>
                    <div id="item-consumptionPerHour" class="device-consumptionPerHour"></div>
                    <div id="item-hoursPerDay" class="device-hoursPerDay"></div>
                    <div id="device-actions" class="device-actions">
                        <span class="device-viewBtn" data-id="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </span>
                    </div>

                </div>
            </div>

        </div>

        <nav aria-label="Navegação de Eletrônicos" class="mt-auto">
            <div class="pagination-info">
                <span>Exibindo</span>
                <input class="form-control" min="1" value="1" max="1" type="number"
                    id="currentPageInput">
                <span>de</span>
                <span id="totalPages"></span>
                <span>Páginas</span>
            </div>

            <ul class="pagination pagination-lg">
                <li class="page-item">
                    <a class="page-link" id="paginationPrevious" href="" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item active"><a data-page="1" id="paginationBtn1" class="page-link"
                        href="">1</a></li>
                <li class="page-item"><a data-page="2" id="paginationBtn2" class="page-link" href="">2</a></li>
                <li class="page-item"><a data-page="3" id="paginationBtn3" class="page-link" href="">3</a></li>
                <li class="page-item">
                    <a class="page-link" id="paginationNext" href="" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </main>

    <script type="module" src="{{ Vite::asset('resources/js/devices/devices.js') }}"></script>
@endsection
