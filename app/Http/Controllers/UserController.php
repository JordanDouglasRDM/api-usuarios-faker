<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\GetAllUserRequest;
use App\Models\User;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{

    public function index(GetAllUserRequest $request)
    {
        try {
            $data = $request->validated();

            if (isset($data['sleep'])) {
                $sleep = (int)$data['sleep'] / 1000;
                sleep($sleep);
            }

            if (isset($data['simulate_throw']) && $data['simulate_throw']) {
                throw new HttpClientException('Erro interno do servidor. Tente novamente mais tarde.');
            }

            $cacheKey = 'users_list_' . md5(json_encode($request->query()));

            $model = Cache::remember($cacheKey, now()->addDays(2), function () use ($data) {
                $users = User::query()
                    ->when(isset($data['q']), function ($query) use ($data) {
                        $term = '%' . $data['q'] . '%';
                        $query->where(function ($q) use ($term) {
                            $q->where('first_name', 'like', $term)
                                ->orWhere('last_name', 'like', $term)
                                ->orWhere('username', 'like', $term)
                                ->orWhere('email', 'like', $term)
                                ->orWhere('phone_number', 'like', $term)
                                ->orWhere('country', 'like', $term)
                                ->orWhere('city', 'like', $term);
                        });
                    })
                    ->orderBy($data['order_by'] ?? 'id', $data['order_direction'] ?? 'asc')
                    ->paginate(
                        perPage: $data['per_page'] ?? 15,
                        page: $data['page'] ?? null,
                    );

                return [
                    'status'  => 200,
                    'message' => $users->count() > 0 ? 'Registros encontrados.' : 'Nenhum registro encontrado.',
                    'data'    => $users,
                ];
            });

            return response()->json($model);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
