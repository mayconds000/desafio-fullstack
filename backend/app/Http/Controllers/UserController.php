<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\DeleteRequest;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = new User;
            $user = User::create($this->getUserData($request, $user->getFillable()));

            $address = new Address;
            $address->fill($request->only($address->getFillable()));

            $user->address()->save($address);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            Log::error($e->getMessage());
            
            return response()->json('Não foi possível cadastrar o usuário.', 422);
        }

        return new UserResource($user);
    }

    public function update(UpdateRequest $request, User $user)
    {
        if ( ! $user->id) {
            return response()->json('Usuário não encontrado.', 404);
        }

        try {
            DB::beginTransaction();
            
            $data = $this->getUserData($request, $user->getFillable());
            unset($data['email']);
            $user->update($data);
            
            if ($request->input('address')) {
                $user->address->update($request->only($user->address->getFillable()));
            }

            DB::commit();

            return new UserResource($user);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return response()->json('Não foi possível atualizar os dados do usuário.', 422);
        }
    }

    protected function getUserData($request, array $fillable)
    {
        $data = $request->only($fillable);

        if (isset($data['birth_date'])) {
            $date = \DateTimeImmutable::createFromFormat('d/m/Y', $data['birth_date']);
            $data['birth_date'] = $date->format('Y-m-d');
        }
            
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return $data;
    }

    public function show(User $user)
    {
        if (! $user->id) {
            return response()->json('Usuário não encontrado.', 404);
        }

        return response()->json($user);
    }

    public function index(Request $request)
    {
        $users = User::with(['address'])->orderBy('updated_at', 'desc')->paginate(5);
        return UserResource::collection($users);
        return response()->json($users);
    }

    public function destroy(User $user)
    {
        if ( ! isset($user->id)) {
            return response()->json('Usuário não econtrado.', 404);
        }

        try {
            $user->forceDelete();
            return new UserResource($user);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json('Não foi possível deletar o usuário.', 422);
        }
    }
}
