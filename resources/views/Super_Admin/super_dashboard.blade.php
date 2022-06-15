<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Super Admin
        </h2>

    </x-slot>


    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}" class="dropdown-item"
           onclick="event.preventDefault();
                    this.closest('form').submit();">
            <i class="fas fa-sign-out mr-3"></i>
            Log out
        </a>
    </form>
    <div class="dropdown-divider"></div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created At</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

