@extends('admin.layouts.app')

@section('style')
<style>
    td.invoice ul li span{float: right;}
    label.error{color: #950606;font-weight: 500 !important;}
</style>
@endsection

@section('content')

<section id="main-content" >
    <section class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                     <li><a href="{{ url('admin/admin-orders') }}"> Admin Orders</a></li>
                    <li class="active">Quotation</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

                  <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <div class="panel-body invoice" id="printData">
                            
                        <form id="applicationForm" action="{{ route('admin.admin-orders.store') }}" method="post">
                        @csrf
                        <div class="row invoice-to">
                            <div class="col-md-6 col-sm-6 pull-left">

                                <h4>Admin Details:</h4>
                                <p>
                                    <b>Company Name:</b> The Super Van<br>
                                    <b>Phone:</b> +44 141 374 0365<br>
                                    <b>Email:</b> info@fonology.co.uk<br>
                                    <b>Address:</b> 61c Main Street, Thornliebank G46 7RX Glasgow, UK.
                                </p>
                                <h4>Customer:</h4>
                                <p>
                                    <div class="col-md-6">
                                        {!! Form::select('customer_id', $customers, null, ['class' => 'form-control select2 customer_id', 'required' => 'required']) !!}
                                        <label id="customer_id-error" class="error" for="customer_id"></label>
                                    </div>
                                    <div class="col-md-6 customer_wallet" style="display:none;">
                                        <label></label>
                                    </div>
                                </p>
                            </div>
                            <div class="col-md-4 col-sm-5 pull-right">
                                <div class="row">
                                    <div class="col-md-4 col-sm-5 inv-label">Date #</div>
                                    <div class="col-md-8 col-sm-7">{{ date('d-m-Y') }}</div>
                                </div>
                            </div>
                        </div>
                        

                        <table class="table table-invoice" >
                            <thead>
                            <tr>
                                <th>Item Description</th>
                                <th class="text-center">Unit Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Remaining Quantity</th>
                                <th class="text-center">Total</th>
                                <th class="text-center"><i class="btn btn-sm fa fa-plus loadRow text-success"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class='product_row'>
                                    <td class="invoice">
                                        {!! Form::select('product_name[0]', $products, null, ['class' => 'form-control select2 products', 'style' => 'width:250px', 'required' => 'required']) !!}
                                        <label id="product_name[0]-error" class="error" for="product_name[0]"></label>
                                        <input type="hidden" name="product_id[0]" value="0" class="product_id" />
                                    </td>
                                    <td class="text-center product_unit_price" data-value="0" data-discounted_price="0" data-tax_rate="0" >
                                        <input required type='number' style='width:60px' name='product_price[]' class='product_price' value="0" step="any" min="0" />
                                        <label id="product_price[0]-error" class="error" for="product_price[0]"></label>
                                    </td>
                                    <td class="text-center product_quantity_tr">
                                        <input required type='number' style='width:50px' name='product_quantity[]' class='product_quantity' value="1" step="1" min="1" />
                                        <label id="product_quantity[0]-error" class="error" for="product_quantity[0]"></label>
                                    </td>
                                    <td class="text-center quantity_total">0</td>
                                    <td class="text-center product_total">0</td>
                                    <td class="text-center"><i class="btn btn-sm fa fa-close removeRow text-danger"></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::select('payment_method', ['cash' => 'Cash', 'card' => 'Card', 'bank' => 'Bank', '2pay' => '2Pay'], null, ['class' => 'form-control', 'required' => 'required']) !!}
                            </div>
                            <div class="col-md-4 col-xs-5 invoice-block pull-right">
                                <ul class="unstyled amounts">
                                    <li style="display: none;">Gross Total: <span class="gross_total">0</span></li>
                                    <li style="display: none;">Discount :   <span class="total_discount">0</span></li>
                                    <li style="display: none;">Vat :   <span class="total_vat">0</span></li>
                                    <li class="grand-total">Total :  <span class="total_amount">0</span></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-6">
                                {!! Form::submit('Create Quotation', ['class' => 'btn btn-info pull-right admin-order-btn']) !!}
                            </div>
                        </div>    
                            
                        </form>
                    </div>
                </section>
            </div>
        </div>



    </section>
</section>

@endsection

