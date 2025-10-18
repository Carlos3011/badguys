<?php

namespace App\Models;

use Vanilo\Product\Models\Product as BaseProduct;
use Vanilo\Properties\Traits\HasPropertyValues;
use Vanilo\Support\Traits\HasImagesFromMediaLibrary;
use Vanilo\Category\Traits\HasTaxons;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Vanilo\Category\Models\TaxonProxy;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends BaseProduct implements HasMedia
{
    use HasPropertyValues;           // Para propiedades
    use HasImagesFromMediaLibrary;   // Manejo de imágenes
    use InteractsWithMedia;          // Trait de Spatie
    use HasTaxons;                   // Relación con taxons

    // Opcional: si quieres valores por defecto
    protected $attributes = [
        'stock' => 0,
        'state' => 'draft',
    ];

    public function taxons(): MorphToMany
    {
        return $this->morphToMany(
            TaxonProxy::modelClass(),
            'model',
            'model_taxons',
            'model_id',
            'taxon_id'
        );
    }
     public function getImageUrl($media = null)
    {
        if (!$media) {
            $media = $this->getFirstMedia('default');
        }
        
        return $media ? '/storage/' . $media->id . '/' . $media->file_name : null;
    }

    /**
     * Obtener todas las URLs de imágenes del producto
     */
    public function getImageUrls()
    {
        return $this->getMedia('default')->map(function($media) {
            return [
                'id' => $media->id,
                'url' => '/storage/' . $media->id . '/' . $media->file_name,
                'name' => $media->file_name,
                'size' => $media->size,
            ];
        });
    }

    /**
     * Obtener la URL de la primera imagen
     */
    public function getFirstImageUrlAttribute()
    {
        return $this->getImageUrl();
    }

    /**
     * Verificar si el producto tiene imágenes
     */
    public function hasImages()
    {
        return $this->getMedia('default')->count() > 0;
    }
}
