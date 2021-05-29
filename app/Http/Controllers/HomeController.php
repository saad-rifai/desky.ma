<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Branding;
use App\DemandeEtude;
use App\ConsultationController;
use App\DemandeCardauoto;
use App\Contact;
use App\DevelopmentInformatique;
use App\emarketing;
use App\CreationSocite;
use Illuminate\Support\Facades\Cookie;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->status == "1"){
            $c_branding = Branding::count();
            $c_etude = DemandeEtude::count();
            $c_consultation = ConsultationController::count();
            $c_card = DemandeCardauoto::count();
            $c_development = DevelopmentInformatique::count();
            $c_emarketing = emarketing::count();
            $c_creationsocite = CreationSocite::count();
            $contacts = Contact::take(6)->get();
            return view('dash/index', ['c_branding' => $c_branding, 'c_etude' => $c_etude, 'c_consultation' => $c_consultation, 'c_card' => $c_card, 'contacts' => $contacts, 'c_development' => $c_development, 'c_emarketing' => $c_emarketing, 'c_creationsocite' => $c_creationsocite]);
    
        }else{
            if(Cookie::get('ref_alg')){
                $ref = Cookie::get('ref_alg');
                return redirect()->intended($ref);

            }else{
                return redirect()->intended('/?ref=false');

            }
        }
           }
}