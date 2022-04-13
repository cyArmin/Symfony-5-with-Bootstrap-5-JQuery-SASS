<?php

namespace App\Controller\Admin;

use App\Entity\Vocabulary;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VocabularyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vocabulary::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
