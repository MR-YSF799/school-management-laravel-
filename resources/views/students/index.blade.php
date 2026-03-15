{{-- Étendre le layout principal de l'application --}}
@extends('layouts.app')

{{-- Début de la section contenu --}}
@section('content')

{{-- En-tête avec titre et bouton d'ajout d'étudiant --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">All Students</h4> {{-- Titre principales --}}
    {{-- Lien pour créer un nouvel étudiant --}}
    <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">+ Add Student</a>
</div>

{{-- Carte contenant le tableau des étudiants --}}
<div class="card shadow-sm">
    {{-- Tableau pour afficher la liste des étudiants --}}
    <table class="table table-hover align-middle mb-0">
        {{-- En-tête du tableau avec colonnes --}}
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        {{-- Corps du tableau avec les données des étudiants --}}
        <tbody>
            {{-- Boucle sur tous les étudiants disponibles --}}
            @forelse($students as $student)
            <tr>
                {{-- Afficher l'ID de l'étudiant --}}
                <td>{{ $student->id }}</td>
                {{-- Afficher le nom de l'étudiant en gras --}}
                <td class="fw-semibold">{{ $student->name }}</td>
                {{-- Afficher l'email de l'étudiant --}}
                <td>{{ $student->email }}</td>
                {{-- Afficher le numéro de téléphone ou un tiret s'il est vide --}}
                <td>{{ $student->phone ?? '—' }}</td>
                {{-- Boutons d'action (Voir, Modifier, Supprimer) --}}
                <td class="d-flex gap-2">
                    {{-- Lien pour voir les détails de l'étudiant --}}
                    <a href="{{ route('students.show', $student) }}"
                       class="btn btn-sm btn-outline-secondary">View</a>
                    {{-- Lien pour éditer l'étudiant --}}
                    <a href="{{ route('students.edit', $student) }}"
                       class="btn btn-sm btn-outline-primary">Edit</a>
                    {{-- Formulaire pour supprimer l'étudiant avec confirmation --}}
                    <form action="{{ route('students.destroy', $student) }}" method="POST"
                          onsubmit="return confirm('Delete this student?')">
                        {{-- Protection CSRF et méthode DELETE --}}
                        @csrf @method('DELETE')
                        {{-- Bouton de suppression --}}
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            {{-- Message quand aucun étudiant n'existe --}}
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">No students yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination des résultats --}}
<div class="mt-3">{{ $students->links() }}</div>

{{-- Fin de la section contenu --}}
@endsection