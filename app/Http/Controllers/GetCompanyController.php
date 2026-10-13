<?php

namespace App\Http\Controllers;

use App\Exceptions\YandexDataException;
use App\Exceptions\YandexHttpException;
use App\Models\Category;
use App\Models\Organisation;
use App\Models\Review;
use App\Services\OrganisationDataSaver;
use Illuminate\Http\Request;
use App\Services\Yandex\YandexMapsParser;
use Illuminate\Support\Facades\Log;

class GetCompanyController extends Controller
{
    public function getId(Request $request){
        try{
        $url = $request->input('url');
        $path = parse_url($url);
        if((!$path || !isset($path['path']))){
            throw new YandexDataException('Некорректная ссылка');
        }

        if(!preg_match('#/([0-9]+)/?#', $path['path'], $res)){
            throw new YandexDataException('Не удалось получить ID организации из ссылки');
        }
            $id = $res[1];
            $parser = new YandexMapsParser();
            $data = $parser->parse($id);

            $dataSaver = new OrganisationDataSaver();
            $dataSaver->saveData($data, $id);

            return redirect()->route('company.show', ['id' => $id]);
            } catch (YandexHttpException $e) {
            Log::channel('yandex')->error('Ошибка при получении данных Яндекс Карт', [
                'id' => $id,
                'exception' => $e,
            ]);
            return response()->view('errors.yandex', [
                'title' => 'Не удалось получить данные',
                'message' => 'Яндекс Карты временно недоступны или не отвечают. Попробуйте позже.',
            ], 502);;
        } catch (YandexDataException $e) {
            Log::channel('yandex')->error('Ошибка при обработке данных Яндекс Карт', [
                'id' => $id ?? null,
                'exception' => $e,
            ]);
            return response()->view('errors.yandex', [
                'title' => 'Не удалось обработать данные',
                'message' => 'Не удалось получить необходимые данные организации. Попробуйте позже.',
            ], 422);
        }

    }

    public function showHtml($id){

            $currentData = Organisation::where('yandex_id', $id)->with('category')->firstOrFail();
            $reviews = $currentData->reviews()->simplePaginate(50) ->withQueryString();

           return view('company.show', ['data' => $currentData, 'reviews' => $reviews]);
            }


}
