<?php

namespace App\Controller\Admin;

use App\Entity\Encounter;
use App\Enum\RoleEnum;
use App\Enum\StatusTypeEnum;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

class EncounterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Encounter::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield AssociationField::new('matches');
        yield ChoiceField::new('status')
            ->setFormType(EnumType::class)
            ->setFormTypeOption('class', StatusTypeEnum::class);

    }

}
