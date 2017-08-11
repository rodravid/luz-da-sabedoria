<?php

namespace App\Domain;

use Illuminate\Session\SessionInterface;
use Illuminate\Support\ServiceProvider;
use App\Domain\ACL\ACLService;
use App\Domain\Admin\AdminService;

class DomainServiceProvider extends ServiceProvider
{

    protected $defer = true;

    public function register()
    {

        $this->app->singleton('App\Domain\ACL\ACLService', function() {
            return new ACLService(
                $this->app['em'],
                $this->app->make('App\Domain\ACL\Module\ModuleRepository'),
                $this->app->make('App\Domain\ACL\Role\RoleRepository'),
                $this->app->make('App\Domain\ACL\Permission\PermissionRepository')
            );
        });

        $this->app->singleton('App\Domain\Customer\Address\AddressService', function() {
            return new AddressService(
                $this->app['em'],
                $this->app['App\Domain\Customer\Address\AddressFactory'],
                $this->app['App\Domain\Address\MultiAddressValidator'],
                $this->app['address.repository'],
                $this->app['sanitizer']
            );
        });

        $this->app->singleton('App\Domain\Customer\CustomerService', function() {
            return new CustomerService(
                $this->app['em'],
                $this->app['App\Domain\Customer\CustomerRepository'],
                $this->app->make('App\Domain\Customer\CustomerValidator'),
                $this->app->make('App\Domain\Customer\Address\AddressService'),
                $this->app['sanitizer'],
                $this->app['events']
            );
        });

        $this->app->singleton('App\Domain\DeliveryTrack\DeliveryTrackService', function() {
            return new DeliveryTrackService(
                $this->app['em'],
                $this->app['App\Domain\DeliveryTrack\DeliveryTrackRepository'],
                $this->app->make('App\Domain\DeliveryTrack\DeliveryTrackValidator'),
                $this->app->make('App\Domain\DeliveryTrack\LineValidator'),
                $this->app['sanitizer']
            );
        });

        $this->app->singleton('App\Domain\Admin\AdminService', function() {
            return new AdminService(
                $this->app['App\Domain\Admin\AdminRepository'],
                $this->app['em'],
                $this->app->make('App\Domain\Admin\AdminValidator'),
                $this->app['Vinci\Infrastructure\Storage\StorageService'],
                $this->app['App\Domain\Image\ImageRepository']
            );
        });

        $this->app->singleton('App\Domain\Highlight\HighlightService', function() {
            return new HighlightService(
                $this->app['em'],
                $this->app['App\Domain\Highlight\HighlightRepository'],
                $this->app->make('App\Domain\Highlight\HighlightValidator'),
                $this->app['Vinci\Infrastructure\Storage\StorageService'],
                $this->app['App\Domain\Image\ImageRepository'],
                $this->app['App\Domain\ACL\ACLService']
            );
        });

        $this->app->singleton('App\Domain\Country\CountryService', function() {
            return new CountryService(
                $this->app['em'],
                $this->app['App\Domain\Country\CountryRepository'],
                $this->app->make('App\Domain\Country\CountryValidator'),
                $this->app['Vinci\Infrastructure\Storage\StorageService'],
                $this->app['App\Domain\Image\ImageRepository']
            );
        });

        $this->app->singleton('App\Domain\Region\RegionService', function() {
            return new RegionService(
                $this->app['em'],
                $this->app['App\Domain\Region\RegionRepository'],
                $this->app->make('App\Domain\Region\RegionValidator'),
                $this->app['Vinci\Infrastructure\Storage\StorageService'],
                $this->app['App\Domain\Image\ImageRepository']
            );
        });

        $this->app->singleton('App\Domain\Producer\ProducerService', function() {
            return new ProducerService(
                $this->app['em'],
                $this->app['App\Domain\Producer\ProducerRepository'],
                $this->app->make('App\Domain\Producer\ProducerValidator'),
                $this->app['Vinci\Infrastructure\Storage\StorageService'],
                $this->app['App\Domain\Image\ImageRepository']
            );
        });

        $this->app->singleton('App\Domain\Grape\GrapeService', function() {
            return new GrapeService(
                $this->app['em'],
                $this->app['App\Domain\Grape\GrapeRepository'],
                $this->app->make('App\Domain\Grape\GrapeValidator'),
                $this->app['Vinci\Infrastructure\Storage\StorageService'],
                $this->app['App\Domain\Image\ImageRepository']
            );
        });

        $this->app->singleton('App\Domain\ProductType\ProductTypeService', function() {
            return new ProductTypeService(
                $this->app['em'],
                $this->app['App\Domain\ProductType\ProductTypeRepository'],
                $this->app->make('App\Domain\ProductType\ProductTypeValidator'),
                $this->app['Vinci\Infrastructure\Storage\StorageService'],
                $this->app['App\Domain\Image\ImageRepository']
            );
        });

        $this->app->singleton('App\Domain\ProductNotify\Services\ProductNotifyService', function() {
            return new ProductNotifyService(
                $this->app['App\Domain\ProductNotify\Repositories\ProductNotifyRepository'],
                $this->app->make('App\Domain\ProductNotify\Validators\ProductNotifyValidator'),
                $this->app->make('App\Domain\Product\Repositories\ProductRepository')
            );
        });

        $this->app->singleton('App\Domain\Shipping\Contracts\ShippingCarrierLocator', function() {
            return new ShippingCarrierLocator(
                $this->app['carrier.repository']
            );
        });

        $this->app->singleton('App\Domain\Promotion\Types\Shipping\ShippingPromotionLocator', function() {
            return new DefaultShippingPromotionLocator(
                $this->app['shipping_promotion.repository']
            );
        });

        $this->app->singleton('App\Domain\Product\Factories\Contracts\ProductFactory', function() {
            return $this->app->make('App\Domain\Product\Factories\ProductFactory');
        });

        $this->app->singleton('product.url_generator', function() {
            return new ProductUrlGenerator;
        });

        $this->app->singleton('App\Domain\Channel\Contracts\ChannelContext', function() {
            return $this->app->make('Vinci\App\Website\Channel\Context\ChannelContextSession', [$this->app['session']->driver()]);
        });

        $this->app->singleton('App\Domain\Channel\Contracts\ChannelProvider', function() {

            $context = $this->app->make('App\Domain\Channel\Contracts\ChannelContext');
            $repository = $this->app->make('App\Domain\Channel\ChannelRepository');

            return new ChannelProvider($context, $repository);
        });

        $this->app->singleton('App\Domain\ShoppingCart\Factory\Contracts\ShoppingCartFactory', function() {
            return $this->app->make('App\Domain\ShoppingCart\Factory\ShoppingCartFactory');
        });

        $this->app->singleton('App\Domain\ShoppingCart\Context\Contracts\ShoppingCartContext', function() {
            return $this->app->make('Vinci\App\Website\Http\ShoppingCart\Context\ShoppingCartContextSession', [$this->app['session']->driver()]);
        });

        $this->app->singleton('App\Domain\ShoppingCart\Services\ShoppingCartService', function() {
            return new ShoppingCartService(
                $this->app['em'],
                $this->app['App\Domain\ShoppingCart\Repositories\ShoppingCartRepository'],
                $this->app['App\Domain\Product\Repositories\ProductVariantRepository'],
                new TimedOutCartEspecification($this->app['App\Domain\Checkout\CheckoutChecker'])
            );
        });

        $this->app->singleton('cart.provider', function() {

            $context = $this->app->make('App\Domain\ShoppingCart\Context\Contracts\ShoppingCartContext');
            $repository = $this->app->make('App\Domain\ShoppingCart\Repositories\ShoppingCartRepository');
            $factory = $this->app->make('App\Domain\ShoppingCart\Factory\Contracts\ShoppingCartFactory');

            return new ShoppingCartProvider($context, $repository, $factory, $this->app['auth']->guard('website'));
        });

        $this->app->singleton('App\Domain\ShoppingCart\Provider\ShoppingCartProvider', function() {
            return new CustomerShoppingCartProvider(
                $this->app['cart.provider'],
                $this->app['cart.repository'],
                $this->app['auth']->guard('website')
            );
        });

        $this->app->singleton('App\Domain\Inventory\Checkers\Contracts\AvailabilityChecker', function() {
            return new AvailabilityChecker;
        });

        $this->app->alias('App\Domain\Inventory\Checkers\Contracts\AvailabilityChecker', 'inventory.checker');

        $this->app->singleton('Vinci\App\Website\Auth\Events\Listeners\LinkCustomerToCurrentCart', function() {

            $cartProvider = $this->app->make('cart.provider');
            $cartRepository = $this->app->make('App\Domain\ShoppingCart\Repositories\ShoppingCartRepository');

            return new LinkCustomerToCurrentCart($cartProvider, $cartRepository);
        });

        $this->app->singleton('App\Domain\Dollar\DollarProvider', function() {
            return new DefaultDollarProvider($this->app['App\Domain\Dollar\DollarRepository']);
        });

        $this->app->singleton('App\Domain\Pricing\PriceCalculator', function() {
            return new StandardPriceCalculator($this->app['App\Domain\Dollar\DollarProvider']);
        });

        $this->app->singleton('App\Domain\Pricing\Contracts\PriceCalculatorProvider', function($app) {
            return new PriceCalculatorProvider($app);
        });

        $this->app->alias('App\Domain\Product\Services\FavoriteService', 'product.favorite.service');

        $this->app->singleton('App\Domain\Promotion\Types\Discount\DiscountPromotionProvider', function($app) {

            $repository = $app['App\Domain\Promotion\Types\Discount\DiscountPromotionRepository'];

            return new DefaultDiscountPromotionProvider($repository, $app['cache']->driver());
        });

        $this->app->singleton('App\Domain\Promotion\Types\ClearanceSale\ClearanceSalePromotionProvider', function($app) {

            $repository = $app['App\Domain\Promotion\Types\ClearanceSale\ClearanceSalePromotionRepository'];

            return new DefaultClearanceSalePromotionProvider($repository, $app['cache']->driver());
        });

        $this->app->singleton('App\Domain\Recomendations\Products\Service\ProductRecommendedService', function ($app) {
            return new DefaultProductRecommendedService($app['product.repository'], $app[Presenter::class]);
        });
        
        $this->app->singleton('App\Domain\Showcase\StaticShowcases\StaticShowcasesProvider', function() {
            return new DefaultStaticShowcasesProvider;
        });
        
        $this->app->alias('App\Domain\Showcase\StaticShowcases\StaticShowcasesProvider', 'showcase.static.provider');

        $this->app->singleton('App\Domain\Checkout\CheckoutChecker', function() {
            return new CheckoutChecker($this->app['request']);
        });

        $this->app->singleton('App\Domain\Pricing\Contracts\PriceConfigurationProvider', function () {
            $corporatePromotionProvider = $this->app->make('App\Domain\Promotion\Types\Corporate\Providers\CorporatePromotionProvider');
            return new CorporatePriceConfigurationProvider($this->app->make(StandardPriceConfigurationProvider::class), $corporatePromotionProvider);
        });

        $this->app->singleton('App\Domain\Promotion\Types\Corporate\Context\CorporatePromotionContext', function () {
            return new CorporatePromotionContextSession($this->app['session']->driver());
        });

        $this->app->singleton('App\Domain\Promotion\Types\Corporate\Providers\CorporatePromotionProvider', function($app) {

            $corporatePromotionContext = $app['App\Domain\Promotion\Types\Corporate\Context\CorporatePromotionContext'];
            $repository = $this->app->make('App\Domain\Promotion\Types\Corporate\CorporatePromotionRepository');

            return new DefaultCorporatePromotionProvider($corporatePromotionContext, $repository);
        });
    }

