<?php

namespace App\Http\Middleware;

use App\Models\{Address, Category, Product};
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => auth()->check() ? auth()->user() : null,

                // get the first address of the user i.e. first() even if there are multiple addresses
                'address' => auth()->check() ? Address::where('user_id', auth()->user()->id)->first() : null,

                // check authenticated user
                'userAuth' => auth()->check(),
            ],


            // fetch all categories and products
            'categories' => Category::all(),
            'random_products' => Product::inRandomOrder()->limit(8)->get(),

            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
