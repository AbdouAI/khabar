<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'first_name'=>'required|max:255|min:2',
            'last_name'=>'required|max:255|min:2',
            'experience'=>'required|max:255|min:10',
        ]);

        $user = User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        Submission::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'experience'=>$request->experience,
            'user_id'=>$user->id,
        ]);


        event(new Registered($user));

        Auth::login($user);
        return redirect(route('dashboard', absolute: false));
    }

    public function index()
    {
        $users=User::paginate(10);
        return view('admin.pannel',["users"=>$users,'submissions'=>null,'search'=>false,"categories"=>null]);
    }

    public function revokeWriter($id)
    {
        $user=User::find($id);
        $user->update(['is_writer'=>0]);
        return back()->with('success','L\'utilisateur n\'est plus ecrivain');
    }

    public function grantWriter($id)
    {
        $user=User::find($id);
        $user->update(['is_writer'=>1]);
        return back()->with('success','L\'utilisateur est devenu ecrivain');
    }
}