    public function provides()
    {
        return [
            'App\Domain\ACL\ACLService',
            'App\Domain\Customer\Address\AddressService',
            'App\Domain\Customer\CustomerService',
            'App\Domain\DeliveryTrack\DeliveryTrackService',
            'App\Domain\Admin\AdminService',
            'App\Domain\Highlight\HighlightService',
            'App\Domain\Country\CountryService',
            'App\Domain\Region\RegionService',
            'App\Domain\Producer\ProducerService',
            'App\Domain\Grape\GrapeService',
            'App\Domain\ProductType\ProductTypeService',
            'App\Domain\ProductNotify\Services\ProductNotifyService',
            'App\Domain\Shipping\Contracts\ShippingCarrierLocator',
            'App\Domain\Promotion\Types\Shipping\ShippingPromotionLocator',
            'App\Domain\Product\Factories\Contracts\ProductFactory',
            'product.url_generator',
            'App\Domain\Channel\Contracts\ChannelContext',
            'App\Domain\Channel\Contracts\ChannelProvider',
            'App\Domain\ShoppingCart\Factory\Contracts\ShoppingCartFactory',
            'App\Domain\ShoppingCart\Context\Contracts\ShoppingCartContext',
            'App\Domain\ShoppingCart\Services\ShoppingCartService',
            'cart.provider',
            'App\Domain\ShoppingCart\Provider\ShoppingCartProvider',
            'App\Domain\Inventory\Checkers\Contracts\AvailabilityChecker',
            'Vinci\App\Website\Auth\Events\Listeners\LinkCustomerToCurrentCart',
            'App\Domain\Dollar\DollarProvider',
            'App\Domain\Pricing\PriceCalculator',
            'App\Domain\Pricing\Contracts\PriceCalculatorProvider',
            'App\Domain\Promotion\Types\Discount\DiscountPromotionProvider',
            'App\Domain\Promotion\Types\Corporate\Providers\CorporatePromotionProvider',
            'App\Domain\Recomendations\Products\Service\ProductRecommendedService',
            'App\Domain\Showcase\StaticShowcases\StaticShowcasesProvider',
            'App\Domain\Promotion\Types\ClearanceSale\ClearanceSalePromotionProvider',
            'App\Domain\Checkout\CheckoutChecker',
            'App\Domain\Pricing\Contracts\PriceConfigurationProvider',
            'App\Domain\Promotion\Types\Corporate\Context\CorporatePromotionContext',
        ];
    }
}