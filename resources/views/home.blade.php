@extends('layouts.layout')

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-cards d-flex row-cols-4 gap-4">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="card-energyConsumed">
                        <div class="d-flex flex-column gap-1">
                            <h2>Energia Total Consumida</h2>
                            <h4>Últimos 30 dias</h4>
                        </div>

                        <div class="d-flex flex-column gap-1">
                            <h2>{{ $energyConsumedMonth["currentMonth"] }} kWh</h2>
                            <h4>
                                @if($energyConsumedMonth["differencePercentage"] > 0)
                                    +{{ $energyConsumedMonth["differencePercentage"] }}
                                @else
                                    -{{ $energyConsumedMonth["differencePercentage"] }}
                                @endif
                                Comparado ao mês anterior
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card flex-fill">
                <div class="card-body">
                    <div class="card-costPrice">
                        <div class="d-flex flex-column gap-1">
                            <h2>Custo</h2>
                            <h4>Últimos 30 dias</h4>
                        </div>

                        <div class="d-flex flex-column gap-1">
                            <h2>

                            </h2>
                            <!--<h4>Últimos 30 dias</h4>-->
                        </div>
                    </div>
                </div>
            </div>

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
                let x = [
                    @for($i = 0; $i < count($energyConsumedMontly); $i++)

                    @endfor
                ];
            </script>
            
            <script src="{{ Vite::asset('resources/js/home/eletricityUsage.js') }}"></script>
        </div>

        <div class="d-flex row-cols-4 gap-4">
            <div class="card flex-fill">
                <div class="card-body">
                
                </div>
            </div>
        </div>
    </div>
@endsection
