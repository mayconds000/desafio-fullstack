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
        $this->middleware('auth:api')->except(['register']);
    }

    public function register(StoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = new User;
            $user = User::create($this->getUserData($request, $user->getFillable()));

            $address = new Address;
            $address->fill($this->getAddressData($request, $address->getFillable()));

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
            
            $user->update($this->getUserData($request, $user->getFillable()));
            
            if ($request->input('address')) {
                $data = $this->getAddressData($request, $user->address()->getFillable());
                $user->address->update($data);
            }

            DB::commit();

            return response()->json($user);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return response()->json('Não foi possível atualizar os dados do usuário.', 422);
        }
    }

    protected function getUserData($request, array $fillable)
    {
        $data = $request->only($fillable);
            
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return $data;
    }

    protected function getAddressData($request, array $fillable)
    {
        $data = $request->only('address');
        return collect($data['address'])->only($fillable)->toArray();
    }

    public function show(User $user)
    {
        if ( ! $user->id) {
            return response()->json('Usuário não encontrado.', 404);
        }

        return response()->json($user);
    }

    public function index(Request $request)
    {
        $users = User::orderBy('updated_at', 'desc')->get();
        return response()->json($users);
    }

    public function destroy(DeleteRequest $request, User $user) 
    {
        try {
            $user->forceDelete();
            return response()->json('Usuário deletado com sucesso.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json('Não foi possível deletar o usuário.', 422);
        }
    }
}
