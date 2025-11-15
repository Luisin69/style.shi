<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\View;

class CarritoController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el carrito guardado en sesión
        $carrito = session()->get('carrito', []);

        // Calcular el total
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        return view('carrito', compact('carrito', 'total'));
    }

    public function agregar($id)
    {
        $producto = Product::findOrFail($id);
        $carrito = session()->get('carrito', []);

        // Si el producto ya está en el carrito, aumentar cantidad
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                "nombre" => $producto->name,
                "precio" => $producto->price,
                "imagen" => $producto->image, // asegúrate de tener este campo en tu base de datos
                "cantidad" => 1
            ];
        }

        session()->put('carrito', $carrito);
        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->route('carrito.index')->with('success', 'Carrito vaciado.');
    }

    public function comprar(Request $request)
    {
            $request->validate([
        'full-name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'zip' => 'required|string|max:10',
        'country' => 'required|string|max:100',
        'payment_method' => 'required|string',

        // NO guardar datos reales de tarjeta – pero sí validarlos para practicar
        'card-name' => 'required|string|max:255',
        'card-number' => 'required|string|max:20',
        'exp-date' => 'required|string|max:5',
        'cvv' => 'required|string|max:4',
    ]);

    // Obtener carrito
    $carrito = session()->get('carrito', []);
    $total = 0;

    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    // GUARDAR la orden en BD
    $ordenId = \DB::table('ordenes')->insertGetId([
        'nombre' => $request->input('full-name'),
        'direccion' => $request->input('address'),
        'ciudad' => $request->input('city'),
        'zip' => $request->input('zip'),
        'pais' => $request->input('country'),
        'metodo_pago' => $request->input('payment_method'),
        'total' => $total,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Guardar los productos de la orden en otra tabla
    foreach ($carrito as $id => $item) {
        \DB::table('orden_items')->insert([
            'orden_id' => $ordenId,
            'producto_id' => $id,
            'cantidad' => $item['cantidad'],
            'precio' => $item['precio'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    
        session()->forget('carrito');

        return view('confirmacion', [
            'mensaje' => '¡Gracias por tu compra! Tu pedido ha sido procesado correctamente.'
        ]);
    }

    public function boot()
    {
        View::composer('*', function ($view) {
            $carrito = session()->get('carrito', []);
            $totalItems = array_sum(array_column($carrito, 'cantidad'));
            $view->with('cartCount', $totalItems);
        });
    }
}
