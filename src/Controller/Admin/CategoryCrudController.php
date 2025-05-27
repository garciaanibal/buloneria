<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle('index', 'Listado de categorias')
        ->setPageTitle('edit', 'Editar categoria')
        ->setPageTitle('new', 'Crear categoria')
        ->setPaginatorPageSize(10); 
    }
    
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Category) return;

        parent::persistEntity($entityManager, $entityInstance);

        // Flash message
        $this->addFlash('success', '¡Categoria agregado con éxito!');
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        parent::updateEntity($entityManager, $entityInstance);
        $this->addFlash('info', 'Categoria actualizada correctamente.');
    }
   
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Agregar Catgoria');
            });
            // ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
            //     return $action->setLabel('Editar');
            // })
            // ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
            //     return $action->setLabel('Eliminar');
            // });
    }
   
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('name','Nombre de la categoria'),
            // TextEditorField::new('description'),
        ];
    }
    
}
