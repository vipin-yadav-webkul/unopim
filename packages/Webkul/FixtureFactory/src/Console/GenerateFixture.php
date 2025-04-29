<?php

namespace Webkul\FixtureFactory\Console;

use Illuminate\Console\Command;
use Webkul\FixtureFactory\Services\AttributeFixtureFactory as AttributeFixtureFactoryService;
use Webkul\FixtureFactory\Services\CategoryFixtureFactory as CategoryFixtureFactoryService;
use Webkul\FixtureFactory\Services\ProductFixtureFactory as ProductFixtureFactoryService;

class GenerateFixture extends Command
{
    protected $signature = 'fixture-factory:generate';

    protected $description = 'Generate fixture (dummy) data for products, and categories';

    public function __construct(
        protected ProductFixtureFactoryService $productFixtureFactoryService,
        protected CategoryFixtureFactoryService $categoryFixtureFactoryService,
        protected AttributeFixtureFactoryService $attributeFixtureFactoryService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $attributesCount = (int) $this->ask('How many attributes to generate?', 0);
        $categoriesCount = (int) $this->ask('How many categories to generate?', 0);
        $simpleProductsCount = (int) $this->ask('How many simple products to generate?', 0);
        $configurableProductsCount = (int) $this->ask('How many configurable products to generate?', 0);

        $this->generate('Attributes', $attributesCount, 10, fn ($offset, $total, $chunk) =>      $this->attributeFixtureFactoryService->generate($offset, $total, $chunk)
        );

        $this->generate('Categories', $categoriesCount, 10, fn ($offset, $total, $chunk) =>      $this->categoryFixtureFactoryService->generate($offset, $total, $chunk)
        );

        $this->newLine();

        $this->generate('Simple Products', $simpleProductsCount, 1000, fn ($offset, $total, $chunk) => $this->productFixtureFactoryService->generate($offset, $total, $chunk)
        );

        $this->newLine();

        $this->generate('Configurable Products', $configurableProductsCount, 100, fn ($offset, $total, $chunk) => $this->productFixtureFactoryService->generateConfigurableProducts($offset, $total, $chunk)
        );

        $this->newLine();
        $this->info('✅ All dummy data generation completed.');
    }

    /**
     * Generate fixture data.
     */
    protected function generate(string $title, int $count, int $chunkSize, callable $callback)
    {
        if ($count <= 0) {
            return;
        }

        $this->info("Generating {$title}...");

        $startTime = microtime(true);

        $progressBar = $this->output->createProgressBar(ceil($count / $chunkSize));
        $green = "\033[32m";

        $progressBar->setFormat("{$green} %current%/%max% [%bar%] %percent:3s%% {$title}: %products% and Elapsed Time: %elapsed%");
        $progressBar->start();

        $generated = 0;
        $progressBar->setMessage($generated, 'products');
        $progressBar->setMessage('00:00:00', 'elapsed');

        for ($i = 0; $i < $count; $i += $chunkSize) {
            try {
                $completed = $callback($i, $count, $chunkSize);
                $generated += $completed;
                $elapsed = microtime(true) - $startTime;
                $formatted = gmdate('H:i:s', (int) $elapsed);

                $progressBar->setMessage($generated, 'products');
                $progressBar->setMessage($formatted, 'elapsed');
                $progressBar->advance();
            } catch (\Exception $e) {
                $this->newLine();
                $this->error("❌ Error generating {$title}: {$e->getMessage()}");
            }
        }

        $progressBar->finish();

        $this->newLine();
        $this->info("✅ {$title} generation completed.");
    }
}
