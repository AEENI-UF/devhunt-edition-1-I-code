<?php

namespace App\Http\Middleware;


use App\Models\Connexion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;


use Closure;
use Log;

class LogRequest{
    public function handle($request, Closure $next, $guard = null){
        session_start();
        $url = "http://".$_SERVER["SERVER_NAME"]."/devhunt-edition-1-I-code/public/";

        $urlServeurTo = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]."/";
        $routeIndex = "http://".$_SERVER["SERVER_NAME"]."/devhunt-edition-1-I-code/public/";
        $routeCreation = "http://".$_SERVER["SERVER_NAME"]."/devhunt-edition-1-I-code/public/creation-compte/";
        $routeSignIn = "http://".$_SERVER["SERVER_NAME"]."/devhunt-edition-1-I-code/public/sign-in/";
        $routeLogin = "http://".$_SERVER["SERVER_NAME"]."/devhunt-edition-1-I-code/public/login/";
        $routeConfirm = "http://".$_SERVER["SERVER_NAME"]."/devhunt-edition-1-I-code/public/confirmation/";
        $confirm = "http://".$_SERVER["SERVER_NAME"]."/devhunt-edition-1-I-code/public/confirm/";

        $condition = $confirm != $urlServeurTo && $routeIndex != $urlServeurTo && $routeCreation != $urlServeurTo && $routeSignIn != $urlServeurTo && $routeLogin != $urlServeurTo && $routeConfirm != $urlServeurTo;
        //return var_dump(auth());
        
        if(!isset($_SESSION["user"]) && $condition){
            if("http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] != $url){
                
                echo "<script>document.location.replace('".$url."');</script>";
                //echo "<script>console.log('".$_SERVER["REQUEST_URI"]." = ".$routeLogin."');</script>";
            }
        }
        if(isset($_SESSION["user"])){
            $connexion = Connexion::whereDay("created_at", now()->day)->get();
            //return var_dump(auth());
            foreach($connexion as $con){
                if($con->id_user == $_SESSION["user"]->id && $con->temps < 1){
                    User::findOrFail($_SESSION["user"]->id)->update(['remember_token' => Null]);
                    Auth::logout();
                    session_destroy();
                    echo "<script>document.location.replace('".$url."');</script>";
                    
                    
                }
            }
        }
       // if("http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] == $url){return $next($request);}

       return $next($request);        
    }
}