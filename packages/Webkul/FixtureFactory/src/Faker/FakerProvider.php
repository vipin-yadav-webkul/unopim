<?php

namespace Webkul\FixtureFactory\Faker;

use Faker\Provider\Base;

class FakerProvider extends Base
{
    protected static $products = [
        'Chair', 'Table', 'Shirt', 'Shoes', 'Keyboard', 'Laptop', 'Headphones', 'Backpack', 'Sofa', 'Lamp', 
        'Monitor', 'Desk', 'Coffee Maker', 'T-shirt', 'Smartwatch', 'Couch', 'Pillow', 'Blender', 'Microwave', 
        'Camera', 'Fan', 'Refrigerator', 'Air Conditioner', 'Washing Machine', 'Toaster', 'Cutter', 'Mixer'
    ];
    
    protected static $adjectives = [
        'Ergonomic', 'Rustic', 'Intelligent', 'Durable', 'Sleek', 'Luxury', 'Portable', 'Modern', 'Compact', 
        'Elegant', 'Stylish', 'Wireless', 'Adjustable', 'Vintage', 'Customizable', 'Smart', 'Eco-friendly'
    ];

    protected static $materials = [
        'Wooden', 'Plastic', 'Granite', 'Cotton', 'Steel', 'Glass', 'Leather', 'Aluminum', 'Carbon Fiber', 
        'Fabric', 'Marble', 'Bamboo', 'Ceramic', 'Silk', 'Rubber', 'Wool'
    ];

    protected static $features = [
        'comfort', 'durability', 'performance', 'style', 'functionality', 'convenience', 'design', 'portability',
        'adjustability', 'wireless capabilities', 'power efficiency', 'noise reduction', 'speed', 'compatibility'
    ];

    protected static $usages = [
        'home', 'office', 'daily wear', 'professional', 'travel', 'gym', 'outdoor', 'gaming', 'studying', 'cooking'
    ];

    protected static $categories = [
        'Furniture', 'Electronics', 'Clothing', 'Accessories', 'Sports', 'Appliances', 'Beauty', 'Toys', 'Health'
    ];

    protected static $categoryDescriptions = [
        'Furniture' => 'Items designed to furnish and enhance your living space.',
        'Electronics' => 'High-tech gadgets for home, office, and personal use.',
        'Clothing' => 'Fashionable and comfortable wear for all occasions.',
        'Accessories' => 'Stylish additions to complete your outfit and lifestyle.',
        'Sports' => 'Equipment and apparel for fitness and outdoor activities.',
        'Appliances' => 'Home appliances that make your daily tasks easier and more efficient.',
        'Beauty' => 'Beauty and personal care products for self-care and grooming.',
        'Toys' => 'Toys and games for kids and adults alike.',
        'Health' => 'Health-related products that promote well-being and fitness.'
    ];

    public function productName()
    {
        return self::randomElement(self::$adjectives) . ' ' .
               self::randomElement(self::$materials) . ' ' .
               self::randomElement(self::$products);
    }

    public function productDescription($productName = null)
    {
        if (!$productName) {
            $productName = $this->productName();
        }

        // Start with the main product description
        $description = 'This ' . strtolower($productName) . ' offers superior ' .
        self::randomElement(self::$features) .
        ', making it ideal for ' .
        self::randomElement(self::$usages) . ' use.';

        // Add extra details such as material, design, and benefits
        $description .= ' Crafted from high-quality ' . self::randomElement(self::$materials) . 
            ', it is designed to provide long-lasting durability and comfort. ';

        // Adding possible usage scenarios and advantages
        $description .= ' Whether you are using it for ' . self::randomElement(self::$usages) .
            ', this product ensures excellent performance and reliability. ';

        // Highlighting potential benefits of the product
        $description .= ' Experience unmatched ' . self::randomElement(self::$features) . 
            ' with every use, enhancing your overall experience.';

        // Optional: Add product guarantees or additional features
        $description .= ' Backed by a satisfaction guarantee, you can trust this product to meet your needs for years to come.';

        return $description;
    }

    public function productShortDescription($productName = null)
    {
        if (!$productName) {
            $productName = $this->productName();
        }

        return ucfirst($productName) . ' is designed to provide ' .
               self::randomElement(self::$features) . ' for ' .
               self::randomElement(self::$usages) . ' use.';
    }

    public function categoryName()
    {
        return self::randomElement(self::$categories);
    }

    public function categoryDescription($categoryName = null)
    {
        if (!$categoryName) {
            $categoryName = $this->categoryName();
        }

        return self::$categoryDescriptions[$categoryName];
    }
}
