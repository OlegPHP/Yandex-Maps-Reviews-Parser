<?php

namespace App\Services\Yandex;

use App\Exceptions\YandexDataException;
use App\Exceptions\YandexHttpException;
use Exception;
use Illuminate\Support\Facades\Http;
use DiDom\Document;
use DiDom\Query;


class YandexMapsParser
{
    private const MAX_REVIEW_PAGES = 12;
    public function parse($id)
    {
        $data = $this->getPageData( $id, 1);

            if (!isset($data['stack'][0]['results']['items'][0]['reviewResults'])) {
                throw new YandexDataException('Не удалось получить данные отзывов организации');
            }


        if (!isset($data['stack'][0]['results']['items'][0]['reviewResults']['params']['totalPages'],
            $data['stack'][0]['meta']['breadcrumbs'][3]['name'],
            $data['stack'][0]['meta']['breadcrumbs'][2]['name'],
            $data['stack'][0]['results']['items'][0]['ratingData'],
            $data['stack'][0]['results']['items'][0]['fullAddress'],
        )) {
            throw new YandexDataException("Ошибка структуры данных на странице");
        }


        $countPage = $data['stack'][0]['results']['items'][0]['reviewResults']['params']['totalPages'];
        $name = $data['stack'][0]['meta']['breadcrumbs'][3]['name'];
        $category = $data['stack'][0]['meta']['breadcrumbs'][2]['name'];
        $ratingData = $data['stack'][0]['results']['items'][0]['ratingData'];
        $address = $data['stack'][0]['results']['items'][0]['fullAddress'];
        $reviews = $data['stack'][0]['results']['items'][0]['reviewResults']['reviews'];



        $reviewsClear = [];
        foreach ($reviews as $review) {
            $reviewsClear[] = $this->normalizeReview($review);
        }

        for($i = 2; $i <= $countPage && $i <= self::MAX_REVIEW_PAGES; $i++){
            $currentPage = $this->getPageData( $id, $i);
            if(!isset($currentPage['stack'][0]['results']['items'][0]['reviewResults']['reviews'])){
                throw new YandexDataException("Не удалось найти отзывы на странице $i");
            }
            $reviews = $currentPage['stack'][0]['results']['items'][0]['reviewResults']['reviews'];
            foreach ($reviews as $review) {
                $reviewsClear[] = $this->normalizeReview($review);
            }
        }

        return [
            'name' => $name,
            'category' => $category,
            'ratingData' => $ratingData,
            'address' => $address,
            'reviews' => $reviewsClear,
            ];

    }

    private function getPageData($id, $page){
        $url = "https://yandex.ru/maps/org/$id/reviews/";
        try{
        $response = Http::get($url . '?page=' . $page);
        $response->throw();
        } catch (Exception $e) {
            throw new YandexHttpException(
                'Ошибка при получении страницы Яндекс Карт - ' . $e->getMessage(),
                0,
                $e
            );
        }
        $html = $response->body();
        $document = new Document($html);

            $json = $document->first('script.state-view::text()');
            if (!$json) {
                throw new YandexDataException('Элемент script.state-view не обнаружен на странице');
            }

        $clear = html_entity_decode($json, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        try{
            $data = json_decode(
            $clear,
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        return $data;
     } catch (Exception $e) {
        throw new YandexDataException(
        'Ошибка при получении данных со страницы организации - ' . $e->getMessage(),
        0,
        $e);
}
    }

    private function normalizeReview($review){
        return ['yandex_review_id' => $review['reviewId'],
            'name' => $review['author']['name'] ?? '',
            'text' => $review['text'],
            'rating' => $review['rating'],
            'date' => date('Y-m-d H:i:s', strtotime($review['updatedTime'])),];
    }


}
