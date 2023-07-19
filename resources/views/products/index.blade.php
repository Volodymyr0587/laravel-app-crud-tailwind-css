<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
    <title>Products</title>
</head>
<body>
    @if (session()->has('create-product'))
        <div class="text-green-600 py-2 px-4 text-lg"
        x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show">
            <p>{{ session('create-product') }}</p>
        </div>
    @endif
    @if (session()->has('update-product'))
        <div class="text-indigo-600 py-2 px-4 text-lg"
        x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show">
            <p>{{ session('update-product') }}</p>
        </div>
    @endif
    @if (session()->has('delete-product'))
        <div class="text-rose-600 py-2 px-4 text-lg"
        x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show">
            <p>{{ session('delete-product') }}</p>
        </div>
    @endif

    <div class="flex flex-col justify-center items-center">
        <h1 class="py-8 text-4xl">Products</h1>
    </div>

    <div class="mb-8 ml-8 flex-1">
        <a href="{{ route('product.create') }}" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Product</a>

        <a href="{{ route('dashboard') }}" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Dashboard</a>

    </div>



<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Product Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Quantiy
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Edit Product
                </th>
                <th scope="col" class="px-6 py-3">
                    Delete Product
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $product->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $product->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->qty }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->price }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->description }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('product.edit', ['product' => $product]) }}" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>
                    </td>
                    <td class="px-6 py-4">
                        <form method="POST" action="/product/{{ $product->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
