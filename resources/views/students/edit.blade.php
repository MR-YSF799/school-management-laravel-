{{-- On hérite du layout principal qui contient le <html>, navbar, Bootstrap, etc. --}}
{{-- Sans cette ligne, la page n'aurait ni menu ni style --}}
@extends('layouts.app')

{{-- On ouvre la section "content" --}}
{{-- Blade va injecter tout ce qui suit à l'endroit où @yield('content') se trouve dans le layout --}}
@section('content')

{{-- Bootstrap : une ligne qui divise la page en colonnes --}}
{{-- "row" crée une ligne horizontale dans la grille Bootstrap --}}
<div class="row">

    {{-- "col-md-6" = cette colonne prend 6/12 de la largeur (la moitié de l'écran) --}}
    {{-- Sur mobile, elle prendra automatiquement 100% de la largeur --}}
    <div class="col-md-6">

        {{-- Titre de la page --}}
        {{-- fw-bold = font-weight bold | mb-4 = margin-bottom de 4 unités Bootstrap --}}
        <h4 class="fw-bold mb-4">Edit Student</h4>

        {{-- Carte Bootstrap avec une ombre légère et un padding intérieur de 4 --}}
        <div class="card shadow-sm p-4">

            {{-- Début du formulaire HTML --}}
            {{-- action : où envoyer les données quand on soumet --}}
            {{-- route('students.update', $student) génère l'URL /students/1 (avec l'ID du student) --}}
            {{-- method="POST" : les formulaires HTML ne supportent que GET et POST --}}
            <form action="{{ route('students.update', $student) }}" method="POST">

                {{-- @csrf génère un champ caché avec un token de sécurité --}}
                {{-- Sans lui, Laravel rejette la requête avec une erreur 419 --}}
                {{-- Exemple de ce que ça génère : <input type="hidden" name="_token" value="abc123..."> --}}
                @csrf

                {{-- @method('PUT') dit à Laravel de traiter ce formulaire comme une requête PUT --}}
                {{-- Car HTML ne supporte pas PUT nativement --}}
                {{-- Ça génère : <input type="hidden" name="_method" value="PUT"> --}}
                {{-- Laravel lit ce champ et route vers la méthode update() du controller --}}
                @method('PUT')

                {{-- ============================================================ --}}
                {{-- CHAMP NOM --}}
                {{-- ============================================================ --}}

                {{-- mb-3 = margin-bottom de 3 unités, espace entre les champs --}}
                <div class="mb-3">

                    {{-- Étiquette visible au-dessus du champ --}}
                    {{-- fw-semibold = texte semi-gras --}}
                    <label class="form-label fw-semibold">Full Name *</label>

                    {{-- Champ texte pour le nom --}}
                    {{-- name="name" : le nom que Laravel utilisera pour récupérer la valeur via $request->name --}}

                    {{-- class="form-control" : style Bootstrap pour un champ de formulaire --}}
                    {{-- @error('name') is-invalid @enderror : --}}
                    {{--   si la validation a échoué pour le champ "name", --}}
                    {{--   Bootstrap ajoute la classe "is-invalid" qui met une bordure rouge --}}

                    {{-- value="{{ old('name', $student->name) }}" : --}}
                    {{--   old('name') = remet la valeur tapée par l'utilisateur si la validation a échoué --}}
                    {{--   $student->name = valeur par défaut : le nom actuel de l'étudiant --}}
                    {{--   Logique : si old() existe → l'affiche, sinon → affiche $student->name --}}
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $student->name) }}">

                    {{-- @error('name') : si la validation a échoué pour "name" --}}
                    {{-- $message contient le message d'erreur généré par Laravel --}}
                    {{-- "invalid-feedback" est une classe Bootstrap qui affiche le texte en rouge sous le champ --}}
                    {{-- @enderror : fin du bloc d'erreur --}}
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                {{-- ============================================================ --}}
                {{-- CHAMP EMAIL --}}
                {{-- ============================================================ --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">Email *</label>

                    {{-- type="email" : le navigateur valide le format email côté client --}}
                    {{-- name="email" : Laravel récupère la valeur via $request->email --}}
                    {{-- Même logique que le champ name pour @error et old() --}}
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $student->email) }}">

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                {{-- ============================================================ --}}
                {{-- CHAMP TÉLÉPHONE --}}
                {{-- ============================================================ --}}

                {{-- mb-4 = plus grand espace en bas pour séparer des boutons --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">Phone</label>

                    {{-- Pas de @error ici car "phone" est nullable dans la validation --}}
                    {{-- Pas d'étoile * dans le label car ce champ est optionnel --}}
                    {{-- old('phone', $student->phone) : même logique, valeur actuelle par défaut --}}
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone', $student->phone) }}">

                </div>

                {{-- ============================================================ --}}
                {{-- BOUTONS D'ACTION --}}
                {{-- ============================================================ --}}

                {{-- d-flex = display flex (aligne les boutons côte à côte) --}}
                {{-- gap-2 = espace de 2 unités entre les boutons --}}
                <div class="d-flex gap-2">

                    {{-- Bouton de soumission du formulaire --}}
                    {{-- type="submit" déclenche l'envoi du formulaire vers l'action définie plus haut --}}
                    {{-- btn btn-primary = bouton Bootstrap bleu --}}
                    <button type="submit" class="btn btn-primary">Update Student</button>

                    {{-- Lien de retour à la liste, pas un bouton submit --}}
                    {{-- route('students.index') génère l'URL /students --}}
                    {{-- btn-outline-secondary = bouton Bootstrap avec bordure grise --}}
                    {{-- Si l'utilisateur clique Cancel, aucune donnée n'est envoyée --}}
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Cancel</a>

                </div>

            </form>
            {{-- Fin du formulaire --}}

        </div>
        {{-- Fin de la carte --}}

    </div>
    {{-- Fin de la colonne --}}

</div>
{{-- Fin de la ligne Bootstrap --}}

{{-- Fermeture de la section content --}}
{{-- Blade sait que tout ce qui était entre @section et @endsection --}}
{{-- doit être injecté dans le @yield('content') du layout --}}
@endsection