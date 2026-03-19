<?php
// Déclaration de l'espace de noms pour organiser le code
namespace App\Models;

// Import de la classe Model de Laravel pour hériter ses fonctionnalités
use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Enrollment
 * 
 * Représente l'inscription d'un étudiant à un cours.
 * Cette classe gère la relation entre les étudiants et les cours.
 */
class Enrollment extends Model
{
    /**
     * Les attributs qui peuvent être assignés en masse (mass assignment).
     * Cela définit les colonnes de la table que l'on peut remplir directement.
     */
    protected $fillable = ['student_id', 'course_id', 'grade'];

    /**
     * Relation : Un enrollment appartient à un étudiant.
     * 
     * Cette relation inverse (belongsTo) établit le lien avec le modèle Student.
     * Un enrollment ne peut avoir qu'un seul étudiant.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Relation : Un enrollment appartient à un cours.
     * 
     * Cette relation inverse (belongsTo) établit le lien avec le modèle Course.
     * Un enrollment ne peut avoir qu'un seul cours.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}