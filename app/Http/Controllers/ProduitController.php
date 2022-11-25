<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

/**
 * @OA\Info(title="API Produit", version="0.1")
 */
class ProduitController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/produit",
     *      operationId="getAllProduits",
     *      tags={"ApiProduit"},

     *      summary="Get List Of Produits",
     *      description="Returns all produits.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function index()
    {
        $data = Produit::all();

        return response()->json($data);
    }

    public function indexView()
    {
        $data = Produit::all();

        return View::make('produit.index')
            ->with('produits', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('produit.create');
    }

    /**
     * @OA\Post(
     *      path="/api/produit",
     *      operationId="createProduit",
     *      tags={"ApiProduit"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass produit parameters",
     *    @OA\JsonContent(
     *       required={"title","stock"},
     *       @OA\Property(property="title", type="string", example="Tomate"),
     *       @OA\Property(property="stock", type="integer", example="15"),
     *    ),
     * ),
     *
     *      summary="Create Produit",
     *      description="create a produit.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'stock' => 'required|integer'
        ]);

        $data = Produit::create($request->all());

        return response()->json([
            'message' => 'Data Successfully Stored!',
            'data' => $data
        ]);
    }

    public function storeView(Request $request)
    {
        $rules = array(
            'title' => 'required|string',
            'stock' => 'required|integer'
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('view/produit/create')
                ->withErrors($validator);
        } else {
            // store
            $produit = new Produit;
            $produit->title = $request->get('title');
            $produit->stock = $request->get('stock');
            $produit->save();

            // redirect
            Session::flash('message', 'Produit créé');
            return Redirect::to('view/produit');
        }
    }

    /**
     * @OA\Get(
     *      path="/api/produit/{id}",
     *      operationId="getProduit",
     *      tags={"ApiProduit"},
     *@OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *
     *      summary="Get Produit",
     *      description="get a produit.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function show(Request $request, $id)
    {
        $data = Produit::where('id' , '=' , $request->id)->first();
        return response()->json([
            'message' => 'Fetching Data!',
            'data' => $data
        ]);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function showView(int $id)
    {
        $produit = Produit::find($id);

        return View::make('produit.show')
            ->with('produit', $produit);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produit = Produit::find($id);

        return View::make('produit.edit')
            ->with('produit', $produit);
    }

    /**
     * @OA\Put(
     *      path="/api/produit/{id}",
     *      operationId="updateProduit",
     *      tags={"ApiProduit"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          description="le produit a modifier avec son id",
     *          required=true,
     *          @OA\Property(property="produit", type="object", ref="#/components/schemas/Produit"),
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="stock",
     *                     type="integer"
     *                 ),
     *                 example={"title": "Tomate", "stock": 15}
     *             )
     *          )
     *      ),
     *
     *      summary="modifier un Produit",
     *      description="modifier un produit.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'nullable',
            'stock' => 'nullable'
        ]);

        $produit = Produit::find($id);
        $produit->title = $request->get('title');
        $produit->stock = $request->get('stock');
        $produit->save();

        return response()->json([	
            'message' => 'Great success! Task updated',
        ]);
    }

    public function updateView(Request $request, int $id)
    {
        $rules = array(
            'title'       => 'required',
            'stock' => 'required|integer'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('view/produit/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            $produit = Produit::find($id);
            $produit->title = $request->get('title');
            $produit->stock = $request->get('stock');
            $produit->save();

            // redirect
            Session::flash('message', 'Produit modifié');
            return Redirect::to('view/produit');
        }
    }

     /**
     * @OA\Delete(
     *      path="/api/produit/{id}",
     *      operationId="deleteProduit",
     *      tags={"ApiProduit"},
     *@OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *
     *      summary="Delete Produit",
     *      description="delete a produit.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */
    public function destroy(int $id)
    {
        $produit = Produit::find($id);
        $produit->delete();
        return response()->json([
            'message' => 'Data Successfully deleted!'
        ]);
    }

    public function destroyView($id)
    {
        $produit = Produit::find($id);
        $produit->delete();

        // redirect
        Session::flash('message', 'Produit supprimé');
        return Redirect::to('view/produit');
    }
}
