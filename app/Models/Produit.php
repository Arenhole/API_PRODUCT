<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Produit"),
 * @OA\Property(property="id", type="integer", readOnly="false", example="1"),
 * @OA\Property(property="title", type="string", readOnly="false", description="Title of the product"),
 * @OA\Property(property="stock", type="integer", readOnly="false", description="Stock of the product", example="15"),
 * )
 *
 * Class Produit
 *
 * @package App\Models
 */
class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['title','stock'];
}