@section('scripts')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/lodash.min.js') }}"></script>
<script type="text/javascript">
    
    var i = 1;
    var products = [];
    var taxRate = {{ getVatCharges() }};
    $(document).ready(function () {
        $("#applicationForm").validate({
            rules : {
                customer_id : { required : true },
            },
            submitHandler: function(form) {
                
                let _form = $(form);
                let _loader = $("body");
                let formData = _form.serialize();
                loadingOverlay(_loader);
                $.ajax({
                    type: _form.attr('method'),
                    url: _form.attr('action'),
                    processData: false,
                    //contentType: false,
                    //dataType: 'json',
                    data: formData,
                    success:function (res) {
                        //return false;
                        successMessage(res.message);
                        stopOverlay(_loader);
                        setTimeout(function() {
                            window.location = "{{ route('admin.admin-orders.index') }}";
                        }, 2000);
                    },
                    error: function (request, status, error) {
                        stopOverlay(_loader);
                        showAjaxErrorMessage(request, true);
                    },complete: function() {
                        $(".admin-order-btn").prop('disabled', false);
                    }
                }); 
            }
    });
    
        $(document).on('click', '.loadRow', function () {
            loadNewStatRow($(this));
        });
        
        $(document).on('change', '.customer_id', function (e) {
            
            let _el = $(this);
            var val = this.value;
            
            if (val>0) {
                loadingOverlay($(".customer_wallet"));
                $.ajax({
                    type: "GET",
                    url: '{{ url("admin/get-wallet-amount")}}' + '/' + val,
                    dataType: "json",
                    complete: function (data, textStatus, jqXHR) {
                        console.log(data.responseText);
                        $(".customer_wallet").show();
                        $(".customer_wallet label").html(data.responseText);
                        stopOverlay($(".customer_wallet"));
                    }
                });
            } else {
                $(".customer_wallet").hide();
                $(".customer_wallet label").text('Wallet: £00.0');
            }
            
        });
        
        $(document).on('change', '.products', function (e) {
            
            let _el = $(this);
            var _parent = $(this).parents('.product_row');
            var val = this.value;
            if (val > 0) {
                if (_.includes(products, this.value)) {
                    _el.find('option[value=""]').removeAttr("selected");
                    _el.find('option[value=""]').attr("selected", "selected");
                    errorMessage('You have already select this option please select other option');
                    return false;
                } else {

                    loadingOverlay(_el);

                    $.ajax({
                        type: "GET",
                        url: '{{ url("admin/get-product-details")}}' + '/' + val,
                        dataType: "json",
                        success: function (data, textStatus, jqXHR) {
                            if (data.success) {

                                var product = data.product;
                                if (product.final_quantity && product.final_quantity > 0) {
                                    _parent.find(".product_id").val(product.id);
                                    _parent.find(".product_unit_price").attr('data-value', product.price);
                                    _parent.find(".product_unit_price").attr('data-discounted_price', product.discountedPrice);
                                    //_parent.find(".product_unit_price").text(product.price);
                                    _parent.find('.product_price').val(product.price);

                                    if (typeof product.tax_rate.rate !== "undefined") {
                                        _parent.find(".product_unit_price").attr('data-tax_rate', product.tax_rate.rate);
                                    }

                                    _parent.find(".product_quantity").val(1);
                                    _parent.find(".product_quantity").attr('max', product.final_quantity);
                                    _parent.find(".quantity_total").text(product.final_quantity);

                                    calculateAmount();

                                    var wrapped = _(products).push(val);
                                    wrapped.commit();
                                    products = _.uniqBy(products);
                                    _el.attr("disabled", true);    
                                } else {
                                    _el.val('').change();
                                    errorMessage('This product is not available for sale');
                                }


                            } else {
                                errorMessage(data.message);
                            }
                            stopOverlay(_el);
                        }
                    });
                }
            }
            
        });
        
        $(document).on('change', '.product_quantity', function (e) {
            var val = parseInt(this.value);
            var max = parseInt($(this).attr('max'));
            
            if (val > max) {
                $(this).val(max);
            }
            
            calculateAmount();
        });
        
        $(document).on('change', '.product_price', function (e) {
            calculateAmount();
        });
        
        $(document).on('click', '.removeRow', function() {
            var _parent = $(this).parents('.product_row');
            var productId = _parent.find(".products").val();
            _.remove(products, function(n) {
                return n == productId;
            });
            _parent.remove();
            calculateAmount();
        });
    });
    
    function loadNewStatRow(_el) {
        let htmlDiv = $('tbody');
        let _parent = _el.parents('tr');
        
        loadingOverlay(htmlDiv);
        
        $.ajax({
            type: "GET",
            url: '{{ url("admin/get-product-row")}}',
            dataType: "json",
            success: function (data, textStatus, jqXHR) {
                if (data.success) {
                    var template = jQuery.validator.format(data.html);
                    $(template(i++)).appendTo(htmlDiv);
                    
                    $(".select2").select2();
                } else {
                    errorMessage(data.message);
                }
                stopOverlay(htmlDiv);
            }
        });
    }
    
    function calculateAmount() {
        
        var grossTotal = 0;
        var totalDiscount = 0;
        var totalVat = 0;
        var totalAmount = 0;
        
        $('.table-invoice tbody tr.product_row').each(function() {
            let _product = $(this);
            var product_id = _product.find(".product_id").val();
            if (product_id > 0) {
                //var productUnitPrice = _product.find('.product_unit_price').attr('data-value');
                var productUnitPrice = _product.find('.product_price').val();
                var discountedPrice = _product.find('.product_unit_price').attr('data-discounted_price');
                //var taxRate = _product.find('.product_unit_price').attr('data-tax_rate');
                var quantity = parseInt(_product.find('.product_quantity').val());
                var maxQuantity = parseInt(_product.find('.product_quantity').attr('max'));
                quantityTotal = maxQuantity - quantity;
                _product.find(".quantity_total").text(quantityTotal);
                
                if (productUnitPrice > 0 && quantity > 0) {
                    var productTotal = productUnitPrice*quantity;
                    _product.find(".product_total").text(productTotal.toFixed(2));

                    grossTotal = grossTotal + productTotal;
                    totalDiscount = totalDiscount + ((productUnitPrice - discountedPrice) * quantity);
                    if (taxRate > 0) {
                        totalVat = totalVat + (((taxRate / 100) * productUnitPrice) * quantity);
                    }
                }
            }
        });
        //totalAmount = (grossTotal - totalDiscount) + totalVat;
        totalAmount = grossTotal;
        $(".gross_total").text((grossTotal>0) ? grossTotal.toFixed(2) : 0);
        $(".total_discount").text((totalDiscount>0) ? totalDiscount.toFixed(2) : 0);
        $(".total_vat").text((totalVat>0) ? totalVat.toFixed(2) : 0);
        $(".total_amount").text((totalAmount>0) ? totalAmount.toFixed(2) : 0);
    }
    
    
</script>

@endsection



