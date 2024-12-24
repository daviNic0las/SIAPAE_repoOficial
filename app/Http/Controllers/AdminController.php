<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request): View
    {
        $search = request('search');
        
        if ($search) {
            $users = User::where([
                ['name', 'like', '%' . $search . '%']
            ])->where('state_user', 'alive')
            ->where('position', '!=', '---')
            ->orderBy('access_level', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(15);
        } else {
            $users = User::where('state_user', 'alive')
            ->where('position', '!=', '---')
            ->orderBy('access_level', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(15);
        }

        return view('admin.index', compact('users', 'search'));
    }

    /**
     * Display the registration view.
     */
    public function create()
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'position' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string','max:255']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // return redirect(route('admin.index', absolute: false));
        if ($user) {
            session()->flash('success', 'Usuário adicionado com sucesso!');
            return redirect()->route('admin.index');
        } else {
            session()->flash('error', 'Falha na edição do Usuário');
            return redirect()->route('admin.edit');
        }
    }
    public function show($id) 
    {
        $user = User::find($id);

        $isArchived = null;
        if($user['state_user'] == 'archived') {
            $isArchived = true; 
        }
    
        return view('admin.show', compact('user', 'isArchived'));
    }
    public function archive($id)
    {
        $user = User::findOrFail($id);

        $user['state_user'] = 'archived';

        $input = $user->save();

        if ($input) {
            session()->flash('success', 'Usuário arquivado com sucesso!');
            return redirect()->route('admin.index');
        } else {
            session()->flash('error', 'Erro na arquivação do Usuário');
            return redirect()->route('admin.index');
        }
    }
    public function deposit()
    {
        $search = request('search');
        
        if ($search) {
            $users = User::where([
                ['name', 'like', '%' . $search . '%']
            ])->where('state_user', 'archived')
            ->orderBy('name', 'asc')
            ->paginate(15);
        } else {
            $users = User::where('state_user', 'archived')
            ->orderBy('name', 'asc')
            ->paginate(15);
        }

        return view('admin.deposit', compact('users', 'search'));
    }
    public function restore($id) 
    {
        $user = User::find($id);

        $user['state_user'] = 'alive';

        $input = $user->save();

        if ($input) {
            session()->flash('success', 'Usuário Restaurado com sucesso!');
            return redirect()->route('admin.deposit');
        } else {
            session()->flash('error', 'Erro na restauração do Usuário');
            return redirect()->route('admin.deposit');
        }
    }
    /**
     * Display the user's profile form in view Admin
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'position' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string','max:255']
        ]);

        $userUpdate = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'password' => Hash::make($request->password),
        ]);

        // return redirect(route('admin.index', absolute: false));
        if ($userUpdate) {
            session()->flash('success', 'Usuário atualizado com sucesso!');
            return redirect()->route('admin.index');
        } else {
            session()->flash('error', 'Falha na atualização do Usuário');
            return redirect()->route('admin.edit');
        }
    }
}
