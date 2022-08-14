<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\sendConfirmationEmail;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use Illuminate\Http\JsonResponse;

use App\Models\User;
use App\Models\Confirmation;
use App\Models\Connexion;
use App\Models\Configuration;

class UserController extends Controller
{
    public function creat(Request $request){
        $this->validate($request, [
            'name' => 'required|min:1',
            'email' => 'required|min:1|email',
            'password' => 'required|min:4',
            'classe' => 'required',
            'matricule' => 'required',
            'tel' => 'required|min:10'
        ]);

        if($request->input("password") == $request->input("confirm")){

            if(!User::first()){
                $isadmin = true;
            }else{
                $isadmin = false;
            }

            User::create([
                'name' => $request->input("name"),
                'email' => $request->input("email"),
                'password' => Hash::make($request->input("password")),
                'classe' => $request->input("classe"),
                'matricule' => $request->input("matricule"),
                'tel'=> $request->input("tel"),
                'first_name' => $request->input("first_name"),
                "isadmin" => $isadmin
            ]);
            
            return redirect(route('index'))->with("notif" , "Compte créer avec succès");
        }
        else{
            return back()->with("error" , "Le deux mots de passe doit être identique"); 
        }
    }


    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|min:1|email',
            'password' => 'required|min:4',
        ]);
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials, false)) {
            try {
                $user = User::where("email", $request->input("email"))->first();

                
                
                
                if( !Confirmation::where("id_user", $user->id)->first()){
                    $code = $this->creatRandomPassword();

                    $request->session()->regenerate();
                
                    Confirmation::create([
                        "id_user" => $user->id,
                        'code' => $code, 
                        
                    ]);

                    $this->sendEmail($user, $code);

                    //$this->sendMessage($user->tel, "Bonjour votre code de confirmation est '".$code."'");
                    return redirect(route('confirmation'));
                }
                else{
                    return redirect(route("confirmation"))->with("notif" , "Cette utilisateur a déjà réçu un code de confirmation");
                }
                
            } catch (Exception $e) {
            }
            
        }
        return back()->with("error", "Email/Mots de passe incorrecte !");
        
    }


    public function logout(Request $request){
        User::findOrFail(Auth()->user()->id)->update(['remember_token' => Null]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session_destroy();
        return redirect(route('index'));
    }

    public function confirmCode(Request $request){
        $this->validate($request, [
            'code' => 'required|min:5|max:7',
        ]);

        $confirm = Confirmation::where("id_user", auth()->user()->id)->get();

        foreach($confirm as $code){
            if($code->code == $request->input("code")){
                if(auth()->user()->isadmin){
                    $connexion = Connexion::whereDay("created_at", now()->day)->get();
        
                        if(!$connexion->where("id_user", auth()->user()->id)->first()){
                            
                            Connexion::create([
                                "id_user" => auth()->user()->id,
                                "temps" => 30000,
                            ]);
                        }
                    
                    $_SESSION["user"] = auth()->user();
                    return redirect(route("dashboard"));
                }
                $_SESSION["user"] = auth()->user();
                return redirect(route("user.index"));
            }
        }
        
        return back()->with("error", "Code incorrecte !");
    }

    public function userIndex(){
        $connexion = Connexion::whereDay("created_at", now()->day)->get();
        
        foreach($connexion as $con){
            if($con->id_user == auth()->user()->id && $con->temps > 0){
                $heure = (int) ($con->temps / 3600);
                $min = (($con->temps / 3600) - $heure) * 60;

                return view("page/user", compact(["heure" , "min"]));
            }
            else if($con->id_user == auth()->user()->id && $con->temps < 1){

                return redirect(route("index"))->with("error", "vous avez consommez la totalité de votre temps de connexion");
            }
        }
        $con = Configuration::first();

        if($con){
            $temps = $con->temps;
        }else{
            $temps = 3600;
        }

        Connexion::create([
            "id_user" => auth()->user()->id,
            "temps" => $temps,
        ]);

        $heure = (int) ($temps / 3600);
        $min = (($temps / 3600) - $heure) * 60;

        return view("page/user", compact(["heure" , "min"]));    
        
    }

    protected function creatRandomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 7; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $pass = implode("", $pass);

        return $pass;
    }

    protected function sendMessage($number , $message){
        $account_sid = "AC7174213572dc903668bcfa4869519b54";
        $auth_token = "ad5eb0a560b8e6f4dc0b534f7f2684ba";
        $twilio_number = "+13852090873";

        $client = new Client($account_sid, $auth_token);
        
        try{
            $client->messages->create($number, [
                "from" => $twilio_number,
                "body" => $message
            ]);
        } catch (RestException $e) {
            var_dump("non envoyer");
        }
        
    }

    protected function sendEmail($user, $code){
        $details = [    
            "nom" => $user->name,
            "prenom" => $user->first_name,
            "code" => $code
        ];

        try{
            Mail::to($user->email)->send(new sendConfirmationEmail($details));
        }catch(Exception $e){

        }
    }

    public function updteTime() :  JsonResponse {
        $connexion = Connexion::whereDay("created_at", now()->day)->get();
        
        foreach($connexion as $con){
            if($con->id_user == auth()->user()->id && $con->temps > 0){
                $con->update([
                    "temps" => $con->temps - 60
                ]);

                return response()->json([]);
            }
        }

        return redirect(route("index"))->with("error", "Vous temps de connexion est écouler !");
    }
    
}
