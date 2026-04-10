@extends('layouts.admin')

@section('title', 'Users Management')

@section('style')
<style>
    .admin-card {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    }

    .role-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .role-admin {
        background: #ffe8cc;
        color: #d9480f;
    }

    .role-user {
        background: #d4edda;
        color: #155724;
    }

    .table thead {
        background: #f8f9fa;
    }
</style>
@endsection

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Users Management</h3>
        <span class="text-muted">Total Users: {{ $users->count() }}</span>
    </div>

    <div class="admin-card p-4">

        <table class="table align-middle table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th width="150"></th>
                </tr>
            </thead>
            <tbody>

                @forelse($users as $user)
                <tr>
                    <td>#{{ $user->id }}</td>

                    <td>
                        <div class="fw-semibold">{{ $user->name }}</div>
                    </td>

                    <td class="text-muted">
                        {{ $user->email }}
                    </td>

                    <td>
                        <span class="role-badge {{ $user->role === 'admin' ? 'role-admin' : 'role-user' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    <td>
                        {{ $user->created_at->format('M d, Y') }}
                    </td>

                    <td class="text-end">

                       

                        @if($user->role !== 'admin')
                        <form action="{{ route('admin.users.delete', $user->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger rounded-pill">
                                Delete
                            </button>
                        </form>
                        @endif

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        No users found.
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>

</div>

@endsection