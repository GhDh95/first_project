<?php include(dirname(__FILE__) . "\\partials\\header.php"); ?>

<?php include(dirname(__FILE__) . "\\partials\\navigation.php"); ?>



<div x-data="{
    cart_data:[],
    processing: false,
    isProcessing: true,
    action:'',
    qty_by_id:'',
    current_id:'',
    p_id:'',
    cart_total:'',
    filtered_cart:[],
    prod_quantity:'',
    prod_id_and_qty:[],
    async get_cart_items(e){
        let data = [];
    try{
        const response = await fetch('/app/public/load_cart_items_json.php');
        data = await response.json();
        this.cart_data = data;
        this.filtered_cart = this.cart_data.filter((obj, index, self) =>
                self.findIndex(t => (t.product_id === obj.product_id)) === index
        );
        this.sort_alphabetically();
        <!--  -->
        this.get_cart_total();
        this.isProcessing = false;
        if(document.getElementById('err_msg') !== null){

            setTimeout(() => {
                document.getElementById('err_msg').innerText = '';
            }, 3000);
        }

        <!--  -->
    }catch(e){
        console.error(e);
        }
    },

    get_image_path(id){
        let path = '';
        for(let i = 0 ; i < this.filtered_cart.length; i++){
            if(this.filtered_cart[i].product_id == id && this.filtered_cart[i].product_images[0] !== undefined){
                path = this.filtered_cart[i].product_images[0];
                break;
            }
        }
        return path;
    },
    get_total(id){
        let price = '';
        let res = '';
        let filtered_arr = this.cart_data.filter(x => x.product_id == id);
        if(filtered_arr.length > 0){

            price = filtered_arr[0].product_price !== undefined ? filtered_arr[0].product_price : '';
            if(typeof price == 'string'){
                res = parseFloat(price * filtered_arr.length).toFixed(2);
            }else{

                res = price * filtered_arr.length;
            }
        }
        return res;
    },
    get_cart_total(){
        let sum = 0;
        for(let i = 0; i < this.cart_data.length; i++){
            sum = sum + parseInt(this.cart_data[i].product_price);
        }
        this.cart_total = sum;
    },
    async edit_prod(e, id){
        const value = {
            product_id: this.current_id,
            action: this.action
        };
        let data = '';
        try{
            const response = await fetch(`/app/public/cart_page_processing_json.php`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(value)
                });
                data = await response.json();
                await this.get_cart_items();
                this.processing = false;
            } catch (e){
                console.error(e);
            }
    },

    sort_alphabetically(){
        if(this.filtered_cart.length > 0){
            this.filtered_cart.sort((a,b) =>{
                if(a.product_name < b.product_name) return -1;
                if(a.product_name > b.product_name) return 1;
                return 0;
            });
        }
    },
    get_qty(id){
        if(this.cart_data.length <= 0) return '';

        let res = this.cart_data.filter(a => a.product_id == id).length;
        return res;
    },
    get_price_by_prod(id){
        if(this.cart_data.length <= 0) return '';
        let filtered_arr = this.cart_data.filter(a => a.product_id == id);
        let num_of_prod = this.cart_data.filter(a => a.product_id == id).length;
        let sum = 0;
        for(let i = 0; i < num_of_prod; i++){
            sum = sum + parseInt(filtered_arr[i].product_price);
        }
        return sum;
    },
    

    
    
}" x-init="await get_cart_items" class="">

    <div class="bg-gray-50 overflow-y-auto divide-y md:px-20 h-[700px] mt-20 border-y border-gray-200">
        <template x-if="filtered_cart.length && !isProcessing">

            <template x-for="product in filtered_cart">

                <div class="flex flex-col md:flex-row">
                    <div id="product" class="flex py-10 space-x-5 basis-9/12">
                        <img alt="" class="h-[200px] w-[170px] " x-bind:src="get_image_path(product.product_id)">
                        <div class="flex  flex-col justify-center">
                            <p class="font-Finlandica" x-text="product.product_name"></p>
                            <p class="text-sm" x-text="product.product_description"></p>
                            <div class=" flex pt-10 space-x-5">
                                <button @click="action = 'add', current_id = product.product_id, processing = true,await edit_prod(),  get_cart_items()" x-bind:class="processing ? 'cursor-not-allowed': ''">
                                    <span class="material-symbols-outlined font-thin">
                                        add
                                    </span>
                                </button>
                                <button @click="action = 'minus', current_id = product.product_id, processing = true,await edit_prod(),  get_cart_items()" x-bind:class="processing ? 'cursor-not-allowed': ''">
                                    <span class="material-symbols-outlined font-thin">
                                        remove
                                    </span>
                                </button>
                                <button @click="action = 'delete', current_id = product.product_id, processing = true,await edit_prod(), get_cart_items()" x-bind:class="processing ? 'cursor-not-allowed': ''">
                                    <span class="material-symbols-outlined font-thin">
                                        close
                                    </span>
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="basis-3/12 py-20 grid grid-cols-1 place-items-center">
                        <p class="text-gray-500" x-text="'Quantity: ' + get_qty(product.product_id)"></p>
                        <p x-text="'Total: ' +get_price_by_prod(product.product_id) +' $'"></p>
                    </div>
                </div>

            </template>
        </template>
        <template x-if="!filtered_cart.length && !isProcessing">
            <div class="flex flex-col items-center pt-32 space-y-10">
                <p>Cart is Empty! </p>
                <a class="hover:underline" href="/app/shop">Back to shop</a>
            </div>
        </template>
    </div>
    <div class="mx-20 mt-5 flex flex-col md:flex md:flex-row justify-around py-20 md:py-5">
        <p class="text-md md:text-2xl pt-2" x-text="'Total = '+ cart_total + ' $'"></p>
        <div class="flex flex-col">
            <?php foreach ($err_arr as $err) : ?>

                <p id="err_msg" class="font-semibold text-red-500"><?= $err ?></p>


            <?php endforeach; ?>
        </div>

        <form action="<?php echo $_GET['path']; ?>" method="POST">
            <button type="submit" name="checkout" class="border border-black text-2xl px-2 bg-indigo-800 text-white hover:opacity-75 hover:bg-indigo-600">Checkout</button>
        </form>
    </div>



</div>


<?php include(dirname(__FILE__) . "\\partials\\footer.php"); ?>