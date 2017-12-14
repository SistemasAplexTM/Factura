<?php

namespace App\Http\Controllers;
use Mail;
use App\Mail\Prueba;
use App\Events\ChangeEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getAll(){
        $data = DB::table('cambio_precio AS a')
        ->join('setup AS b', 'a.bodega_id', '=', 'b.id')
        ->join('producto AS c', 'a.producto_id', '=', 'c.id')
        ->join('usuario AS d', 'a.usuario_id', '=', 'd.id')
        ->select(
            'a.id',
            'a.estado',
            'b.razon_social AS tienda',
            'c.codigo',
            'c.descripcion',
            'c.precio_venta',
            'd.nombre',
            'a.precio_cambio AS precio_sugerido',
            'b.color',
            'c.id AS product_id'
        )
        ->where([
            ['a.deleted_at', '=', NULL],
            ['a.estado', '=', 0],
        ])
        ->get();
        return $data;
    }

    public function changeState(Request $request){
        DB::table('cambio_precio')
            ->where('id', $request->id)
            ->update(['estado' => 1]);
        event(new ChangeEvent('denegada'));
    }

    public function updatePrice(Request $request){
        $iva = DB::table('producto AS a')
        ->join('iva AS b', 'a.iva_id', '=', 'b.id')
        ->select('b.valor')
        ->where([
            ['a.id', '=', $request->product_id],
            // ['a.deleted_at', '=', 'NULL'],
            // ['b.deleted_at', '=', 'NULL'],
        ])
        ->get();
        $iva_bd = ($iva[0]->valor / 100) + 1;

        $precio_iva = $request->price_new / $iva_bd;
        $precio_final = round($precio_iva, 0, PHP_ROUND_HALF_UP);
        DB::table('cambio_precio')
            ->where('id', $request->id)
            ->update(['estado' => 1]);
        DB::table('producto')
            ->where('id', $request->product_id)
            ->update(['precio_venta' => $precio_final ]);
        event(new ChangeEvent('aceptada'));
    }

    public function undoDenied(Request $request){
        DB::table('cambio_precio')
            ->where('id', $request->id)
            ->update(['estado' => 1]);
        DB::table('producto')
            ->where('id', $request->product_id)
            ->update(['precio_venta' => $request->price_new]);
        event(new ChangeEvent('aceptada'));
    }

    public function undoAccepted(Request $request){
        DB::table('cambio_precio')
            ->where('id', $request->id)
            ->update(['estado' => 0]);
        event(new ChangeEvent('aceptada'));
    }

    public function new(){
        Mail::to('duvierm24@gmail.com')->send(new Prueba());
        event(new ChangeEvent('nueva'));   
    }
}