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
                    <td class="px-4 py-3">
                        {{ $user->isAdmin() ? 'Administrateur' : 'Éditeur' }}
                        @if ($user->must_change_password)
                            <span class="admin-status admin-status-warning ml-2" title="Le mot de passe provisoire n’a pas encore été remplacé">Mot de passe provisoire</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="admin-row-actions">
                            <x-admin.edit-link :href="route('admin.users.edit', $user)" />
                            @if ($user->id !== auth()->id())
                                <x-admin.delete-button :action="route('admin.users.destroy', $user)" message="Supprimer le compte de {{ $user->name }} ?" />
                            @endif
                        </div>
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
