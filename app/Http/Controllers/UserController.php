<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\GetAllUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index(GetAllUserRequest $request)
    {
        $data = $request->validated();

        $users = User::query()
            ->when(isset($data['q']), function ($query) use ($data) {
                $term = '%' . $data['q'] . '%';
                $query->where(function ($q) use ($term) {
                    $q->where('first_name',   'like', $term)
                      ->orWhere('last_name',    'like', $term)
                      ->orWhere('username',     'like', $term)
                      ->orWhere('email',        'like', $term)
                      ->orWhere('phone_number', 'like', $term)
                      ->orWhere('country',      'like', $term)
                      ->orWhere('city',         'like', $term);
                });
            })
            ->orderBy($data['order_by'] ?? 'created_at', $data['order_direction'] ?? 'asc')
            ->paginate(
                perPage: $data['per_page'] ?? 15,
                page:    $data['page']     ?? null,
            );

        $model = [
            'status'  => 200,
            'message' => count($users) > 0 ? 'Registros encontrados.' : 'Nenhum registro encontrado.',
            'data'    => $users,
        ];

        return response()->json($model);
    }
}
