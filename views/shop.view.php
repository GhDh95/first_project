<?php require(__DIR__ . "\\partials\\header.php"); ?>
<?php require(__DIR__ . "\\partials\\navigation.php"); ?>
<!-- fetching data from database and displaying it on load-->
<div x-data="{
    my_var:window.myGlobalVariable ,
    clicked_prod: '',
    timer: null,
    transition: false,
    is_hovered: '',
    price_filtering_method: '',
    category_filter: '',
    product_images: [],
    original_data_copy: [],
    all_data: [],
    product_data: [],
    add_to_cart_prod: '',
    async get_products(e){
        let data = [];
    try{
        const response = await fetch('/app/public/load_products_json.php');
        data = await response.json();
        this.all_data = data;
        this.product_data = this.all_data.product_info;
        this.original_data_copy = this.all_data.product_info;
        this.product_images = this.all_data.images_info;
        console.log(this.product_images);

    }catch(e){
        console.error(e);
    }

    },
    getImagePath(id){
        let path = '';
        for(let i = 0; i < this.product_images.length ; i++){
            if(id in this.product_images[i]){
                path = this.product_images[i][id][0];
            }
        }
        return path;
    },

    filter_by_price(){
        if(this.price_filtering_method == 'ascending'){
            this.product_data.sort((a,b) => {
            let priceA = parseFloat(a.product_price);
            let priceB = parseFloat(b.product_price);
            return priceA - priceB;
        });
        }else if(this.price_filtering_method == 'descending'){
            this.product_data.sort((a,b) => {
            let priceA = parseFloat(a.product_price);
            let priceB = parseFloat(b.product_price);
            return priceB - priceA;
        });
        }
    },
    reset_filters(){
        this.get_products();
        this.price_filtering_method = '';
        this.category_filter = '';
    },

    filter_by_category(){
        let filtered_arr = [];
        if(this.category_filter !== ''){
            filtered_arr = [...this.original_data_copy].filter(product => {
                return product.product_category == this.category_filter;
            });
        }
        this.product_data = filtered_arr;
    },
    async add_to_cart(e){
        let data = [];
        const value = {
                product_id: this.clicked_prod
            };
        try{
            const response = await fetch(`/app/public/process_cart.php`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(value)
                });
                data = await response.json();
            } catch (e){
                console.error(e);
            }
        
    },
    reset_modal(){
        setTimeout(()=> {
            this.transition = false;
        },1000);
    }
    


    
}" x-init="await get_products()">
    <div class="flex py-20 justify-center space-x-3 border-b border-black mx-40">
        <select name="filter_by_category" id="" class="bg-white border border-black py-2 md:py-4 w-fit px-2 hover:ring-1 hover:ring-black focus:outline-none" x-model="category_filter">
            <option value="" hidden>Category</option>
            <option value="Watch" @click="filter_by_category()">Watch</option>
            <option value="Wallet" @click="filter_by_category()">Wallet</option>
            <option value="Jewelry" @click="filter_by_category()">Jewelry</option>
        </select>
        <select name="filter_by_price" id="" class="bg-white border border-black py-2 md:py-4 w-fit px-2 hover:ring-1 hover:ring-black focus:outline-none" x-model="price_filtering_method">
            <option value="" hidden> Price</option>
            <option value="ascending" @click="filter_by_price()">Price low to high </option>
            <option value="descending" @click="filter_by_price()">Price high to low</option>
        </select>
        <button name="reset_filters" class="border border-black py-2 md:py-4 w-fit px-2 hover:ring-1 hover:ring-black focus:outline-none hover:bg-black hover:text-white transition ease-in-out delay-100" @click="reset_filters()">Reset Filters</button>

    </div>

    <form action="" class="grid grid-cols-1 lg:grid lg:grid-cols-4   md:grid md:grid-cols-2 mt-10">


        <template x-if="product_data.length > 0" x-data="{current_image_path : ''}">
            <template x-for="product in product_data">
                <div id="product" class=" relative grid grid-cols-1 justify-items-center min-w-[300px] px-28 md:px-10 lg:px-30 lg:min-w-[360px] mb-3">
                    <div class="" @click="clicked_prod = product.product_id, add_to_cart(), window.myGlobalVariable = !window.myGlobalVariable, transition = true, reset_modal()">
                        <img alt="" class="cursor-pointer" x-bind:src="getImagePath(product.product_id)" x-bind:value="product.product_id" @mouseover="is_hovered = product.product_id" @mouseout="is_hovered = false">
                    </div>


                    <template x-if="is_hovered == product.product_id">
                        <!--  <div class="z-50 hover:block grid place-items-center hover:cursor-pointer absolute h-10 md:w-8/12 opacity-50 bottom-24 bg-slate-200" @click="add_to_cart(product.product_id)">
                            <div class="">
                                
                            </div>
                        </div> -->
                        <div class="px-20 bg-gray-100 opacity-50 absolute bottom-20 mb-1 cursor-pointer z-50">
                            <span class="material-symbols-outlined cursor-pointer">
                                add
                            </span>
                        </div>
                    </template>
                    <div class=" md:justify-self-start flex flex-col mt-2 pl-2">
                        <p class="font-Finlandica text-lg" x-text="product.product_name"></p>
                        <p x-text="product.product_description"></p>
                        <p x-text="product.product_price + ' $'"></p>
                    </div>
                </div>
            </template>
        </template>

    </form>
    <div x-bind:class="transition ? '':'opacity-0'" class="px-20 py-5 bg-indigo-600 text-white fixed inset-x-0 bottom-0 z-50">
        <p class="font-Finlandica text-center">Added to Cart</p>
    </div>
</div>

<!-- 

 -->
















<?php require(__DIR__ . "\\partials\\footer.php"); ?>