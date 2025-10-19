<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filtro por búsqueda
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filtro por estado
        if ($request->filled('status')) {
            $status = $request->get('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Filtro por verificación de email
        if ($request->filled('verified')) {
            $verified = $request->get('verified');
            if ($verified === 'verified') {
                $query->whereNotNull('email_verified_at');
            } elseif ($verified === 'unverified') {
                $query->whereNull('email_verified_at');
            }
        }

        $customers = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.customers.index', compact('customers'));
    }

  

    /**
     * Activate a customer.
     */
    public function activate(User $customer)
    {
        $customer->activate();

        return redirect()->back()
            ->with('success', 'Cliente activado exitosamente.');
    }

    /**
     * Deactivate a customer.
     */
    public function deactivate(User $customer)
    {
        $customer->inactivate();

        return redirect()->back()
            ->with('success', 'Cliente desactivado exitosamente.');
    }

    /**
     * Verify customer email.
     */
    public function verifyEmail(User $customer)
    {
        $customer->update(['email_verified_at' => now()]);

        return redirect()->back()
            ->with('success', 'Email del cliente verificado exitosamente.');
    }

    /**
     * Unverify customer email.
     */
    public function unverifyEmail(User $customer)
    {
        $customer->update(['email_verified_at' => null]);

        return redirect()->back()
            ->with('success', 'Verificación de email del cliente removida.');
    }
}