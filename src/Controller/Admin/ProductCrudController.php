<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle('index', 'Listado de productos')
        ->setPageTitle('edit', 'Editar producto')
        ->setPageTitle('new', 'Crear producto')
        ->setPaginatorPageSize(10); 
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
         
            TextField::new('name','Nombre del producto'),
            TextEditorField::new('description','Descripción'),     
            NumberField::new('purchase_price','Precio de compra'),
            NumberField::new('sale_price','Precio de venta'),
            IntegerField::new('sku','cantidad'),
            AssociationField::new('category', 'Categoría')
            ->setRequired(true)
            ->autocomplete()
            ->setCustomOption('autocomplete_entity_label', 'name')
            ->formatValue(function ($value, $entity) {
                return $entity->getCategory()?->getName();
            }),

        ];
            
    }
    
}
