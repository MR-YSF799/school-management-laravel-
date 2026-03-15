{{-- Étendre le layout principal de l'application --}}
@extends('layouts.app')

{{-- Début de la section contenu --}}
@section('content')

{{-- Conteneur avec une grille de 12 colonnes --}}
<div class="row">
    {{-- Colonne de 6 unités (moitié de la largeur) --}}
    <div class="col-md-6">
        {{-- Titre principal de la page --}}
        <h4 class="fw-bold mb-4">Add New Student</h4>
        
        {{-- Carte contenant le formulaire --}}
        <div class="card shadow-sm p-4">
            {{-- Formulaire pour ajouter un nouvel étudiant --}}
            <form action="{{ route('students.store') }}" method="POST">
                {{-- Protection CSRF obligatoire --}}
                @csrf

                {{-- Groupe de formulaire pour le nom complet --}}
                <div class="mb-3">
                    {{-- Label du champ nom --}}
                    <label class="form-label fw-semibold">Full Name *</label>
                    {{-- Champ d'entrée texte avec validation d'erreur --}}
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" placeholder="e.g. Amina Moussaoui">
                    {{-- Message d'erreur si le nom est invalide --}}
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Groupe de formulaire pour l'email --}}
                <div class="mb-3">
                    {{-- Label du champ email --}}
                    <label class="form-label fw-semibold">Email *</label>
                    {{-- Champ d'entrée email avec validation --}}
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="e.g. amina@example.com">
                    {{-- Message d'erreur si l'email est invalide --}}
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Groupe de formulaire pour le téléphone (optionnel) --}}
                <div class="mb-4">
                    {{-- Label du champ téléphone --}}
                    <label class="form-label fw-semibold">Phone</label>
                    {{-- Champ d'entrée téléphone sans validation obligatoire --}}
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone') }}" placeholder="Optional">
                </div>

                {{-- Groupe de boutons d'action --}}
                <div class="d-flex gap-2">
                    {{-- Bouton pour soumettre et enregistrer l'étudiant --}}
                    <button type="submit" class="btn btn-primary">Save Student</button>
                    {{-- Lien pour annuler et retourner à la liste --}}
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Fin de la section contenu --}}
@endsection