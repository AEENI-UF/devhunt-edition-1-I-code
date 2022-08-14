@extends('layouts/connexion')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
            <img style="width:100px;height:100px;" src="{{ asset('assets/images/logoENI.png') }}">
            <br>
            <h2 class="heading-section">Vous devez d'abord vous connectez !</h2>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="login-wrap p-0">
                <form action="{{ route('login') }}" id="formLogin" class="signin-form" method="POST">
                    @include('layouts/notification')
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" id="email" placeholder="example@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <input id="password-field" type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btnLogin" class="form-control btn btn-primary submit px-3">Connexion</button>
                    </div>
                    <div class="form-group d-md-flex">
                        <div class="w-50">
                            <a href="{{ route('creation-compte') }}" style="color: #fff">Créer un compte ?
                            </a>
                        </div>
                        <div class="w-50 text-md-right">
                            <a href="#" style="color: #fff">Mots de passe oublié</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById("formLogin").addEventListener("submit", function(e) {
            /*e.preventDefault();
            
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const url = "{{ route('login') }}";

            var email = document.getElementById("email").value;
            var password = document.getElementById("password");
            console.log(password);

            let btnAnimate = new Bouton("btnLogin");
            btnAnimate.attenteBtn();
            
            fetch(url, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                method: 'post',
                body: JSON.stringify({
                    email: email,
                    password:password.value
                })
            }).then(response => {
                response.json().then(data => {
                    console.log(data);
                    btnAnimate.arreter();
                })
            }).catch(error => {
                console.log(error)
                btnAnimate.arreter();
            });*/
        });
    </script>

@endsection
