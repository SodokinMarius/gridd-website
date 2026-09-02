@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-stone-600">{{ $users->total() }} utilisateur(s)</p>
    <a href="{{ route('admin.users.create') }}" class="btn-primary !py-2 !px-4 text-sm">+ Nouvel utilisateur</a>
</div>

<div class="bg-white border border-stone-200 rounded-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-left text-stone-600">
            <tr>
                <th class="px-4 py-3">Nom</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Rôle</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($users as $user)
                <tr>
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3">{{ $user->isAdmin() ? 'Administrateur' : 'Éditeur' }}</td>
                    <td class="px-4 py-3 text-right space-x-3">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-primary-600 hover:underline">Modifier</a>
                        @if ($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                @csrf @method('DELETE')
                                <button class="text-clay-500 hover:underline">Supprimer</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-6 text-center text-stone-500">Aucun utilisateur.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $users->links() }}</div>

@endsection
