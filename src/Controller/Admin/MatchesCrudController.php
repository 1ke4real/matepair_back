<?php

namespace App\Controller\Admin;

use App\Entity\Matches;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MatchesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Matches::class;
    }


    public function configureFields(string $pageName): iterable
    {
       yield IdField::new('id')->hideOnForm();
       yield AssociationField::new('first_user');
       yield AssociationField::new('second_user');
       yield TextField::new('status');
    }

}
