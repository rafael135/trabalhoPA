@extends('layouts.layout')

@section('content')
    <script src="{{ Vite::asset('resources/js/plotly-2.32.0.min.js') }}"></script>

    <div class="dashboard-container gap-4">
        <div class="row">
            <div class="col-12">
                <a href="{{ route("eletronicos") }}" class="btn btn-deviceRegister">
                    Cadastrar Eletrônico
                </a>
            </div>
        </div>

        <div class="dashboard-cards d-flex flex-wrap row-cols-12 row-cols-md-6 row-cols-lg-4 gap-4 gap-md-0 gap-lg-4">
            <div class="card flex-lg-fill col-12 col-md-6 col-lg-4">
                <div class="card-body">
                    <div class="card-energyConsumed">
                        <div class="d-flex flex-column gap-1">
                            <h2>Energia Total Consumida</h2>
                            <h4>Últimos 30 dias</h4>
                        </div>

                        <div class="d-flex flex-column gap-1 mt-auto">
                            <h2>{{ $energyConsumedMonth['currentMonth'] }} kW</h2>
                            <h4>
                                <span class="@if($energyConsumedMonth['differencePercentage'] > 0) text-success @else text-danger @endif">
                                    @if ($energyConsumedMonth['differencePercentage'] > 0)
                                        +{{ $energyConsumedMonth['differencePercentage'] }}%
                                    @else
                                        -{{ $energyConsumedMonth['differencePercentage'] }}%
                                    @endif
                                </span>
                                Comparado ao mês anterior
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card flex-lg-fill col-12 col-md-6 col-lg-4">
                <div class="card-body">
                    <div class="card-costPrice">
                        <div class="d-flex flex-column gap-1">
                            <h2>Custo</h2>
                            <h4>Últimos 30 dias</h4>
                        </div>

                        <div class="d-flex flex-column gap-1 mt-auto">
                            <h2>
                                R$ {{ $energyConsumedMonth['currentMonthPrice'] }}
                            </h2>
                            <!--<h4>Últimos 30 dias</h4>-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="card flex-lg-fill col-12 col-md-12 col-lg-4 mt-md-4 mt-lg-0">
                <div class="card-body">
                    <div class="card-costPrice">
                        <div class="d-flex flex-column gap-1">
                            <h2>Eletrônicos Registrados</h2>
                            <h4>Últimos 30 dias</h4>
                        </div>

                        <div class="d-flex flex-column gap-1 mt-auto">
                            <h2>
                                Total: {{ $devices["countDevices"] }}
                            </h2>
                            <h4>Últimos 30 dias</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-4">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="card-eletricityUsage">
                        <div class="d-flex flex-column gap-1">
                            <h2>Uso de Energia</h2>
                            <h4>Últimos 30 dias</h4>
                        </div>

                        <div class="d-flex flex-column gap-1">
                            <div class="" id="eletricityUsageGraph">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                @if(count($energyConsumedMontly["monthsConsume"]) > 0)
                    let x = [
                        @for ($i = 0; $i < count($energyConsumedMontly['months']); $i++)
                            <?php
                            echo '"' . $energyConsumedMontly['months'][$i] . '"';
                            if ($i + 1 < count($energyConsumedMontly['months'])) {
                                echo ',';
                            }
                            ?>
                        @endfor
                    ];

                    let y = [
                        @for ($i = 0; $i < count($energyConsumedMontly['monthsConsume']); $i++)
                            <?php
                            echo $energyConsumedMontly['monthsConsume'][$i]->total_kw_consumed;
                            if ($i + 1 < count($energyConsumedMontly['monthsConsume'])) {
                                echo ',';
                            }
                            ?>
                        @endfor
                    ];
                @else
                    let x = [];
                    let y = [];
                @endif
            </script>

            <script src="{{ Vite::asset('resources/js/home/eletricityUsage.js') }}"></script>
        </div>

        <div class="d-etow-cols-4 gap-4">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="card-deviceCosts">
                        <div class="d-flex flex-column gap-1">
                            <h2>Custo por eletrônico</h4>
                                <div id="eletricityUsagePerDevice">

                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                @if(count($devices["deviceCosts"]) > 0)
                    let labels = [
                        @for ($i = 0; $i < $devices['countDevices']; $i++)
                            <?php
                            echo '"' . $devices['devices'][$i]->name . '"';
                            if ($i + 1 < $devices['countDevices']) {
                                echo ',';
                            }
                            ?>
                        @endfor
                    ];

                    let values = [
                        @for ($i = 0; $i < $devices['countDevices']; $i++)
                            <?php
                            echo round($devices['deviceCosts'][$i]->kw_cost, 2);
                            if ($i + 1 < $devices['countDevices']) {
                                echo ',';
                            }
                            ?>
                        @endfor
                    ];
                @else
                    let labels = [];
                    let values[];
                @endif
            </script>

            <script src="{{ Vite::asset("resources/js/home/eletricityUsagePerDevice.js") }}"></script>
        </div>
    </div>

    
@endsection
