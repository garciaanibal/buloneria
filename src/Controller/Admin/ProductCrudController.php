<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
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
            // Fila superior con dos columnas
            FormField::addRow(),
            
            // Columna izquierda (Información básica)
            FormField::addColumn('col-md-6')
                ->addPanel('Información básica', 'fa fa-info-circle'),
                
            TextField::new('name', 'Nombre del producto')
                ->setColumns('col-12'),
            TextEditorField::new('description', 'Descripción')
                ->setColumns('col-12')
                ->setNumOfRows(5),
            
            // Columna derecha (Datos económicos)
            FormField::addColumn('col-md-6')
                ->addPanel('Datos económicos', 'fa fa-euro-sign'),
                
            MoneyField::new('purchase_price', 'Precio de venta')
                ->setColumns('col-4')
                ->setCurrency('ARS')  
                ->setNumDecimals(2)
                ->setStoredAsCents(false),  // Si guardas el valor entero (100 = $1.00)
              
            MoneyField::new('sale_price', 'Precio de venta')
                ->setColumns('col-4')
                ->setCurrency('ARS') 
                ->setNumDecimals(2)
                ->setStoredAsCents(false),  // Si guardas el valor entero (100 = $1.00)
                
            IntegerField::new('sku', 'Cantidad en stock')
                ->setColumns('col-4'),
                
            
            // Fila inferior (Categorías - ancho completo)
            FormField::addRow(),
            FormField::addColumn('col-12')
                ->addPanel('Categorización', 'fa fa-tags'),
                
            AssociationField::new('category', 'Categoría')
                ->setColumns('col-md-6')
                ->setRequired(true)
                ->autocomplete()
                ->setCustomOption('autocomplete_entity_label', 'name')
                ->formatValue(function ($value, $entity) {
                    return $entity->getCategory()?->getName();
                }),
        ];
    }
    
}
