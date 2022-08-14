@extends('layouts/connexion')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
            <img style="width:100px;height:100px;" src="{{ asset('assets/images/logoENI.png') }}">
            <br>
            <h2 class="heading-section">Veuillez vous inscrire !</h2>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-8">
            <div class="login-wrap p-0">
                <form action="{{ route('sign-in')}}" method="POST" class="signin-form">
                    @csrf
                    @include('layouts/notification')
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text"  class="form-control" placeholder="Nom *" name="name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Prénom " name="first_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Classe * : example L3 IG"  name="classe" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" placeholder="Numéro Matricule" name="matricule" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text"  inputmode="tel" class="form-control" placeholder="Numero téléphone" name="tel" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control" inputmode="email" placeholder="Email *" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="password" class="form-control" placeholder="Mots de passe" name="password" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="password" class="form-control" placeholder="Confirmation du Mot de passe"
                                name="confirm" required>

                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary submit px-3">S'inscrire</button>
                    </div>
                    <div style="text-align:center">
                        <a href="{{ route('index')}}"  class=" submit px-3" style="color:#fff">J'ai déjà un compte</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
