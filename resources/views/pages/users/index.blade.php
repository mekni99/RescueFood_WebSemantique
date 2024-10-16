@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Users Management'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Success message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Users</h6>
                        <!-- Button to trigger add modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            Add user
                        </button>
                    </div>

    <!-- Modal pour ajouter un nouvel utilisateur -->
   
                    <!-- Modal pour ajouter un nouvel utilisateur -->
                    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addUserModalLabel">Ajouter un Nouveau Utilisateur</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('users.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Nom d'Utilisateur</label>
                                            <input type="text" class="form-control" id="username" name="username" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Rôle</label>
                                            <select class="form-select" id="role" name="role" required>
                                                <option value="admin">Admin</option>
                                                <option value="association">Association</option>
                                                <option value="restaurant">Restaurant</option>
                                                <!-- Ajoutez d'autres rôles si nécessaire -->
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Mot de passe</label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Liste des utilisateurs -->
                    <div class="card">
                        <div class="card-header">Liste des Utilisateurs</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom d'Utilisateur</th>
                                        <th>Email</th>
                                        <th>Rôle</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <!-- Détails de l'utilisateur -->
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $user->id }}">
                                                <i class="fas fa-info-circle"></i>
                                            </button>

                                            <!-- Modal pour les détails -->
                                            <div class="modal fade" id="detailsModal{{ $user->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $user->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Détails de l'Utilisateur</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Nom d'Utilisateur: </strong>{{ $user->username }}</p>
                                                            <p><strong>Email: </strong>{{ $user->email }}</p>
                                                            <p><strong>Rôle: </strong>{{ $user->role }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Édition de l'utilisateur -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Modal pour édition -->
                                            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Éditer l'Utilisateur</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="username" class="form-label">Nom d'Utilisateur</label>
                                                                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="role" class="form-label">Rôle</label>
                                                                    <select class="form-select" id="role" name="role">
                                                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                        <option value="association" {{ $user->role == 'association' ? 'selected' : '' }}>Association</option>
                                                                        <option value="restaurant" {{ $user->role == 'restaurant' ? 'selected' : '' }}>Restaurant</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="password" class="form-label">Nouveau Mot de passe (laisser vide pour ne pas changer)</label>
                                                                    <input type="password" class="form-control" id="password" name="password">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Suppression d'utilisateur -->
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
