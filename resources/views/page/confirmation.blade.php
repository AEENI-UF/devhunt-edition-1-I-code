@extends('layouts/connexion')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
            <img style="width:100px;height:100px;" src="{{ asset('assets/images/logoENI.png') }}">
            <br>
            <h2 class="heading-section">Veuillez saisir le code de confirmation. <a href="#" id="btnRenvoye"> Renvoyer le
                    code ? </a></h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="login-wrap p-0">
                <form action="{{ route('confirm') }}" id="formConfirm" class="signin-form" method="POST">
                    @csrf
                    @include('layouts/notification')



                    <div class="form-group">
                        <input name="code" type="text" id="confirm" placeholder="5 F R 8 D 6" class="form-control" name="confirm"
                            id="confirm" min="6" max="6" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="btnSubmit"
                            class="form-control btn btn-primary submit px-3">Envoyer</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
       
        document.getElementById("formConfirm").addEventListener("submit", function(e) {
           /* e.preventDefault();

            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const url = "{{}}";

            var codeCofirm = document.getElementById("confirm").value;

            document.getElementById("alert").innerHTML = "";

            let btnAnimate = new Bouton("btnSubmit");
            btnAnimate.attenteBtn();

            fetch(url, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                method: 'post',
                body: JSON.stringify({
                    code: codeCofirm,
                })
            }).then(response => {
                response.json().then(data => {
                    document.getElementById("alert").innerHTML =
                        "<div class='alert alert-danger' role='alert'>Code incorect</div>";
                    btnAnimate.arreter();
                })
            }).catch(error => {
                console.log(error)
                btnAnimate.arreter();
            });*/
        });
    </script>

@endsection
