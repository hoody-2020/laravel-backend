{{-- Ce fichier contient les champs communs aux formulaires de création et d'édition --}}
@csrf {{-- Protection CSRF incluse ici pour create.blade.php --}}

{{-- Champ Catégorie --}}
<div class="mb-3">
    <label for="categorie" class="form-label">Catégorie : *</label>
    <input type="text" id="categorie" name="categorie" class="form-control @error('categorie') is-invalid @enderror" value="{{ old('categorie', $evenement->categorie ?? '') }}" required>
    @error('categorie')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Champ Titre --}}
<div class="mb-3">
    <label for="titre" class="form-label">Titre de l'événement : *</label>
    <input type="text" id="titre" name="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre', $evenement->titre ?? '') }}" required>
    @error('titre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Champ Club Organisateur --}}
<div class="mb-3">
    <label for="club_organisateur" class="form-label">Club organisateur : *</label>
    <input type="text" id="club_organisateur" name="club_organisateur" class="form-control @error('club_organisateur') is-invalid @enderror" value="{{ old('club_organisateur', $evenement->club_organisateur ?? '') }}" required>
    @error('club_organisateur')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Champ Date et Heure --}}
@php
    // Logique pour pré-remplir datetime-local (soit old value, soit $evenement->date_heure formatée)
    $dateValue = old('date_heure');
    if (!$dateValue && isset($evenement) && $evenement->date_heure instanceof \Carbon\Carbon) {
        $dateValue = $evenement->date_heure->format('Y-m-d\TH:i');
    } elseif (!$dateValue && isset($evenement) && $evenement->date_heure) {
         // Fallback si ce n'est pas un objet Carbon (moins probable avec les casts)
        try { $dateValue = \Carbon\Carbon::parse($evenement->date_heure)->format('Y-m-d\TH:i'); } catch (\Exception $e) { $dateValue = ''; }
    }
@endphp
<div class="mb-3">
    <label for="date_heure" class="form-label">Date et Heure : *</label>
    <input type="datetime-local" id="date_heure" name="date_heure" class="form-control @error('date_heure') is-invalid @enderror" value="{{ $dateValue }}" required>
    @error('date_heure')
       <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Champ Type --}}
<div class="mb-3">
    <label for="type" class="form-label">Type : *</label>
    <select id="type" name="type" class="form-control @error('type') is-invalid @enderror" required>
        <option value="">-- Sélectionnez le type --</option>
        <option value="présentiel" {{ old('type', $evenement->type ?? '') == 'présentiel' ? 'selected' : '' }}>Présentiel</option>
        <option value="en ligne" {{ old('type', $evenement->type ?? '') == 'en ligne' ? 'selected' : '' }}>En ligne</option>
    </select>
    @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Champ Lieu (Optionnel) --}}
<div class="mb-3">
    <label for="lieu" class="form-label">Lieu (optionnel) :</label>
    <input type="text" id="lieu" name="lieu" class="form-control @error('lieu') is-invalid @enderror" value="{{ old('lieu', $evenement->lieu ?? '') }}">
    @error('lieu')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Champ Description --}}
<div class="mb-3">
    <label for="description" class="form-label">Description : *</label>
    <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $evenement->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Champ Programme --}}
<div class="mb-3">
    <label for="programme" class="form-label">Programme détaillé : *</label>
    <textarea id="programme" name="programme" rows="6" class="form-control @error('programme') is-invalid @enderror" required>{{ old('programme', $evenement->programme ?? '') }}</textarea>
    @error('programme')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Champ Lien Inscription (Optionnel) --}}
<div class="mb-3">
    <label for="lien_inscription" class="form-label">Lien d'inscription (optionnel) :</label>
    {{-- Utilisation de type="url" pour validation navigateur basique --}}
    <input type="url" id="lien_inscription" name="lien_inscription" class="form-control @error('lien_inscription') is-invalid @enderror" value="{{ old('lien_inscription', $evenement->lien_inscription ?? '') }}" placeholder="https://...">
    @error('lien_inscription')
       <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div> 

{{-- Champ Image --}}
<div class="mb-4">
    <label for="image" class="form-label">Nouvelle image (optionnel) :</label>
    <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    
    @if(isset($evenement) && $evenement->image_path)
        <div class="mt-3 p-3 border rounded bg-light">
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-image me-2 text-primary"></i>
                <strong>Image actuellement enregistrée :</strong>
            </div>
            
            <div class="d-flex">
                <img src="{{ asset('storage/'.$evenement->image_path) }}" 
                     alt="Image actuelle" 
                     class="img-thumbnail me-3" 
                     style="max-height: 150px;">
                     
                <div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" 
                               id="keep_image" name="image_action" 
                               value="keep" checked>
                        <label class="form-check-label" for="keep_image">
                            Conserver cette image
                        </label>
                    </div>
                    
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" 
                               id="remove_image" name="image_action" 
                               value="remove">
                        <label class="form-check-label text-danger" for="remove_image">
                            Supprimer définitivement cette image
                        </label>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" 
                               id="replace_image" name="image_action" 
                               value="replace">
                        <label class="form-check-label text-primary" for="replace_image">
                            Remplacer par une nouvelle image (ci-dessus)
                        </label>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
