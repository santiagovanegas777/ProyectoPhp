<?php
namespace App\Manager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class CharacterManager
{
    public function uploadImage(UploadedFile $file, $targetDir)
    {
        $newFilename = uniqid().'.'.$file->guessExtension();
        $file->move($targetDir, $newFilename);

        return '/images/'.$newFilename;
    }
}