@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Orders</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div id="order_form">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-2">
                            <label for="Client">Client</label>
                            <select name="client_id" id="client_id" class="form-select"></select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-2">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-select"></select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-2">
                            <label for="sub_category_id">Sub Category</label>
                            <select name="sub_category_id" id="sub_category_id" class="form-select"></select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-2">
                            <label for="item_id">Item</label>
                            <select name="item_id" id="item_id" class="form-select"></select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-2">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-2">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="1">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-2">
                            <label for="discount">Discount</label>
                            <input type="number" name="discount" id="discount" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-2">
                            <label for="total">Total</label>
                            <input type="number" name="total" id="total" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button id="add_item" class="btn btn-primary">Add Item</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <table id="orders_table" class="table table-bordered table-striped table-hover mt-5">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Discount</th>
                        <th>Item Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr> --}}
                    <tr>
                        <td colspan="9">No items added to the order.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // load clients
        function loadClients() {
            $.get('{{ route('clients.list') }}', function(response){
                let options = '';
                // $.each(response, function(index, value){
                //     options += '<option value="'+value.id+'">'+value.name+'</option>';
                // });

                response.forEach(function(client){
                    options += '<option value="'+client.id+'">'+client.name+'</option>';
                });
                $('#client_id').html(options);
            }, 'json');
        }

        // load categories
        function loadCatgories(callback) {
            $.get('{{ route('categories.list') }}', function(response){
                let options = '';
                // $.each(response, function(index, value){
                //     options += '<option value="'+value.id+'">'+value.name+'</option>';
                // });

                response.forEach(function(category){
                    options += '<option value="'+category.id+'">'+category.name+'</option>';
                });
                $('#category_id').html(options);

                if(typeof callback == 'function') {
                    callback();
                }
            }, 'json');
        }

        // load sub categories
        function loadSubCategories(callback) {
            let category_id = $('#category_id').val();
            $.get(`{{ route('sub-categories.list', '') }}/${category_id}`, function(response){
                let options = '';

                response.forEach(function(subCategory){
                    options += `<option value="${subCategory.id}">${subCategory.name}</option>`;
                });

                $('#sub_category_id').html(options);

                if(typeof callback == 'function') {
                    callback();
                }
            }, 'json');
        }

        // load sub catgories when category selection changes
        $('#category_id').change(function(){
            loadSubCategories(loadItems);
        });

        // load items when sub category selection changes
        $('#sub_category_id').change(function(){
            loadItems();
        });

        // load items
        function loadItems() {
            let sub_category_id = $('#sub_category_id').val();
            $.get(`{{ route('items.list-by-sub-category', '') }}/${sub_category_id}`, function(response){
                let options = '';

                response.forEach(function(item){
                    options += `<option value="${item.id}" data-price="${item.price}">${item.name}</option>`;
                });

                $('#item_id').html(options);
                loadItemPrice();
            }, 'json');
        }

        // show price read from selected item option
        function loadItemPrice() {
            let price = $('#item_id option:selected').data('price');
            $('#price').val(price);
        }

        // show price when item selection changes
        $('#item_id').change(loadItemPrice);

        $(function () {
            loadClients();
            
            loadCatgories(function() {
                loadSubCategories(function(){
                    loadItems();
                });
            });
        });
            
   
    </script>
@endpush
