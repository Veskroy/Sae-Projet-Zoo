<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield IdField::new('id', 'ID')->hideOnForm(),
            yield TextField::new('firstname','Firstname'),
            yield TextField::new('lastname','Lastname'),
            yield TextField::new('email','Email'),
            yield TextField::new('phone', 'Phone'),
            yield TextField::new('pc', 'Postal Code'),
            yield TextField::new('city', 'City'),
            yield TextField::new('address', 'Address'),
            yield ArrayField::new('roles', 'Role(s)')
        ];
    }

}
