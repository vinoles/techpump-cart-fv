<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\ProcessOrderRequest;
use App\Mail\SendPasswordToUser;
use App\Models\User;
use Core\Cart\Infrastructure\Repositories\Cart as CartRepository;
use Core\Order\Application\UseCases\CreateOrder;
use Core\Order\Infrastructure\Repositories\Order as OrderRepository;
use Faker\Generator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ProcessOrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ProcessOrderRequest $request)
    {
        $attributes = $request->validated();

        $user = $request->user() ?? $this->getUser($attributes['email']);

        if ($user === null) {
            $user = $this->createUser($request);
        }

        $attributes = array_merge($attributes, ['user_id' => $user->id]);

        $createOrder = new CreateOrder(
            new OrderRepository(),
            new CartRepository()
        );

        $createOrder->execute($attributes);

        return response()->json(['message' => $this->getMessage()]);
    }

    /**
     * Get message for response
     *
     * @return string
     */
    protected function getMessage(): string
    {
        if (Auth::check()) {
            return 'Payment made successfully';
        }

        return 'Payment made successfully, enter our platform to manage your purchases';
    }

    /**
     * Search user by email
     *
     * @return \App\Models\User|null
     */
    protected function getUser(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * Create new user
     *
     * @return @return \App\Models\User
     */
    protected function createUser(Request $request): User
    {
        $password = resolve(Generator::class)->bothify('?#?#?#?#');

        $user = User::firstOrCreate([
            'email' => $request->input('email'),
            'name' => $request->input('first_name'),
            'password' => Hash::make($password),
        ]);

        Mail::to($user->email)
            ->send(new SendPasswordToUser(
                $user,
                $password
            ));

        return $user;
    }
}
