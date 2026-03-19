<?php
// Déclaration de l'espace de noms pour organiser le code
namespace App\Models;

// Import de la classe Model de Laravel pour hériter ses fonctionnalités
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Student
 * 
 * Représente un étudiant dans le système de gestion des étudiants.
 * Un étudiant peut s'inscrire à plusieurs cours.
 */
class Student extends Model
{
    /**
     * Les attributs qui peuvent être assignés en masse (mass assignment).
     * Cela définit les colonnes de la table que l'on peut remplir directement :
     * - name : Le nom de l'étudiant
     * - email : L'adresse email de l'étudiant
     * - phone : Le numéro de téléphone de l'étudiant
     */
    protected $fillable = ['name', 'email', 'phone'];

    /**
     * Relation plusieurs-à-plusieurs : Un étudiant peut s'inscrire à plusieurs cours.
     * 
     * Cette relation utilise la table pivot 'enrollments' qui contient les inscriptions.
     * - withPivot('grade', 'id') : Inclut les colonnes 'grade' et 'id' de la table pivot
     * - withTimestamps() : Inclut les champs created_at et updated_at de la table pivot
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withPivot('grade', 'id')
                    ->withTimestamps();
    }
}
