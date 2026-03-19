<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // Définit les colonnes de la table course qui peuvent être remplies directement
    // title : le nom du cours, description : son contenu, credits : ses crédits
    protected $fillable = ['title', 'description', 'credits'];

    // Cette fonction établit la relation entre un cours et ses étudiants inscrits
    // Elle permet d'accéder à tous les étudiants qui suivent ce cours
    // La table enrollments est la table pivot qui contient les inscriptions
    // withPivot inclut la note de l'étudiant et son ID d'inscription
    // withTimestamps inclut les dates de création et modification de l'inscription
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments')
                    ->withPivot('grade', 'id')
                    ->withTimestamps();
    }
}
