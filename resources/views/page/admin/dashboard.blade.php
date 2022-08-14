@extends('layouts/admin_layout')

@section('content')



    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
        <a id="btnLimitation" href="#" data-toggle="modal" data-target="#limitationModal"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>
            Modifier les limitation</a>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Télécharger la liste des Etudiant</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        @include('layouts/notification')


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Nombre de connecté Aujourd'hui</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Nombre de connecté Ce mois-ci</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                En Ligne</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Evolution par jours</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>

                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Evolution par mois</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>

                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade" id="limitationModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="limitationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="limitationModalLabel">Limitation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="limitationForm" method="POST" action="{{ route('saveLimitation') }}">
                   
                    <div class="modal-body">
                        @csrf
                        <div class="row form-group">
                            <label class="col-lg-3 col-md-3" for="exampleInputPassword1">Débit</label>
                            <input type="number" id="debitInput" class="col-lg-3 col-md-3 form-control" id="exampleInputPassword1">
                            <div class="col-lg-3 col-md-3">ko/s</div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Temps</label>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <input value="00" type="number" id="heureInput" class="form-control" id="exampleInputPassword1">
                                    heure
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <input value="00" type="number" id="minInput" class="form-control" id="exampleInputPassword1">
                                    min
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <input value="00" type="number" id="secInput" class="form-control" id="exampleInputPassword1">
                                    sec
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnModifierLimitation" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        document.getElementById("btnLimitation").addEventListener("click", function() {
            
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const url = "{{ route('getLimitation') }}";

            fetch(url, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                method: 'post',
                
            }).then(response => {
                response.json().then(data => {
                    document.getElementById('debitInput').value = data.debit;
                    document.getElementById('heureInput').value = data.heure;
                    document.getElementById('minInput').value = data.min;
                    document.getElementById('secInput').value = data.sec;
                    
                })
            }).catch(error => {
                console.log(error)
            });

        });

        document.getElementById("limitationForm").addEventListener("submit", function(e) {
            e.preventDefault();
            
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const url = "{{ route('saveLimitation') }}";

            let btnAnimate = new Bouton("btnModifierLimitation");
            btnAnimate.attenteBtn();

            fetch(url, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                method: 'post',
                body: JSON.stringify({
                    debit: document.getElementById('debitInput').value,
                    heure: document.getElementById('heureInput').value,
                    min: document.getElementById('minInput').value,
                    sec: document.getElementById('secInput').value,
                })
                
            }).then(response => {
                response.json().then(data => {
                    
                    $("#limitationModal").modal("hide");
                    btnAnimate.arreter();
                })
            }).catch(error => {
                console.log(error)
                btnAnimate.arreter();
            });

        });
    </script>
@endsection
