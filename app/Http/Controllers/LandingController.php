<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Promotion;
use App\Models\Order;
use App\Models\Address;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LandingController extends Controller
{
    public function index()
    {
        $rawItems = MenuItem::where('is_available', true)->orderBy('name')->get();
        $categoryOrder = [
            'Hamburguesas' => 1,
            'Burgers'      => 1,
            'Salchipapas'  => 2,
            'Papas'        => 3,
            'Perros'       => 4,
            'Hot Dogs'     => 4,
            'Picadas'      => 5,
            'Bebidas'      => 8,
            'Añadidos'     => 9,
            'Adicionales'  => 9,
            'Extras'       => 9
        ];
        $menuItems = $rawItems->groupBy('category')->sortBy(function($items, $category) use ($categoryOrder) {
            return $categoryOrder[$category] ?? 50;
        });

        $promotions = Promotion::active()->get();

        $myOrders = [];
        $addresses = [];
        $deliveryFee = Setting::where('key', 'delivery_fee')->value('value') ?? 0;

        if (Auth::check()) {
            $myOrders = Order::where('user_id', Auth::id())
                ->with('items.menuItem')
                ->latest()
                ->take(3)
                ->get();

            $userAddresses = Auth::user()->addresses ?? [];
            if (is_array($userAddresses) && empty($userAddresses)) {
                $addresses = Address::where('user_id', Auth::id())->get();
            } elseif (method_exists(Auth::user(), 'addresses')) {
                $addresses = Auth::user()->addresses;
            } else {
                $addresses = Address::where('user_id', Auth::id())->get();
            }
        }

        return view('welcome', compact('menuItems', 'promotions', 'myOrders', 'addresses', 'deliveryFee'));
    }

    public function showPromotion(Promotion $promotion)
    {
        abort_if(!$promotion->is_active, 404);

        $rawItems = MenuItem::where('is_available', true)->orderBy('name')->get();
        $categoryOrder = [
            'Hamburguesas' => 1,
            'Burgers'      => 1,
            'Salchipapas'  => 2,
            'Papas'        => 3,
            'Perros'       => 4,
            'Hot Dogs'     => 4,
            'Picadas'      => 5,
            'Bebidas'      => 8,
            'Añadidos'     => 9,
            'Adicionales'  => 9,
            'Extras'       => 9
        ];
        $menuItems = $rawItems->groupBy('category')->sortBy(function($items, $category) use ($categoryOrder) {
            return $categoryOrder[$category] ?? 50;
        });

        $otherPromos = Promotion::active()
            ->where('id', '!=', $promotion->id)
            ->take(3)->get();

        return view('promotions.show', compact('promotion', 'menuItems', 'otherPromos'));
    }

    public function trackView($id)
    {
        $item = MenuItem::find($id);
        if ($item) {
            $item->increment('views_count');
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function preVerify(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes ingresar un correo electrónico válido.',
            'email.unique' => 'Este correo ya está registrado. Intenta iniciar sesión.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        session([
            'otp_code' => $code,
            'register_data' => $request->only('name', 'email', 'password')
        ]);

        // Enviar el correo con diseño
        Mail::send('emails.verify-code', ['code' => $code, 'name' => $request->name], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Tu Código de Verificación - Mr. Sabor Burgers 🍔');
        });

        return back()->with('show_otp_step', true);
    }

    public function confirmRegister(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        if ($request->code !== session('otp_code')) {
            return back()->with('show_otp_step', true)->withErrors(['otp' => 'El código es incorrecto. Intenta de nuevo.']);
        }

        $data = session('register_data');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => now(), // ¡Verificado al instante!
        ]);

        session()->forget(['otp_code', 'register_data']);

        Auth::login($user);

        return redirect('/')->with('success', '¡Cuenta creada y verificada con éxito! 🔥');
    }
}

