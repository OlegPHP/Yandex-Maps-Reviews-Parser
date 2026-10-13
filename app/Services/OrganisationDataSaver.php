<?php

namespace App\Services;




use App\Models\Category;
use App\Models\Organisation;
use App\Models\Review;
use Illuminate\Support\Facades\Log;

class OrganisationDataSaver
{
public function saveData($data, $id): void
{
    $category = Category::firstOrCreate([
        'name' => $data['category'],
    ]);

    $organisation = Organisation::updateOrCreate(
        [
            'yandex_id' => $id,
        ],
        ['name' => $data['name'],
            'category_id' => $category->id,
            'address' => $data['address'],
            'rating_value' => $data['ratingData']['ratingValue'],
            'rating_count' => $data['ratingData']['ratingCount'],
            'review_count' => $data['ratingData']['reviewCount'],
        ]);


    foreach ($data['reviews'] as &$review) {
        $review['organisation_id'] = $organisation->id;
        $review['created_at'] = now();
        $review['updated_at'] = now();
    }
    unset($review);

    Review::upsert(
        $data['reviews'],
        ['yandex_review_id'],
        ['name', 'text', 'rating', 'date', 'organisation_id','updated_at']
    );

    Log::channel('yandex')->info(
        "Данные организации {$organisation->name} получены.",
        ['date' => now()->toDateTimeString()]
    );
}



}
