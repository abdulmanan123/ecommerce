<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a  href="{{ route('admin.home') }}" {{ setActive(['admin/dashboard']) }}>
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @can('view calculator')
                <li>
                    <a  href="{{ url('admin/calculator') }}" {{ setActive(['admin/calculator']) }}>
                        <i class="fa fa-calculator"></i>
                        <span>Calculator</span>
                    </a>
                </li>
                @endcan
                @can('view admins')
                <li>
                    <a  href="{{ url('admin/admins') }}" {{ setActive(['admin/admins']) }}>
                        <i class="fa fa-users"></i>
                        <span>Admins</span>
                    </a>
                </li>
                @endcan
                @can('view customers')
                <li>
                    <a  href="{{ url('admin/customers') }}" {{ setActive(['admin/customers']) }}>
                        <i class="fa fa-users"></i>
                        <span>Retailer</span>
                    </a>
                </li>
                @endcan

                        @can('view drop_shipper')
                    <li>
                        <a  href="{{ route('admin.shipper.orders')  }}" {{ setActive(['admin/shipper-orders']) }}>
                            <i class="fa fa-users"></i>
                            <span>Invoice</span>
                        </a>
                    </li>
                @endcan
                
                <li>
                    <a  href="{{ url('admin/order-users')  }}" {{ setActive(['admin/order-users']) }}>
                        <i class="fa fa-users"></i>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a  href="{{ url('admin/admin-orders')  }}" {{ setActive(['admin/admin-orders']) }}>
                        <i class="fa fa-shopping-cart"></i>
                        <span>Quotations</span>
                    </a>
                </li>
                    
                @can('view wholesaler')
                    <li>
                        <a  href="{{ route('admin.retailer.orders')  }}" {{ setActive(['admin/retailer-orders']) }}>
                            <i class="fa fa-users"></i>
                            <span>Website Orders ({{checkNewOrder('retailer')}})</span>
                        </a>
                    </li>
                @endcan
               @can('view wholesaler')
                    <li>
                        <a  href="{{ route('admin.whole.saler.orders')  }}" {{ setActive(['admin/whole-saler-orders']) }}>
                            <i class="fa fa-users"></i>
                            <span>Shopkeeper Orders ({{checkNewOrder('wholesaler')}})</span>
                        </a>
                    </li>
                @endcan
          {{--      @can('view drop_shipper')
                    <li>
                        <a  href="{{ route('admin.shipper.orders')  }}" {{ setActive(['admin/shipper-orders']) }}>
                            <i class="fa fa-users"></i>
                            <span>Drop Shipper Orders ({{checkNewOrder('dropshipper')}})</span>
                        </a>
                    </li>
                @endcan--}}
                @can('view wholesaler')
                    <li>
                        <a  href="{{ url('admin/wholesaler') }}" {{ setActive(['admin/wholesaler']) }}>
                            <i class="fa fa-users"></i>
                            <span>Shopkeepers</span>
                        </a>
                    </li>
                @endcan
            {{--    @can('view drop_shipper')
                <li>
                    <a  href="{{ url('admin/drop-shipper') }}" {{ setActive(['admin/drop-shipper']) }}>
                        <i class="fa fa-users"></i>
                        <span>Drop Shipper</span>
                    </a>
                </li>
                @endcan--}}

                @can('view courier_assignment')
                <li>
                    <a  href="{{ url('admin/courier-assignment') }}" {{ setActive(['admin/courier-assignment']) }}>
                        <i class="fa fa-paper-plane"></i>
                        <span>Courier Assignment</span>
                    </a>
                </li>
                @endcan

                <li>
                    <a  href="{{ url('admin/get-users') }}" {{ setActive(['admin/get-users']) }}>
                        <i class="fa fa-file-text"></i>
                        <span>User Invoices</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:void(0);" {{ setActive(['admin/products','admin/categories','admin/subcategories','admin/stores']) }}>
                        <i class="fa fa-shopping-cart"></i>
                        <span>Products</span>
                    </a>
                    <ul class="sub">
                        @can('view products')
                        <li {{ setActive(['admin/products']) }}><a href="{{ url('admin/products') }}">Products</a></li>
                        @endcan
                        @can('view categories')
                        <li {{ setActive(['admin/categories']) }}><a href="{{ url('admin/categories') }}">Categories</a></li>
                        @endcan
                        @can('view categories')
                        <li {{ setActive(['admin/subcategories']) }}><a href="{{ url('admin/subcategories') }}">Sub Categories</a></li>
                        @endcan
                        @can('view stores')
                        <li {{ setActive(['admin/stores']) }}><a href="{{ url('admin/stores') }}">Stores</a></li>
                        @endcan
                    </ul>
                </li>
                
                
                @can('view orders')
                <li>
                    <a  href="{{ url('admin/orders') }}" {{ setActive(['admin/orders']) }}>
                        <i class="fa fa-file-text"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <!-- <li>
                    <a  href="{{ url('admin/sales') }}" {{ setActive(['admin/sales','admin/invoice']) }}>
                        <i class="fa fa-file-text"></i>
                        <span>Sales</span>
                    </a>
                </li> -->
                @endcan
                @can('view manage stocks')
                <li>
                    <a  href="{{ url('admin/manage-stocks') }}" {{ setActive(['admin/manage-stocks']) }}>
                        <i class="fa fa-filter"></i>
                        <span>Manage Stocks</span>
                    </a>
                </li>
                @endcan
                @can('view suppliers')
                <li>
                    <a  href="{{ url('admin/suppliers') }}" {{ setActive(['admin/suppliers']) }}>
                        <i class="fa fa-users"></i>
                        <span>Suppliers</span>
                    </a>
                </li>
                @endcan
                @can('view promotions')
                <li>
                    <a  href="{{ url('admin/promotions') }}" {{ setActive(['admin/promotions']) }}>
                        <i class="fa fa-bullhorn"></i>
                        <span>Promotions</span>
                    </a>
                </li>
                @endcan
                @can('view_comments')
                    <li>
                        <a  href="{{ url('admin/product-feedback') }}" {{ setActive(['admin/product-feedback']) }}>
                            <i class="fa fa-comments-o"></i>
                            <span>Feed Backs</span>
                        </a>
                    </li>
                @endcan





                @can('view reports')
                <li class="sub-menu">
                    <a href="javascript:void(0);" {{ setActive(['admin/reports']) }}>
                        <i class="fa fa-area-chart"></i>
                        <span>Reports</span>
                    </a>
                    <ul class="sub">
                        <li {{ setActive(['admin/reports/retail']) }}><a href="{{ url('admin/reports/retail') }}">Retail Dashboard</a></li>
                        <li {{ setActive(['admin/reports/stock']) }}><a href="{{ url('admin/reports/stock') }}">Stock Report</a></li>
                        <li {{ setActive(['admin/reports/sale']) }}><a href="{{ url('admin/reports/sale') }}">Sale Report</a></li>
                        <li {{ setActive(['admin/reports/product']) }}><a href="{{ url('admin/reports/product') }}">Product Report</a></li>
                        <li {{ setActive(['admin/reports/customer']) }}><a href="{{ url('admin/reports/customer') }}">Customer Report</a></li>
                    </ul>
                </li>
                @endcan
                @can('view pages')
                <li>
                    <a  href="{{ url('admin/pages') }}" {{ setActive(['admin/pages']) }}>
                        <i class="fa fa-home"></i>
                        <span>CMS Pages</span>
                    </a>
                </li>
                @endcan
                @can('view faqs')
                <li>
                    <a  href="{{ url('admin/faqs') }}" {{ setActive(['admin/faqs']) }}>
                        <i class="fa fa-question-circle"></i>
                        <span>FAQS</span>
                    </a>
                </li>
                @endcan
                @can('view newsletters')
                <li class="sub-menu">
                    <a href="javascript:void(0);" {{ setActive(['admin/newsletters','admin/subscribers']) }}>
                        <i class="fa fa-newspaper-o"></i>
                        <span>Newsletters</span>
                    </a>
                    <ul class="sub">
                        <li {{ setActive(['admin/newsletters']) }}><a href="{{ url('admin/newsletters') }}">Newsletters</a></li>
                        @can('view newsletter subscriber')
                        <li {{ setActive(['admin/subscribers']) }}><a href="{{ url('admin/subscribers') }}">Subscribers</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <li class="sub-menu">
                    <a href="javascript:void(0);" {{ setActive(['admin/brands','admin/shippings','admin/couriers','admin/settings','admin/sliders','admin/currencies','admin/tax-rates','admin/variants','admin/roles','admin/permissions']) }}>
                        <i class="fa fa-cogs"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub">
                        @can('view brands')
                        <li {{ setActive(['admin/brands']) }}><a href="{{ url('admin/brands') }}">Brands</a></li>
                        @endcan
                        @can('view couriers')
                        <li {{ setActive(['admin/couriers']) }}><a href="{{ url('admin/couriers') }}">Couriers</a></li>
                        @endcan
                        @can('view shippings')
                        <li {{ setActive(['admin/shippings']) }}><a href="{{ url('admin/shippings') }}">Shippings</a></li>
                        @endcan
                        @can('view sliders')
                        <li {{ setActive(['admin/sliders']) }}><a href="{{ url('admin/sliders') }}">Sliders</a></li>
                        @endcan
                        @can('view currencies')
                        <li {{ setActive(['admin/currencies']) }}><a href="{{ url('admin/currencies') }}">Currencies</a></li>
                        @endcan
                        @can('view tax rates')
                        <li {{ setActive(['admin/tax-rates']) }}><a href="{{ url('admin/tax-rates') }}">Tax Rates</a></li>
                        @endcan
                        @can('view attributes')
                        <li {{ setActive(['admin/variants']) }}><a href="{{ url('admin/variants') }}">Attributes</a></li>
                        @endcan
                        @can('view roles')
                         <li {{ setActive(['admin/roles']) }}><a href="{{ url('admin/roles') }}">Roles</a></li>
                         @endcan
                        @can('view permissions')
                        <li {{ setActive(['admin/permissions']) }}><a href="{{ url('admin/permissions') }}">Permissions</a></li>
                        @endcan
                        @can('view settings')
                        <li {{ setActive(['admin/settings']) }}><a href="{{ url('admin/settings') }}">System Settings</a></li>
                        @endcan
                    </ul>
                </li>


            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
