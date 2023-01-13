<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\LibrosExport;
use Maatwebsite\Excel\Facades\Excel;
/**
 * Class LibroController
 * @package App\Http\Controllers
 */
class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = Libro::where('estado','=',1)->paginate();

        return view('libro.index', compact('libros'))
            ->with('i', (request()->input('page', 1) - 1) * $libros->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $libro = new Libro();
        $categorias = Categoria::where('estado','=',1)->pluck('nombre', 'id');

        return view('libro.create', compact('libro', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Libro::$rules);

        $libro = Libro::create($request->all());

        return redirect()->route('libros')
            ->with('success', 'Libro created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $libro = Libro::find($id);

        return view('libro.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libro = Libro::find($id);
        $categorias = Categoria::select("*")->where('estado', '=', 1)->pluck('nombre', 'id');

        return view('libro.edit', compact('libro', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Libro $libro
     * @return \Illuminate\Http\Response
     */
   // public function update(Request $request, Libro $libro)
    public function update(Request $request, $id)
    {
        request()->validate(Libro::$rules);

        //$libro->update($request->all());
        $categoria = Libro::find($id);
        $categoria->nombre = $request->nombre;
        $categoria->categoria_id = $request->categoria_id;
        $categoria->save();

        return redirect()->route('libros')
            ->with('success', 'Libro updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        //$libro = Libro::find($id)->delete();
        $categoria = Libro::find($id);
        $categoria->estado = 2;
        $categoria->save();
        return redirect()->route('libros')
        ->with('success', 'Libro deleted successfully');
    }
    
    public function pdf()
    {
        $libros = Libro::select('*')->where('estado','=',1)->paginate();
        $pdf = Pdf::loadView('libro.pdf', ['libros'=> $libros]);
        // $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
        //return view('libro.pdf', compact('libros'));
        //return $pdf->download('libro.pdf');

    }
    public function pdflibro($id)
    {
        $libro = Libro::find($id);
        //return $libro;
        $pdf = Pdf::loadView('libro.pdflibro', ['libros'=> $libro]);
        return $pdf->stream();

    }


    
    public function export() 
    {

        // $libros = Libro::all();
        // return Excel::download($libros, 'libros.xlsx');
        return Excel::download(new LibrosExport, 'libros.xlsx');
    }
    
}
