@extends('layouts/connexion')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
            <img style="width:100px;height:100px;" src="{{ asset('assets/images/logoENI.png') }}">
            <br>
            <h2 class="heading-section">Bon naviguation !</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="login-wrap p-0">

                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <p style="font-size:20px">Temps de connexion restant : </p>
                    </div>
                    <div class="form-group col-md-6">
                        <p style="font-size:20px"> <span id="heure">{{ $heure }}</span> h <span
                                id="min">{{ $min - 1 }}</span> min <span id="sec">59</span> sec</p>
                    </div>
                </div>
                <div class="form-group" style="text-align:center">
                </div>
                <div class="form-group" style="text-align:center">
                    <button type="submit" class="form-control btn btn-primary submit col-lg-6">Déconnecter</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function attente() {
            
            var termine = false
            var heure = document.getElementById("heure").innerHTML;
            var min = document.getElementById("min").innerHTML;
            var sec = document.getElementById("sec").innerHTML;

            if (sec > 0) {
                document.getElementById("sec").innerHTML -= 1;
            } else if (sec < 1 && (heure > 0 || min > 0)) {
                document.getElementById("sec").innerHTML = 59;
                if (min > 0) {
                    document.getElementById("min").innerHTML -= 1
                } else if (min < 1 && heure > 0) {
                    document.getElementById("min").innerHTML = 59
                    document.getElementById("heure").innerHTML -= 59
                }
            } else {
                termine = true;
            }


            var time = setTimeout(function() {
                attente();
            }, 1000);

            if (termine) {
                clearTimeout(time);
            }

        }

        function update() {
            

            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const url = "{{ route('updteTime') }}";
            console.log("let's go");
            fetch(url, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                method: 'post',
                
            }).then(response => {
                
            }).catch(error => {
                console.log(error)
            });

             var time = setTimeout(function() {
                update();
            }, 60000);
           


        }
        attente();update();
    </script>

@endsection
